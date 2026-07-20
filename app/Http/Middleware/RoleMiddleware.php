<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // If 'admin' parameter is passed, we allow any admin-related roles
        if (in_array('admin', $roles)) {
            if ($user->hasRole('supplier')) {
                abort(403, 'Unauthorized access to Admin Panel.');
            }
            return $next($request);
        }

        // Otherwise, check if user has any of the specified roles
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized access.');
    }
}
