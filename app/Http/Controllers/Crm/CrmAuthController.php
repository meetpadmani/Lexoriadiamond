<?php

namespace App\Http\Controllers\Crm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CrmAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check() && (Auth::user()->is_admin || Auth::user()->crm_access)) {
            return redirect()->route('crm.dashboard');
        }
        return view('crm.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $user = Auth::user();

            if ($user->is_admin || $user->crm_access) {
                $request->session()->regenerate();
                return redirect()->intended(route('crm.dashboard'));
            }

            Auth::logout();
            return back()->withErrors([
                'email' => 'You do not have CRM access. Contact your administrator.',
            ]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('crm.login');
    }
}
