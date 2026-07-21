<?php

namespace App\Http\Controllers\Supplier;

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
     * Get current logged-in supplier profile.
     */
    private function getSupplierProfile(): ?Supplier
    {
        $user = auth()->user();
        if (!$user) {
            return null;
        }

        return Supplier::firstOrCreate(
            ['email' => $user->email],
            [
                'user_id'      => $user->id,
                'company_name' => $user->name,
                'contact_name' => $user->name,
                'email'        => $user->email,
                'is_active'    => $user->is_active,
            ]
        );
    }

    /**
     * Display supplier's own products and stock status.
     */
    public function index(Request $request): View
    {
        $supplier = $this->getSupplierProfile();

        $query = Product::with(['category', 'brand']);

        if ($supplier) {
            $query->where('supplier_id', $supplier->id);
        } else {
            // If no linked supplier profile found, return empty query
            $query->whereRaw('1 = 0');
        }

        $filter = $request->query('filter', 'all');
        $search = $request->query('search');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%");
            });
        }

        switch ($filter) {
            case 'in_stock':
                $query->where('stock_qty', '>', 10);
                break;
            case 'low_stock':
                $query->where('stock_qty', '>', 0)->where('stock_qty', '<=', 10);
                break;
            case 'out_of_stock':
                $query->where('stock_qty', '<=', 0);
                break;
        }

        $products = $query->orderByDesc('created_at')->get();

        $supplierId = $supplier?->id ?? 0;

        $counts = [
            'all'          => Product::where('supplier_id', $supplierId)->count(),
            'in_stock'     => Product::where('supplier_id', $supplierId)->where('stock_qty', '>', 10)->count(),
            'low_stock'    => Product::where('supplier_id', $supplierId)->where('stock_qty', '>', 0)->where('stock_qty', '<=', 10)->count(),
            'out_of_stock' => Product::where('supplier_id', $supplierId)->where('stock_qty', '<=', 0)->count(),
        ];

        return view('supplier.products.index', compact('products', 'supplier', 'filter', 'search', 'counts'));
    }

    /**
     * Show form to create a new product for this supplier.
     */
    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $brands     = Brand::orderBy('name')->get();

        return view('supplier.products.create', compact('categories', 'brands'));
    }

    /**
     * Store new product submitted by supplier.
     */
    public function store(Request $request): RedirectResponse
    {
        $supplier = $this->getSupplierProfile();

        if (!$supplier) {
            return back()->with('error', 'Supplier profile not found.');
        }

        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'sku'               => 'nullable|string|max:100|unique:products,sku',
            'category_id'       => 'required|exists:categories,id',
            'brand_id'          => 'nullable|exists:brands,id',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string|max:2000',
            'cost_price'        => 'required|numeric|min:0',
            'wholesale_price'   => 'required|numeric|min:0',
            'min_order_qty'     => 'required|integer|min:1',
            'stock_qty'         => 'required|integer|min:0',
            'image'             => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $sku = !empty($validated['sku'])
            ? strtoupper($validated['sku'])
            : 'SUPP-' . strtoupper(Str::random(8));

        $slug = Str::slug($validated['name']);
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
            'supplier_id'       => $supplier->id,
            'short_description' => $validated['short_description'] ?? null,
            'description'       => $validated['description'] ?? null,
            'cost_price'        => $validated['cost_price'],
            'wholesale_price'   => $validated['wholesale_price'],
            'min_order_qty'     => $validated['min_order_qty'],
            'stock_qty'         => $validated['stock_qty'],
            'image'             => $imagePath,
            'is_active'         => true,
        ]);

        return redirect()
            ->route('supplier.products')
            ->with('success', "Product \"{$product->name}\" added to your catalog successfully.");
    }

    /**
     * Quick stock quantity update by supplier.
     */
    public function updateStock(Request $request, Product $product): RedirectResponse
    {
        $supplier = $this->getSupplierProfile();

        if (!$supplier || $product->supplier_id != $supplier->id) {
            return back()->with('error', 'Unauthorized action.');
        }

        $validated = $request->validate([
            'stock_qty'       => 'required|integer|min:0',
            'wholesale_price' => 'required|numeric|min:0',
        ]);

        $product->update([
            'stock_qty'       => $validated['stock_qty'],
            'wholesale_price' => $validated['wholesale_price'],
        ]);

        return back()->with('success', "Stock and pricing updated for \"{$product->name}\".");
    }
}
