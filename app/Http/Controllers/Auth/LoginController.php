<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController extends Controller
{
    /**
     * Show the standard login form (suppliers / buyers).
     */
    public function showLoginForm(): View
    {
        return view('auth.login');
    }

    /**
     * Show the admin login form.
     */
    public function showAdminLoginForm(): View
    {
        return view('auth.admin_login');
    }

    /**
     * Handle standard login (suppliers / buyers).
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::guard('web')->user();
            
            // Check if active
            if (!$user->is_active) {
                Auth::guard('web')->logout();
                
                return back()
                    ->withInput($request->only('email'))
                    ->with('error', 'Your supplier account is pending administrator approval.');
            }

            $request->session()->regenerate();

            if ($user->hasRole('supplier')) {
                return redirect()->intended(route('supplier.dashboard'));
            }

            return redirect()->intended(route('buyer.portal'));
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
    }

    /**
     * Handle admin login.
     */
    public function adminLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->boolean('remember'))) {
            $user = Auth::guard('admin')->user();
            
            // Check if this user has an administrative role
            if ($user->isSuperAdmin() || $user->hasRole('admin') || $user->hasRole('manager') || $user->hasRole('sales-agent') || $user->hasRole('warehouse-staff')) {
                $request->session()->regenerate();
                return redirect()->intended(route('admin.dashboard'));
            }
            
            // If they are not admin but somehow logged into the admin guard, log them out
            Auth::guard('admin')->logout();
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Access denied. This portal is for administrators only.');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
    }

    /**
     * Log the user out of the web guard (suppliers / buyers).
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        return redirect()->route('login')->with('success', 'You have been successfully logged out.');
    }

    /**
     * Log the user out of the admin guard.
     */
    public function adminLogout(Request $request): RedirectResponse
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login')->with('success', 'You have been successfully logged out of the admin portal.');
    }
}
