<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PermissionsController extends Controller
{
    /**
     * Display a listing of all permissions, grouped by module.
     */
    public function index(): View
    {
        $permissionsByModule = Permission::with('roles')
            ->orderBy('module')
            ->orderBy('name')
            ->get()
            ->groupBy('module');

        $roles            = Role::orderBy('name')->get();
        $totalPermissions = Permission::count();
        $totalModules     = Permission::distinct('module')->count('module');

        return view('admin.permissions.index', compact(
            'permissionsByModule',
            'roles',
            'totalPermissions',
            'totalModules'
        ));
    }

    /**
     * Show the form for creating a new permission.
     */
    public function create(): View
    {
        // Pass distinct existing modules for the datalist
        $modules = Permission::select('module')
            ->distinct()
            ->orderBy('module')
            ->pluck('module');

        return view('admin.permissions.create', compact('modules'));
    }

    /**
     * Store a newly created permission in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'module'      => 'required|string|max:50',
            'description' => 'nullable|string|max:500',
        ]);

        // Auto-generate slug from module + name
        $slug = Str::slug($validated['module']) . '.' . Str::slug($validated['name']);

        // Ensure slug uniqueness
        $baseSlug = $slug;
        $counter  = 1;
        while (Permission::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        $permission = Permission::create([
            'name'        => $validated['name'],
            'slug'        => $slug,
            'module'      => Str::slug($validated['module']),
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', "Permission \"{$permission->name}\" created successfully.");
    }

    /**
     * Show the form for editing the specified permission.
     */
    public function edit(Permission $permission): View
    {
        $modules = Permission::select('module')
            ->distinct()
            ->orderBy('module')
            ->pluck('module');

        return view('admin.permissions.create', compact('permission', 'modules'));
    }

    /**
     * Update the specified permission in storage.
     */
    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:100',
            'module'      => 'required|string|max:50',
            'description' => 'nullable|string|max:500',
        ]);

        $permission->update([
            'name'        => $validated['name'],
            'module'      => Str::slug($validated['module']),
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', "Permission \"{$permission->name}\" updated successfully.");
    }

    /**
     * Remove the specified permission from storage.
     */
    public function destroy(Permission $permission): RedirectResponse
    {
        $name = $permission->name;
        // Pivot rows are deleted automatically due to cascade
        $permission->delete();

        return redirect()
            ->route('admin.permissions.index')
            ->with('success', "Permission \"{$name}\" deleted successfully.");
    }
}
