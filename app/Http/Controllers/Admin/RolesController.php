<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RolesController extends Controller
{
    /**
     * Display a listing of all roles.
     */
    public function index(): View
    {
        $roles = Role::withCount(['users', 'permissions'])
            ->orderByDesc('is_system')
            ->orderBy('name')
            ->get();

        // Group permissions by module for the matrix preview
        $permissionsByModule = Permission::orderBy('module')
            ->orderBy('name')
            ->get()
            ->groupBy('module');

        $totalPermissions = Permission::count();
        $totalUsers       = \App\Models\User::count();

        return view('admin.roles.index', compact(
            'roles',
            'permissionsByModule',
            'totalPermissions',
            'totalUsers'
        ));
    }

    /**
     * Show the form for creating a new role.
     */
    public function create(): View
    {
        $permissionsByModule = Permission::orderBy('module')
            ->orderBy('name')
            ->get()
            ->groupBy('module');

        return view('admin.roles.create', compact('permissionsByModule'));
    }

    /**
     * Store a newly created role in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100|unique:roles,name',
            'description' => 'nullable|string|max:500',
            'color'       => 'required|string|max:20',
            'is_system'   => 'boolean',
            'permissions' => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role = Role::create([
            'name'        => $validated['name'],
            'slug'        => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'color'       => $validated['color'],
            'is_system'   => $request->boolean('is_system', false),
        ]);

        if (!empty($validated['permissions'])) {
            $role->syncPermissions($validated['permissions']);
        }

        return redirect()
            ->route('admin.roles.index')
            ->with('success', "Role \"{$role->name}\" created successfully with " . count($validated['permissions'] ?? []) . " permissions.");
    }

    /**
     * Display the specified role with its users and permissions.
     */
    public function show(Role $role): View
    {
        $role->load(['permissions', 'users.role']);

        $permissionsByModule = Permission::orderBy('module')
            ->orderBy('name')
            ->get()
            ->groupBy('module');

        $rolePermissionIds = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.show', compact(
            'role',
            'permissionsByModule',
            'rolePermissionIds'
        ));
    }

    /**
     * Show the form for editing the specified role.
     */
    public function edit(Role $role): View
    {
        $role->load('permissions');

        $permissionsByModule = Permission::orderBy('module')
            ->orderBy('name')
            ->get()
            ->groupBy('module');

        $rolePermissionIds = $role->permissions->pluck('id')->toArray();

        return view('admin.roles.edit', compact(
            'role',
            'permissionsByModule',
            'rolePermissionIds'
        ));
    }

    /**
     * Update the specified role in storage.
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        $validated = $request->validate([
            'name'          => "required|string|max:100|unique:roles,name,{$role->id}",
            'description'   => 'nullable|string|max:500',
            'color'         => 'required|string|max:20',
            'permissions'   => 'nullable|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->update([
            'name'        => $validated['name'],
            'slug'        => Str::slug($validated['name']),
            'description' => $validated['description'] ?? null,
            'color'       => $validated['color'],
        ]);

        $role->syncPermissions($validated['permissions'] ?? []);

        return redirect()
            ->route('admin.roles.index')
            ->with('success', "Role \"{$role->name}\" updated successfully.");
    }

    /**
     * Remove the specified role from storage.
     * System roles cannot be deleted.
     */
    public function destroy(Role $role): RedirectResponse
    {
        if ($role->is_system) {
            return redirect()
                ->route('admin.roles.index')
                ->with('error', "System role \"{$role->name}\" cannot be deleted.");
        }

        if ($role->users()->count() > 0) {
            return redirect()
                ->route('admin.roles.index')
                ->with('error', "Cannot delete \"{$role->name}\" — it has {$role->users()->count()} user(s) assigned.");
        }

        $roleName = $role->name;
        $role->delete();

        return redirect()
            ->route('admin.roles.index')
            ->with('success', "Role \"{$roleName}\" deleted successfully.");
    }
}
