<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductsController extends Controller
{
    /**
     * Get current logged-in supplier profile strictly linked to current authenticated user.
     */
    private function getSupplierProfile(): ?Supplier
    {
        $user = auth()->user();
        if (!$user) {
            return null;
        }

        $supplier = Supplier::where('user_id', $user->id)
            ->orWhere('email', $user->email)
            ->first();

        if ($supplier) {
            if (!$supplier->user_id) {
                $supplier->user_id = $user->id;
                $supplier->save();
            }
            return $supplier;
        }

        return Supplier::create([
            'user_id'      => $user->id,
            'company_name' => $user->name,
            'contact_name' => $user->name,
            'email'        => $user->email,
            'is_active'    => $user->is_active,
        ]);
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
    public function create(): View|RedirectResponse
    {
        $user = auth()->user();
        if (!$user?->hasPermission('products.create')) {
            return redirect()->route('supplier.products')->with('error', 'Administrator has not granted permission to add products.');
        }

        $categories = Category::orderBy('name')->get();
        $brands     = Brand::orderBy('name')->get();

        return view('supplier.products.create', compact('categories', 'brands'));
    }

    /**
     * Store new product submitted by supplier.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = auth()->user();
        if (!$user?->hasPermission('products.create')) {
            return back()->with('error', 'Administrator has not granted permission to add products.');
        }

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
     * Show form to edit an existing supplier product.
     */
    public function edit(Product $product): View|RedirectResponse
    {
        $user = auth()->user();
        if (!$user?->hasPermission('products.edit')) {
            return redirect()->route('supplier.products')->with('error', 'Administrator has not granted permission to edit products.');
        }

        $supplier = $this->getSupplierProfile();

        if (!$supplier || $product->supplier_id != $supplier->id) {
            return redirect()->route('supplier.products')->with('error', 'Unauthorized action.');
        }

        $categories = Category::orderBy('name')->get();
        $brands     = Brand::orderBy('name')->get();

        return view('supplier.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update an existing supplier product.
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $user = auth()->user();
        if (!$user?->hasPermission('products.edit')) {
            return redirect()->route('supplier.products')->with('error', 'Administrator has not granted permission to edit products.');
        }

        $supplier = $this->getSupplierProfile();

        if (!$supplier || $product->supplier_id != $supplier->id) {
            return redirect()->route('supplier.products')->with('error', 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'sku'               => "nullable|string|max:100|unique:products,sku,{$product->id}",
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

        // Low or Out of stock restriction check
        if ($product->stock_qty <= 10 && $validated['stock_qty'] > $product->stock_qty) {
            return back()->with('error', "Product \"{$product->name}\" is currently Low/Out of Stock (≤10). Stock increases must be requested from and updated by Administrator.");
        }

        $imagePath = $product->image;
        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name'              => $validated['name'],
            'sku'               => !empty($validated['sku']) ? strtoupper($validated['sku']) : $product->sku,
            'category_id'       => $validated['category_id'],
            'brand_id'          => $validated['brand_id'] ?? null,
            'short_description' => $validated['short_description'] ?? null,
            'description'       => $validated['description'] ?? null,
            'cost_price'        => $validated['cost_price'],
            'wholesale_price'   => $validated['wholesale_price'],
            'min_order_qty'     => $validated['min_order_qty'],
            'stock_qty'         => $validated['stock_qty'],
            'image'             => $imagePath,
        ]);

        return redirect()
            ->route('supplier.products')
            ->with('success', "Product \"{$product->name}\" updated successfully.");
    }

    /**
     * Remove product from supplier catalog.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $user = auth()->user();
        if (!$user?->hasPermission('products.delete')) {
            return back()->with('error', 'Administrator has not granted permission to delete products.');
        }

        $supplier = $this->getSupplierProfile();

        if (!$supplier || $product->supplier_id != $supplier->id) {
            return back()->with('error', 'Unauthorized action.');
        }

        $name = $product->name;
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()
            ->route('supplier.products')
            ->with('success', "Product \"{$name}\" removed from your catalog successfully.");
    }

    /**
     * Send restock request to administrator for low/out-of-stock item.
     */
    public function requestStock(Product $product): RedirectResponse
    {
        $supplier = $this->getSupplierProfile();

        if (!$supplier || $product->supplier_id != $supplier->id) {
            return back()->with('error', 'Unauthorized action.');
        }

        return back()->with('success', "Restock request for \"{$product->name}\" (SKU: {$product->sku}) sent to Administrator successfully. Administrator will update stock level once approved.");
    }

    /**
     * Quick stock quantity update by supplier.
     */
    public function updateStock(Request $request, Product $product): RedirectResponse
    {
        $user = auth()->user();
        if (!$user?->hasPermission('products.edit')) {
            return back()->with('error', 'Administrator has not granted permission to edit products.');
        }

        $supplier = $this->getSupplierProfile();

        if (!$supplier || $product->supplier_id != $supplier->id) {
            return back()->with('error', 'Unauthorized action.');
        }

        $validated = $request->validate([
            'stock_qty'       => 'required|integer|min:0',
            'wholesale_price' => 'required|numeric|min:0',
        ]);

        // If product is Low or Out of Stock (stock_qty <= 10) and supplier attempts to increase stock
        if ($product->stock_qty <= 10 && $validated['stock_qty'] > $product->stock_qty) {
            return back()->with('error', "Stock for \"{$product->name}\" is Low/Out of Stock (≤10). You cannot directly increase stock; please click 'Request Stock' to submit a restock request to Administrator.");
        }

        $product->update([
            'stock_qty'       => $validated['stock_qty'],
            'wholesale_price' => $validated['wholesale_price'],
        ]);

        return back()->with('success', "Stock and pricing updated for \"{$product->name}\".");
    }
}
