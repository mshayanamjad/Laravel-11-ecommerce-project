<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

        // Attempt to log in the user
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $remember = $request->has('remember');

        if ($validator->passes()) {
            if (Auth::attempt($credentials, $remember)) {

                $user = Auth::user();

                if ($user->role != 'customer') {
                    Auth::logout(); // Log out the user immediately
                    return redirect()->route('front.userLogin')
                        ->with('error', 'You are not authorized to access this page');
                }

                if (session()->has('url.intended')) {
                    return redirect(session()->get('url.intended'));
                }

                return redirect()->route('front.home');
            }
            // Make sure to use a complete route name here
            return redirect()->route('front.userLogin')
                ->withInput()
                ->with('error', 'Invalid Credentials');
        }

        return redirect()->route('front.userLogin')
            ->withInput()->withErrors($validator);
    }


    public function logout()
    {
        Auth::logout();

        return redirect()->route('front.userLogin')->with('success', 'You are logged out');
    }
}
