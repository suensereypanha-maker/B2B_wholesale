<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    /**
     * Display a listing of categories and subcategories.
     */
    public function index(Request $request): View
    {
        $query = Category::with(['parent', 'subcategories']);

        $filter = $request->query('filter', 'all');
        $search = $request->query('search');
        $parentId = $request->query('parent_id');

        // Search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%");
            });
        }

        // Parent filter
        if ($parentId) {
            $query->where('parent_id', $parentId);
        }

        // Tab filter
        switch ($filter) {
            case 'parents':
                $query->whereNull('parent_id');
                break;
            case 'subcategories':
                $query->whereNotNull('parent_id');
                break;
            case 'inactive':
                $query->where('is_active', false);
                break;
        }

        $categories = $query->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Dropdown list of main parent categories for forms & filters
        $parentCategories = Category::whereNull('parent_id')
            ->orderBy('name')
            ->get();

        // Helper stats counts
        $counts = [
            'all'           => Category::count(),
            'parents'       => Category::whereNull('parent_id')->count(),
            'subcategories' => Category::whereNotNull('parent_id')->count(),
            'inactive'      => Category::where('is_active', false)->count(),
        ];

        return view('admin.categories.index', compact(
            'categories',
            'parentCategories',
            'filter',
            'search',
            'parentId',
            'counts'
        ));
    }

    /**
     * Show the form for creating a new category or subcategory.
     */
    public function create(Request $request): View
    {
        $selectedParentId = $request->query('parent_id');
        $parentCategories = Category::whereNull('parent_id')->orderBy('name')->get();

        return view('admin.categories.create', compact('parentCategories', 'selectedParentId'));
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:categories,slug',
            'parent_id'   => 'nullable|exists:categories,id',
            'description' => 'nullable|string|max:1000',
            'icon'        => 'nullable|string|max:100',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $slug = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        // Ensure unique slug if collision occurs
        $originalSlug = $slug;
        $counter = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        $category = Category::create([
            'name'        => $validated['name'],
            'slug'        => $slug,
            'parent_id'   => $validated['parent_id'] ?? null,
            'description' => $validated['description'] ?? null,
            'icon'        => $validated['icon'] ?? ($validated['parent_id'] ? 'bi-tag-fill' : 'bi-folder-fill'),
            'image'       => $imagePath,
            'is_active'   => $request->boolean('is_active', true),
            'sort_order'  => $validated['sort_order'] ?? 0,
        ]);

        $typeLabel = $category->is_subcategory ? 'Subcategory' : 'Category';

        return redirect()
            ->route('admin.categories.index')
            ->with('success', "{$typeLabel} \"{$category->name}\" created successfully.");
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category): View
    {
        // Exclude current category and its subcategories to prevent circular parent references
        $parentCategories = Category::whereNull('parent_id')
            ->where('id', '!=', $category->id)
            ->orderBy('name')
            ->get();

        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => "nullable|string|max:255|unique:categories,slug,{$category->id}",
            'parent_id'   => "nullable|exists:categories,id|different:{$category->id}",
            'description' => 'nullable|string|max:1000',
            'icon'        => 'nullable|string|max:100',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $slug = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        // Check unique slug excluding current
        $originalSlug = $slug;
        $counter = 1;
        while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        $category->update([
            'name'        => $validated['name'],
            'slug'        => $slug,
            'parent_id'   => $validated['parent_id'] ?? null,
            'description' => $validated['description'] ?? null,
            'icon'        => $validated['icon'] ?? $category->icon,
            'image'       => $imagePath,
            'is_active'   => $request->boolean('is_active', true),
            'sort_order'  => $validated['sort_order'] ?? 0,
        ]);

        $typeLabel = $category->is_subcategory ? 'Subcategory' : 'Category';

        return redirect()
            ->route('admin.categories.index')
            ->with('success', "{$typeLabel} \"{$category->name}\" updated successfully.");
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $name = $category->name;
        $subCount = $category->subcategories()->count();

        $category->delete();

        $message = "Category \"{$name}\" deleted successfully.";
        if ($subCount > 0) {
            $message .= " ({$subCount} child subcategories were also removed).";
        }

        return redirect()
            ->route('admin.categories.index')
            ->with('success', $message);
    }

    /**
     * Toggle active/inactive status of a category.
     */
    public function toggleStatus(Category $category): RedirectResponse
    {
        $category->is_active = !$category->is_active;
        $category->save();

        $statusText = $category->is_active ? 'activated' : 'deactivated';

        return back()->with('success', "Category \"{$category->name}\" has been {$statusText}.");
    }
}
