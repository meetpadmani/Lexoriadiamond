<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\OtpMail;
use App\Mail\ResetPasswordMail;
use App\Services\WhatsAppService;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('frontend.auth.login');
    }

    // Traditional Password Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('profile.index'))->with('success', 'Welcome to your royal dashboard.');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Passwordless OTP Login
    public function sendLoginOtp(Request $request, WhatsAppService $wa)
    {
        $request->validate([
            'login_id' => 'required|string',
        ]);

        $loginId = $request->login_id;
        $isEmail = filter_var($loginId, FILTER_VALIDATE_EMAIL);

        $user = $isEmail ? User::where('email', $loginId)->first() : User::where('phone', $loginId)->first();

        if (!$user) {
            return back()->withErrors([
                'login_id' => 'We could not find an account with that email or phone number.',
            ])->onlyInput('login_id');
        }

        // Generate 6 digit OTP
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        if ($isEmail) {
            Mail::to($user->email)->send(new OtpMail($otp));
            $request->session()->put('otp_login_id', $user->email);
            $msg = 'A 6-digit access code has been sent to your email.';
        } else {
            $wa->sendMessage($user->phone, "Your Lexoria Diamond access code is: {$otp}. It will expire in 10 minutes.");
            $request->session()->put('otp_login_id', $user->phone);
            $msg = 'A 6-digit access code has been sent to your WhatsApp.';
        }

        return redirect()->route('otp.verify')->with('success', $msg);
    }

    public function showRegister()
    {
        return view('frontend.auth.register');
    }

    public function register(Request $request, WhatsAppService $wa)
    {
        $disposableDomains = [
            'mailinator.com', 'yopmail.com', 'tempmail.com', 'guerrillamail.com', 
            'sharklasers.com', 'trashmail.com', '10minutemail.com', 'dispostable.com',
            'getairmail.com', 'guerrillamail.biz', 'guerrillamail.de'
        ];

        $emailDomain = substr(strrchr($request->email, "@"), 1);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users',
            'email' => [
                'required', 'string', 'email', 'max:255', 'unique:users',
                function ($attribute, $value, $fail) use ($disposableDomains, $emailDomain) {
                    if (in_array(strtolower($emailDomain), $disposableDomains)) {
                        $fail('Disguises are not permitted in the palace. Please provide a verified personal or professional email address.');
                    }
                },
            ],
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        // Generate 6 digit OTP to verify their account initially
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_expires_at = now()->addMinutes(10);
        $user->save();

        // Send OTP to BOTH Email and WhatsApp
        Mail::to($user->email)->send(new OtpMail($otp));
        $wa->sendMessage($user->phone, "Welcome to Lexoria Diamond! Your verification code is: {$otp}.");

        $request->session()->put('otp_login_id', $user->email); // can use email to identify

        return redirect()->route('otp.verify')->with('success', 'Your account has been created. A 6-digit access code has been sent to both your email and WhatsApp to verify your account.');
    }

    public function showOtpVerify(Request $request)
    {
        if (!$request->session()->has('otp_login_id')) {
            return redirect()->route('login');
        }

        return view('frontend.auth.otp-verify');
    }

    public function verifyOtp(Request $request)
    {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'otp' => 'required|numeric|digits:6',
        ]);

        if ($validator->fails()) {
            if ($request->expectsJson()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            return back()->withErrors($validator);
        }

        $loginId = $request->session()->get('otp_login_id');
        if (!$loginId) {
            if ($request->expectsJson()) return response()->json(['message' => 'Session expired. Please try again.'], 400);
            return redirect()->route('login')->withErrors(['login_id' => 'Session expired. Please try again.']);
        }

        $isEmail = filter_var($loginId, FILTER_VALIDATE_EMAIL);
        $user = $isEmail ? User::where('email', $loginId)->first() : User::where('phone', $loginId)->first();

        if (!$user) {
            if ($request->expectsJson()) return response()->json(['message' => 'User not found.'], 400);
            return redirect()->route('login')->withErrors(['email' => 'User not found.']);
        }

        if ($user->otp !== $request->otp) {
            if ($request->expectsJson()) return response()->json(['errors' => ['otp' => ['The access code provided is incorrect.']]], 422);
            return back()->withErrors(['otp' => 'The access code provided is incorrect.']);
        }

        if (now()->greaterThan($user->otp_expires_at)) {
            if ($request->expectsJson()) return response()->json(['errors' => ['otp' => ['The access code has expired. Please request a new one.']]], 422);
            return back()->withErrors(['otp' => 'The access code has expired. Please request a new one.']);
        }

        // Check if new user
        $isNewUser = is_null($user->email_verified_at) || $user->created_at->diffInMinutes(now()) < 5;

        // OTP is valid
        $user->otp = null;
        $user->otp_expires_at = null;
        if (!$user->email_verified_at) {
            $user->email_verified_at = now();
        }
        $user->save();

        Auth::login($user);
        $request->session()->forget('otp_login_id');
        $request->session()->regenerate();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'name' => $user->name,
                'is_new_user' => $isNewUser,
                'redirect' => route('profile.index')
            ]);
        }

        return redirect()->intended(route('profile.index'))->with('success', 'Welcome to your royal dashboard.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Password Reset Methods
    public function showForgotPassword()
    {
        return view('frontend.auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => Hash::make($token), 'created_at' => now()]
        );

        $user = User::where('email', $request->email)->first();
        Mail::to($request->email)->send(new ResetPasswordMail($token, $user));

        if ($user && $user->phone) {
            $resetLink = route('password.reset', ['token' => $token, 'email' => $request->email]);
            $message = "*Lexoria Diamond Studio* 🔒\n\nA password reset was requested for your account.\nClick here to securely reset it: {$resetLink}";
            app(WhatsAppService::class)->sendMessage($user->phone, $message);
        }

        return back()->with('success', 'The royal treasury has issued a reset link. Please check your scrolls (inbox).');
    }

    public function showResetPassword($token)
    {
        return view('frontend.auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required'
        ]);

        $reset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$reset || !Hash::check($request->token, $reset->token)) {
            return back()->withErrors(['email' => 'This reset token is invalid or has expired.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Your access to the palace has been restored. You may now login.');
    }
}
