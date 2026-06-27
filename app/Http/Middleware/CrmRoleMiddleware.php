<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CrmRoleMiddleware
{
    /**
     * Handle an incoming request.
     * Check if user has the required CRM role.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('crm.login');
        }

        // Admin always has access to everything
        if ($user->is_admin || $user->crm_role === 'admin') {
            return $next($request);
        }

        // Check if user's CRM role is in the allowed roles
        if (!in_array($user->crm_role, $roles)) {
            abort(403, 'You do not have permission to access this section.');
        }

        return $next($request);
    }
}
