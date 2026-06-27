<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CrmMiddleware
{
    /**
     * Handle an incoming request.
     * Allows access if user is admin OR has crm_access enabled.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('crm.login');
        }

        $user = Auth::user();

        // Allow access if user is admin OR has CRM access
        if (!$user->is_admin && !$user->crm_access) {
            Auth::logout();
            return redirect()->route('crm.login')->withErrors([
                'email' => 'You do not have access to the CRM. Contact your administrator.',
            ]);
        }

        return $next($request);
    }
}
