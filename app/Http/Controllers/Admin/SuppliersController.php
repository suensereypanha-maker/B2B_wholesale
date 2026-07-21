<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class SuppliersController extends Controller
{
    /**
     * Display a listing of all suppliers.
     */
    public function index(Request $request): View
    {
        // Auto-sync any Users with role 'supplier' into suppliers table
        $supplierUsers = User::whereHas('role', fn($q) => $q->where('slug', 'supplier'))->get();
        foreach ($supplierUsers as $su) {
            Supplier::firstOrCreate(
                ['email' => $su->email],
                [
                    'user_id'      => $su->id,
                    'company_name' => $su->name,
                    'contact_name' => $su->name,
                    'email'        => $su->email,
                    'is_active'    => $su->is_active,
                ]
            );
        }

        $query = Supplier::with(['user', 'products']);

        $filter = $request->query('filter', 'all');
        $search = $request->query('search');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('company_name', 'like', "%{$search}%")
                  ->orWhere('contact_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        switch ($filter) {
            case 'approved':
                $query->where('is_active', true);
                break;
            case 'pending':
                $query->where('is_active', false);
                break;
        }

        $suppliers = $query->orderByDesc('created_at')->get();

        $counts = [
            'all'      => Supplier::count(),
            'approved' => Supplier::where('is_active', true)->count(),
            'pending'  => Supplier::where('is_active', false)->count(),
        ];

        return view('admin.suppliers.index', compact('suppliers', 'filter', 'search', 'counts'));
    }

    /**
     * Show form for creating a new supplier.
     */
    public function create(): View
    {
        return view('admin.suppliers.create');
    }

    /**
     * Store a newly created supplier and optional user account.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'email'        => 'required|email|max:255|unique:suppliers,email|unique:users,email',
            'phone'        => 'nullable|string|max:50',
            'address'      => 'nullable|string|max:500',
            'create_user'  => 'nullable|boolean',
            'password'     => 'nullable|string|min:6',
        ]);

        $userId = null;

        if ($request->boolean('create_user')) {
            $supplierRole = Role::where('slug', 'supplier')->first();

            $user = User::create([
                'name'      => $validated['contact_name'] ?: $validated['company_name'],
                'email'     => $validated['email'],
                'password'  => Hash::make($validated['password'] ?? 'password'),
                'role_id'   => $supplierRole?->id,
                'is_active' => $request->boolean('is_active', true),
            ]);

            $userId = $user->id;
        }

        $supplier = Supplier::create([
            'user_id'      => $userId,
            'company_name' => $validated['company_name'],
            'contact_name' => $validated['contact_name'] ?? null,
            'email'        => $validated['email'],
            'phone'        => $validated['phone'] ?? null,
            'address'      => $validated['address'] ?? null,
            'is_active'    => $request->boolean('is_active', true),
        ]);

        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', "Supplier \"{$supplier->company_name}\" added successfully.");
    }

    /**
     * Show form for editing a supplier.
     */
    public function edit(Supplier $supplier): View
    {
        return view('admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Update specified supplier in storage.
     */
    public function update(Request $request, Supplier $supplier): RedirectResponse
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'email'        => "required|email|max:255|unique:suppliers,email,{$supplier->id}",
            'phone'        => 'nullable|string|max:50',
            'address'      => 'nullable|string|max:500',
        ]);

        $supplier->update([
            'company_name' => $validated['company_name'],
            'contact_name' => $validated['contact_name'] ?? null,
            'email'        => $validated['email'],
            'phone'        => $validated['phone'] ?? null,
            'address'      => $validated['address'] ?? null,
            'is_active'    => $request->boolean('is_active', true),
        ]);

        if ($supplier->user) {
            $supplier->user->update([
                'name'      => $validated['contact_name'] ?: $validated['company_name'],
                'email'     => $validated['email'],
                'is_active' => $request->boolean('is_active', true),
            ]);
        }

        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', "Supplier \"{$supplier->company_name}\" updated successfully.");
    }

    /**
     * Remove specified supplier.
     */
    public function destroy(Supplier $supplier): RedirectResponse
    {
        $name = $supplier->company_name;
        
        if ($supplier->user) {
            $supplier->user->delete();
        }

        $supplier->delete();

        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', "Supplier \"{$name}\" deleted successfully.");
    }

    /**
     * Toggle active/approval status of a supplier.
     */
    public function toggleStatus(Supplier $supplier): RedirectResponse
    {
        $supplier->is_active = !$supplier->is_active;
        $supplier->save();

        if ($supplier->user) {
            $supplier->user->is_active = $supplier->is_active;
            $supplier->user->save();
        }

        $status = $supplier->is_active ? 'approved and activated' : 'deactivated';

        return back()->with('success', "Supplier \"{$supplier->company_name}\" has been {$status}.");
    }
}
