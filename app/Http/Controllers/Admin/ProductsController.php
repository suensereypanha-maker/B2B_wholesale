<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductsController extends Controller
{
    /**
     * Display a listing of all products.
     */
    public function index(Request $request): View|RedirectResponse
    {
        if (!auth('admin')->check()) {
            $user = auth('web')->user() ?? auth()->user();
            if ($user && $user->hasRole('supplier') && !$user->isSuperAdmin() && !$user->hasRole('admin')) {
                return redirect()->route('supplier.products');
            }
        }

        $query = Product::with(['category', 'brand', 'supplier']);

        $filter     = $request->query('filter', 'all');
        $search     = $request->query('search');
        $categoryId = $request->query('category_id');
        $brandId    = $request->query('brand_id');
        $supplierId = $request->query('supplier_id');

        // Search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
        if ($brandId) {
            $query->where('brand_id', $brandId);
        }
        if ($supplierId) {
            $query->where('supplier_id', $supplierId);
        }

        // Tab filter
        switch ($filter) {
            case 'in_stock':
                $query->where('stock_qty', '>', 0);
                break;
            case 'low_stock':
                $query->where('stock_qty', '>', 0)->where('stock_qty', '<=', 10);
                break;
            case 'featured':
                $query->where('is_featured', true);
                break;
            case 'inactive':
                $query->where('is_active', false);
                break;
        }

        $products = $query->orderByDesc('created_at')->get();

        $categories = Category::orderBy('name')->get();
        $brands     = Brand::orderBy('name')->get();
        $suppliers  = Supplier::orderBy('company_name')->get();

        $counts = [
            'all'       => Product::count(),
            'in_stock'  => Product::where('stock_qty', '>', 0)->count(),
            'low_stock' => Product::where('stock_qty', '>', 0)->where('stock_qty', '<=', 10)->count(),
            'featured'  => Product::where('is_featured', true)->count(),
            'inactive'  => Product::where('is_active', false)->count(),
        ];

        return view('admin.products.index', compact(
            'products',
            'categories',
            'brands',
            'suppliers',
            'filter',
            'search',
            'categoryId',
            'brandId',
            'supplierId',
            'counts'
        ));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $brands     = Brand::orderBy('name')->get();
        $suppliers  = Supplier::where('is_active', true)
                        ->where(function ($q) {
                            $q->whereHas('user', fn($u) => $u->whereHas('role', fn($r) => $r->where('slug', 'supplier'))->where('is_active', true))
                              ->orWhereNull('user_id');
                        })
                        ->orderBy('company_name')
                        ->get();

        return view('admin.products.create', compact('categories', 'brands', 'suppliers'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'sku'               => 'nullable|string|max:100|unique:products,sku',
            'slug'              => 'nullable|string|max:255|unique:products,slug',
            'category_id'       => 'required|exists:categories,id',
            'brand_id'          => 'nullable|exists:brands,id',
            'supplier_id'       => 'nullable|exists:suppliers,id',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string|max:2000',
            'cost_price'        => 'required|numeric|min:0',
            'wholesale_price'   => 'required|numeric|min:0',
            'retail_price'      => 'nullable|numeric|min:0',
            'min_order_qty'     => 'required|integer|min:1',
            'stock_qty'         => 'required|integer|min:0',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $sku = !empty($validated['sku'])
            ? strtoupper($validated['sku'])
            : 'PROD-' . strtoupper(Str::random(8));

        $slug = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name'              => $validated['name'],
            'sku'               => $sku,
            'slug'              => $slug,
            'category_id'       => $validated['category_id'],
            'brand_id'          => $validated['brand_id'] ?? null,
            'supplier_id'       => $validated['supplier_id'] ?? null,
            'short_description' => $validated['short_description'] ?? null,
            'description'       => $validated['description'] ?? null,
            'cost_price'        => $validated['cost_price'],
            'wholesale_price'   => $validated['wholesale_price'],
            'retail_price'      => $validated['retail_price'] ?? null,
            'min_order_qty'     => $validated['min_order_qty'],
            'stock_qty'         => $validated['stock_qty'],
            'image'             => $imagePath,
            'is_active'         => $request->boolean('is_active', true),
            'is_featured'       => $request->boolean('is_featured', false),
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', "Product \"{$product->name}\" created successfully.");
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();
        $brands     = Brand::orderBy('name')->get();
        $suppliers  = Supplier::where('is_active', true)
                        ->where(function ($q) {
                            $q->whereHas('user', fn($u) => $u->whereHas('role', fn($r) => $r->where('slug', 'supplier'))->where('is_active', true))
                              ->orWhereNull('user_id');
                        })
                        ->orderBy('company_name')
                        ->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands', 'suppliers'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'sku'               => "required|string|max:100|unique:products,sku,{$product->id}",
            'slug'              => "nullable|string|max:255|unique:products,slug,{$product->id}",
            'category_id'       => 'required|exists:categories,id',
            'brand_id'          => 'nullable|exists:brands,id',
            'supplier_id'       => 'nullable|exists:suppliers,id',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string|max:2000',
            'cost_price'        => 'required|numeric|min:0',
            'wholesale_price'   => 'required|numeric|min:0',
            'retail_price'      => 'nullable|numeric|min:0',
            'min_order_qty'     => 'required|integer|min:1',
            'stock_qty'         => 'required|integer|min:0',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $slug = !empty($validated['slug'])
            ? Str::slug($validated['slug'])
            : Str::slug($validated['name']);

        $originalSlug = $slug;
        $counter = 1;
        while (Product::where('slug', $slug)->where('id', '!=', $product->id)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name'              => $validated['name'],
            'sku'               => strtoupper($validated['sku']),
            'slug'              => $slug,
            'category_id'       => $validated['category_id'],
            'brand_id'          => $validated['brand_id'] ?? null,
            'supplier_id'       => $validated['supplier_id'] ?? null,
            'short_description' => $validated['short_description'] ?? null,
            'description'       => $validated['description'] ?? null,
            'cost_price'        => $validated['cost_price'],
            'wholesale_price'   => $validated['wholesale_price'],
            'retail_price'      => $validated['retail_price'] ?? null,
            'min_order_qty'     => $validated['min_order_qty'],
            'stock_qty'         => $validated['stock_qty'],
            'image'             => $imagePath,
            'is_active'         => $request->boolean('is_active', true),
            'is_featured'       => $request->boolean('is_featured', false),
        ]);

        return redirect()
            ->route('admin.products.index')
            ->with('success', "Product \"{$product->name}\" updated successfully.");
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $name = $product->name;
        $product->delete();

        return redirect()
            ->route('admin.products.index')
            ->with('success', "Product \"{$name}\" deleted successfully.");
    }

    /**
     * Toggle active status of a product.
     */
    public function toggleStatus(Product $product): RedirectResponse
    {
        $product->is_active = !$product->is_active;
        $product->save();

        $action = $product->is_active ? 'activated' : 'deactivated';

        return back()->with('success', "Product \"{$product->name}\" has been {$action}.");
    }

    /**
     * Toggle featured status of a product.
     */
    public function toggleFeatured(Product $product): RedirectResponse
    {
        $product->is_featured = !$product->is_featured;
        $product->save();

        $status = $product->is_featured ? 'marked as Featured' : 'unmarked as Featured';

        return back()->with('success', "Product \"{$product->name}\" has been {$status}.");
    }

    /**
     * Quick stock quantity update by admin.
     */
    public function updateStock(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'stock_qty' => 'required|integer|min:0',
        ]);

        $product->update([
            'stock_qty' => $validated['stock_qty'],
        ]);

        return back()->with('success', "Stock quantity for \"{$product->name}\" updated to {$product->stock_qty} units.");
    }
}
