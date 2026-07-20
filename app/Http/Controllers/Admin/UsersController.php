<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{
    /**
     * Display a listing of the users.
     */
    public function index(Request $request): View
    {
        $query = User::with('role');
        $filter = $request->query('filter', 'all');

        // Apply filters based on query param
        switch ($filter) {
            case 'pending_suppliers':
                $query->whereHas('role', function ($q) {
                    $q->where('slug', 'supplier');
                })->where('is_active', false);
                break;
            case 'suppliers':
                $query->whereHas('role', function ($q) {
                    $q->where('slug', 'supplier');
                });
                break;
            case 'buyers':
                $query->whereHas('role', function ($q) {
                    $q->where('slug', 'viewer');
                });
                break;
            case 'staff':
                $query->whereHas('role', function ($q) {
                    $q->whereIn('slug', ['super-admin', 'admin', 'manager', 'sales-agent', 'warehouse-staff']);
                });
                break;
        }

        $users = $query->orderBy('name')->get();

        // Get counts for helper badges
        $counts = [
            'all'               => User::count(),
            'pending_suppliers' => User::where('is_active', false)
                                    ->whereHas('role', function ($q) {
                                        $q->where('slug', 'supplier');
                                    })->count(),
            'suppliers'         => User::whereHas('role', function ($q) {
                                        $q->where('slug', 'supplier');
                                    })->count(),
            'buyers'            => User::whereHas('role', function ($q) {
                                        $q->where('slug', 'viewer');
                                    })->count(),
            'staff'             => User::whereHas('role', function ($q) {
                                        $q->whereIn('slug', ['super-admin', 'admin', 'manager', 'sales-agent', 'warehouse-staff']);
                                    })->count(),
        ];

        return view('admin.users.index', compact('users', 'filter', 'counts'));
    }

    /**
     * Toggle active/approval status of a user.
     */
    public function toggleStatus(User $user): RedirectResponse
    {
        // Don't allow toggling super admin or current logged-in user
        if ($user->isSuperAdmin()) {
            return back()->with('error', 'Super Admin status cannot be toggled.');
        }

        if ($user->id === auth('admin')->id()) {
            return back()->with('error', 'You cannot toggle your own status.');
        }

        $user->is_active = !$user->is_active;
        $user->save();

        $action = $user->is_active ? 'approved/activated' : 'deactivated';
        
        return back()->with('success', "User \"{$user->name}\" has been {$action} successfully.");
    }
}
