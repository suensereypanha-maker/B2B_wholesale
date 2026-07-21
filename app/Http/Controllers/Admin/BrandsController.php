<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BrandsController extends Controller
{
    /**
     * Display a listing of all brands.
     */
    public function index(Request $request): View
    {
        $query = Brand::query();

        $filter = $request->query('filter', 'all');
        $search = $request->query('search');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('website', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        switch ($filter) {
            case 'active':
                $query->where('is_active', true);
                break;
            case 'featured':
                $query->where('is_featured', true);
                break;
            case 'inactive':
                $query->where('is_active', false);
                break;
        }

        $brands = $query->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $counts = [
            'all'      => Brand::count(),
            'active'   => Brand::where('is_active', true)->count(),
            'featured' => Brand::where('is_featured', true)->count(),
            'inactive' => Brand::where('is_active', false)->count(),
        ];

        return view('admin.brands.index', compact('brands', 'filter', 'search', 'counts'));
    }

    /**
     * Show the form for creating a new brand.
     */
    public function create(): View
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created brand in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:brands,slug',
            'website'     => 'nullable|url|max:255',
            'description' => 'nullable|string|max:1000',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $slug = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $originalSlug = $slug;
        $counter = 1;
        while (Brand::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('brands', 'public');
        }

        $brand = Brand::create([
            'name'        => $validated['name'],
            'slug'        => $slug,
            'website'     => $validated['website'] ?? null,
            'description' => $validated['description'] ?? null,
            'logo'        => $logoPath,
            'is_active'   => $request->boolean('is_active', true),
            'is_featured' => $request->boolean('is_featured', false),
            'sort_order'  => $validated['sort_order'] ?? 0,
        ]);

        return redirect()
            ->route('admin.brands.index')
            ->with('success', "Brand \"{$brand->name}\" created successfully.");
    }

    /**
     * Show the form for editing the specified brand.
     */
    public function edit(Brand $brand): View
    {
        return view('admin.brands.edit', compact('brand'));
    }

    /**
     * Update the specified brand in storage.
     */
    public function update(Request $request, Brand $brand): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => "nullable|string|max:255|unique:brands,slug,{$brand->id}",
            'website'     => 'nullable|url|max:255',
            'description' => 'nullable|string|max:1000',
            'logo'        => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $slug = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $originalSlug = $slug;
        $counter = 1;
        while (Brand::where('slug', $slug)->where('id', '!=', $brand->id)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $logoPath = $brand->logo;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('brands', 'public');
        }

        $brand->update([
            'name'        => $validated['name'],
            'slug'        => $slug,
            'website'     => $validated['website'] ?? null,
            'description' => $validated['description'] ?? null,
            'logo'        => $logoPath,
            'is_active'   => $request->boolean('is_active', true),
            'is_featured' => $request->boolean('is_featured', false),
            'sort_order'  => $validated['sort_order'] ?? 0,
        ]);

        return redirect()
            ->route('admin.brands.index')
            ->with('success', "Brand \"{$brand->name}\" updated successfully.");
    }

    /**
     * Remove the specified brand from storage.
     */
    public function destroy(Brand $brand): RedirectResponse
    {
        $name = $brand->name;
        $brand->delete();

        return redirect()
            ->route('admin.brands.index')
            ->with('success', "Brand \"{$name}\" deleted successfully.");
    }

    /**
     * Toggle active status of a brand.
     */
    public function toggleStatus(Brand $brand): RedirectResponse
    {
        $brand->is_active = !$brand->is_active;
        $brand->save();

        $action = $brand->is_active ? 'activated' : 'deactivated';

        return back()->with('success', "Brand \"{$brand->name}\" has been {$action}.");
    }

    /**
     * Toggle featured status of a brand.
     */
    public function toggleFeatured(Brand $brand): RedirectResponse
    {
        $brand->is_featured = !$brand->is_featured;
        $brand->save();

        $status = $brand->is_featured ? 'marked as Featured' : 'unmarked as Featured';

        return back()->with('success', "Brand \"{$brand->name}\" has been {$status}.");
    }
}
