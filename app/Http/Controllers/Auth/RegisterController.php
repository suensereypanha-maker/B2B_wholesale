<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisterController extends Controller
{
    /**
     * Show the registration form.
     */
    public function showRegistrationForm(): View
    {
        return view('auth.register');
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request): RedirectResponse
    {
        $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'registration_role' => ['required', 'string', 'in:buyer,supplier'],
            'password'          => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $isSupplier = $request->input('registration_role') === 'supplier';
        
        // Find corresponding role in database
        $roleSlug = $isSupplier ? 'supplier' : 'viewer'; // 'viewer' is seeded as the default Buyer role
        $role = Role::where('slug', $roleSlug)->first();

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'role_id'   => $role ? $role->id : null,
            'is_active' => !$isSupplier, // Suppliers are inactive (pending approval)
            'password'  => Hash::make($request->password),
        ]);

        if ($isSupplier) {
            // Redirect supplier to the pending review screen
            return redirect()->route('pending')
                ->with('success', 'Supplier account created successfully. Please wait for admin approval.');
        }

        // For buyers, auto-login and redirect to dashboard
        Auth::guard('web')->login($user);

        return redirect()->route('buyer.portal');
    }

    /**
     * Display pending registration screen.
     */
    public function pending(): View
    {
        return view('auth.pending');
    }
}
