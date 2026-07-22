<?php

namespace App\Http\Middleware;

use App\Models\Supplier;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSupplierApproved
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // If user is not active, block access
        if (!$user->is_active) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Supplier account is pending administrator approval.'], 403);
            }
            return redirect()->route('pending')
                ->with('error', 'Your supplier account is currently pending administrator approval or has been deactivated.');
        }

        // Check linked Supplier profile status if applicable
        $supplier = Supplier::where('user_id', $user->id)
            ->orWhere('email', $user->email)
            ->first();

        if ($supplier && !$supplier->is_active) {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Supplier company profile is pending administrator approval.'], 403);
            }
            return redirect()->route('pending')
                ->with('error', 'Your supplier company profile is currently pending administrator approval or deactivated.');
        }

        return $next($request);
    }
}
