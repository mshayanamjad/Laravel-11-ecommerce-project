<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function userRegister()
    {
        return view('front.login.register');
    }

    public function sendOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric',
            'password' => 'required|min:4',
            'avatar' => 'image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        if ($validator->passes()) {
            // Generate OTP
            $otp = rand(100000, 999999); // 6 digit OTP

            // Store OTP in session
            session(['otp' => $otp]);

            // Send OTP email
            Mail::to($request->email)->send(new OtpMail($otp));

            // Send response back to show the OTP input form
            session()->flash('OTP sent successfully. Please check your email.');
            return response()->json([
                'status' => true,
                'message' => 'OTP sent successfully. Please check your email.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }


    public function verifyOtp(Request $request)
    {
        // Validate OTP input
        $request->validate([
            'otp' => 'required|numeric|digits:6',
        ]);

        // Get OTP from session
        $storedOtp = session('otp');

        // Check if OTP is correct
        if ($storedOtp && $request->otp == $storedOtp) {
            // Create the user since OTP is verified
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->role = 'customer';
            $user->password = Hash::make($request->password); // Use password provided
            $user->save();

            // User Profile image handling (optional)
            if ($request->hasFile('avatar')) {
                $image = $request->file('avatar');
                $imageName = $user->id . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/profiles'), $imageName);
                $user->avatar = $imageName;
                $user->save();
            }

            // Clear OTP from session after successful registration
            session()->forget('otp');

            return response()->json([
                'status' => true,
                'message' => 'User registered successfully.',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP. Please try again.',
            ]);
        }
    }


    public function userLogin()
    {
        return view('front.login.login');
    }

    public function userAuthentication(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('front.userLogin')
                ->withInput()
                ->withErrors($validator);
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        // ✅ Find the user using email instead of id
        $user = User::withTrashed()->where('email', $request->email)->first();

        // ✅ Check if user exists and is soft-deleted
        if ($user && $user->trashed()) {
            return redirect()->back()
                ->with([
                    'restore_option' => true,
                    'restore_id' => $user->id // Store user ID for restoration
                ])->withInput();
        }

        // ✅ Proceed with authentication
        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            if ($user->role !== 'customer') {
                Auth::logout();
                return redirect()->route('front.userLogin')
                    ->with('error', 'You are not authorized to access this page');
            }

            if (session()->has('url.intended')) {
                return redirect(session()->get('url.intended'));
            }

            return redirect()->intended(route('front.home'));
        }

        return redirect()->route('front.userLogin')
            ->withInput()
            ->with('error', 'Invalid Credentials');
    }




    public function logout()
    {
        Auth::logout();

        return redirect()->route('front.userLogin')->with('success', 'You are logged out');
    }

    public function changePassword()
    {
        return view('front.profile.change_password');
    }

    public function changePasswordProcess(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:5',
            'confirm_password' => 'required|same:new_password',
        ]);

        if ($validator->passes()) {

            $user = User::select('id', 'password')->where('id', Auth::user()->id)->first();

            if (!Hash::check($request->old_password, $user->password)) {
                session()->flash('error', 'Current Password is incorrect');
                return response()->json([
                    'status' => true,
                ]);
            }

            User::where('id', $user->id)->update([
                'password' => Hash::make($request->new_password),
            ]);

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


    public function deleteAcc()
    {
        return view('front.profile.delete_account');
    }

    public function deleteAccProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deletion_password' => 'required',
        ]);

        if ($validator->passes()) {
            $user = User::select('id', 'password', 'status')->where('id', Auth::id())->first();

            if (!$user || !Hash::check($request->deletion_password, $user->password)) {
                session()->flash('error', 'Password is incorrect');
                return response()->json([
                    'status' => false,
                ]);
            }

            $user->delete(); // Soft delete the user

            session()->flash('success', 'User Deleted Successfully');
            return redirect()->route('front.userLogin')->with('success', 'User Deleted Successfully');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }


    public function restoreAccount($id)
    {
        $user = User::withTrashed()->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        if (!$user->trashed()) {
            return redirect()->back()->with('error', 'Your account is already active.');
        }

        $user->restore();

        return redirect()->route('front.userLogin')->with('success', 'Your account has been restored! You can now log in.');
    }
}
