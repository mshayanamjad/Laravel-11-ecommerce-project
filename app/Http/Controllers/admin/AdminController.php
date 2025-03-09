<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;

class AdminController extends Controller
{
    public function register()
    {
        return view('admin.login.register');
    }

    public function processRegister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|regex:/^\+?[0-9\s\-\(\)]*$/|min:11',
            'password' => 'required|min:4',
            'role' => 'required|in:admin,manager,customer',
            'avatar' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($validator->passes()) {

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role = $request->role;
            $user->status = 'active';
            $user->password = Hash::make($request->password);
            $user->save();

            if ($request->hasFile('avatar')) {
                $image = $request->file('avatar');

                $imageName = $user->id . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/profiles'), $imageName);

                $user->avatar = $imageName;

                $user->save();
            }

            session()->flash('success', 'You are Registered as' . $user->role);

            return response()->json([
                'status' => true,
                'message' => 'You are Registered as' . $user->role
            ]);
        }

        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }


    public function login()
    {
        return view('admin.login.login');
    }

    public function authentication(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        // Attempt to log in the user
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $remember = $request->has('remember');


        if ($validator->passes()) {
            if (Auth::guard('admin')->attempt($credentials, $remember)) {

                if (Auth::guard('admin')->user()->role != 'admin') {
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error', 'You are not authorized to access this page');
                }

                if (Auth::guard('admin')->user()->status != 'active') {
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error', 'Your account is banned. Please contact the admin.');
                }


                return redirect()->route('admin.dashboard');
            } else {

                return redirect()->route('admin.login')->with('error', 'Either Email/Password is incorrect');
            }
        } else {
            return redirect()->route('admin.login')
                ->withInput()->withErrors($validator);
        }
    }

    public function dashboard()
    {
        // Get the last 7 days as an array
        $dates = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('d');
            $dates[$date] = 0; // Default sales value
        }

        // Fetch daily sales for the last 7 days
        $salesData = Order::select(
            DB::raw("DATE_FORMAT(created_at, '%d') as date"),
            DB::raw('SUM(grand_total) as total_sales')
        )
            ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();

        // Merge sales data with all dates
        foreach ($salesData as $sale) {
            $dates[$sale->date] = $sale->total_sales;
        }

        // Convert to an array of objects (or use as needed)
        $dailySales = [];
        foreach ($dates as $date => $totalSales) {
            $dailySales[] = ['date' => $date, 'total_sales' => $totalSales];
        }

        $data = [
            'totalOrders' => Order::count(),
            'totalSales' => Order::sum('grand_total'),
            'dailySales' => $dailySales,
            'dailySalesCount' => Order::whereDate('created_at', Carbon::today())->sum('grand_total'),
            'customers' => User::where('role', 'customer')->count(),
        ];
        return view('admin.dashboard.dashboard', $data);
    }


    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login')->with('success', 'You are logged out');
    }


    public function index(Request $request)
    {

        // Fetch all users, with search functionality if a keyword is provided
        $allUsersQuery = User::orderBy('id', 'asc');

        if (!empty($request->get('keyword'))) {
            $allUsersQuery->where('name', 'like', '%' . $request->get('keyword') . '%');
        }


        // Paginate the filtered or unfiltered results
        $allUsers = $allUsersQuery->paginate(10);
        $activeUsersQuery = User::orderBy('id', 'asc')->where('status', 'active');
        $bannedUsersQuery = User::orderBy('id', 'asc')->where('status', 'banned');

        $activeUsers = $activeUsersQuery->paginate(10);
        $bannedUsers = $bannedUsersQuery->paginate(10);

        $data = [
            'allUsers' => $allUsers,
            'activeUsers' => $activeUsers,
            'bannedUsers' => $bannedUsers,
        ];

        return view('admin.users.list', $data);
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone' => 'required|regex:/^\+?[0-9\s\-\(\)]*$/|min:11',
            'role' => 'required|in:admin,manager,customer',
            'status' => 'required|in:active,inactive,banned',
            'avatar' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($validator->passes()) {

            $user = User::find($id);
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->role = $request->role;
            $user->status = $request->status;
            $user->save();

            if ($request->hasFile('avatar')) {
                $image = $request->file('avatar');

                $imagePath = public_path('uploads/profiles/' . $user->avatar);

                if ($user->avatar && File::exists($imagePath)) {
                    File::delete($imagePath);
                }


                $imageName = $user->id . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/profiles'), $imageName);

                $user->avatar = $imageName;
            }
            $user->save();

            session()->flash('success', 'User Updated');

            return response()->json([
                'status' => true,
                'message' => 'User Updated'
            ]);
        }

        return response()->json([
            'status' => false,
            'errors' => $validator->errors()
        ]);
    }

    public function changePass()
    {
        return view('admin.login.change-password');
    }

    public function changePassProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->passes()) {

            $user = User::select('id', 'password')->where('id', Auth::guard('admin')->user()->id)->first();

            if (!Hash::check($request->old_password, $user->password)) {
                session()->flash('error', 'Old Password is incorrect');
                return response()->json([
                    'status' => true,
                ]);
            }

            User::where('id', $user->id)->update([
                'password' => Hash::make($request->new_password)
            ]);

            Auth::guard('admin')->logout();
            session()->flash('success', 'Password Changed Successfully');
            return response()->json([
                'status' => true,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
}
