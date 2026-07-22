@extends('layouts.admin.dashboard')

@section('title', 'Product Catalog Management')
@section('page-title', 'Products')

@section('content')

{{-- Flash Messages --}}
@if(session('success'))
<div class="flash-alert flash-success animate-fadeInUp" id="flashSuccess">
    <i class="bi bi-check-circle-fill"></i>
    <span>{{ session('success') }}</span>
    <button class="flash-close" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button>
</div>
@endif
@if(session('error'))
<div class="flash-alert flash-error animate-fadeInUp" id="flashError">
    <i class="bi bi-exclamation-circle-fill"></i>
    <span>{{ session('error') }}</span>
    <button class="flash-close" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button>
</div>
@endif

{{-- Page Header --}}
<div class="page-header animate-fadeInUp">
    <div class="page-header-left">
        <div class="page-header-icon" style="background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%); color: #fff;">
            <i class="bi bi-box-seam-fill"></i>
        </div>
        <div>
            <h1 class="page-header-title">Product Catalog</h1>
            <p class="page-header-subtitle">Manage B2B computer hardware inventory, wholesale pricing, MOQ, suppliers, and brands.</p>
        </div>
    </div>
    <div class="page-header-actions">
        <a href="{{ route('admin.products.create') }}" class="btn-primary-solid ripple-btn" id="btn-create-product">
            <i class="bi bi-plus-lg me-2"></i> Add New Product
        </a>
    </div>
</div>

{{-- Summary Stats Cards --}}
<div class="roles-summary-grid animate-fadeInUp" style="animation-delay:.06s">
    
    {{-- Total Products --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--primary-light);color:var(--primary)">
            <i class="bi bi-box-seam-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['all'] }}</div>
            <div class="roles-stat-label">Total Products</div>
        </div>
    </div>

    {{-- In Stock --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--emerald-light);color:var(--emerald)">
            <i class="bi bi-check-circle-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['in_stock'] }}</div>
            <div class="roles-stat-label">In Stock</div>
        </div>
    </div>

    {{-- Low Stock --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--warning-light);color:var(--amber)">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['low_stock'] }}</div>
            <div class="roles-stat-label">Low Stock (≤10)</div>
        </div>
    </div>

    {{-- Featured --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--violet-light);color:var(--violet)">
            <i class="bi bi-star-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['featured'] }}</div>
            <div class="roles-stat-label">Featured Items</div>
        </div>
    </div>

</div>

{{-- Main Panel --}}
<div class="card-panel animate-fadeInUp" style="animation-delay:.12s; margin-top: 24px;">
    
    {{-- Filter Header --}}
    <div class="filter-toolbar-header">
        
        {{-- Top Bar: Status Tabs (Left) & Search + Actions (Right) --}}
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            
            {{-- Status Tabs --}}
            <div class="matrix-module-filter status-tabs-container">
                <a href="{{ route('admin.products.index', ['filter' => 'all', 'search' => $search, 'category_id' => $categoryId, 'brand_id' => $brandId, 'supplier_id' => $supplierId]) }}" 
                   class="role-action-btn {{ $filter === 'all' ? 'active-filter' : '' }}" 
                   style="border: none; border-radius: var(--radius-full); text-decoration:none;">
                   All <span class="badge ms-1" style="background: var(--border); color: var(--text-secondary)">{{ $counts['all'] }}</span>
                </a>
                <a href="{{ route('admin.products.index', ['filter' => 'in_stock', 'search' => $search, 'category_id' => $categoryId, 'brand_id' => $brandId, 'supplier_id' => $supplierId]) }}" 
                   class="role-action-btn {{ $filter === 'in_stock' ? 'active-filter' : '' }}" 
                   style="border: none; border-radius: var(--radius-full); text-decoration:none;">
                   In Stock <span class="badge ms-1" style="background: var(--emerald-light); color: var(--emerald)">{{ $counts['in_stock'] }}</span>
                </a>
                <a href="{{ route('admin.products.index', ['filter' => 'low_stock', 'search' => $search, 'category_id' => $categoryId, 'brand_id' => $brandId, 'supplier_id' => $supplierId]) }}" 
                   class="role-action-btn {{ $filter === 'low_stock' ? 'active-filter' : '' }}" 
                   style="border: none; border-radius: var(--radius-full); text-decoration:none;">
                   Low Stock <span class="badge ms-1" style="background: var(--warning-light); color: var(--amber)">{{ $counts['low_stock'] }}</span>
                </a>
                <a href="{{ route('admin.products.index', ['filter' => 'featured', 'search' => $search, 'category_id' => $categoryId, 'brand_id' => $brandId, 'supplier_id' => $supplierId]) }}" 
                   class="role-action-btn {{ $filter === 'featured' ? 'active-filter' : '' }}" 
                   style="border: none; border-radius: var(--radius-full); text-decoration:none;">
                   Featured <span class="badge ms-1" style="background: var(--violet-light); color: var(--violet)">{{ $counts['featured'] }}</span>
                </a>
                <a href="{{ route('admin.products.index', ['filter' => 'inactive', 'search' => $search, 'category_id' => $categoryId, 'brand_id' => $brandId, 'supplier_id' => $supplierId]) }}" 
                   class="role-action-btn {{ $filter === 'inactive' ? 'active-filter' : '' }}" 
                   style="border: none; border-radius: var(--radius-full); text-decoration:none;">
                   Inactive <span class="badge ms-1" style="background: var(--danger-light); color: var(--danger)">{{ $counts['inactive'] }}</span>
                </a>
            </div>

            {{-- Search & Clear Filters --}}
            <div class="d-flex align-items-center gap-2">
                <div class="position-relative" style="min-width: 240px;">
                    <i class="bi bi-search position-absolute text-muted" style="left: 14px; top: 50%; transform: translateY(-50%); font-size: 0.85rem;"></i>
                    <input type="search" name="search" form="product-filter-form" class="search-input" 
                           placeholder="Search name, SKU..." value="{{ $search }}" 
                           style="padding-left: 36px; height: 38px; border-radius: 20px; border: 1px solid var(--border); width: 100%;">
                </div>

                @if($search || $categoryId || $brandId || $supplierId || $filter !== 'all')
                    <a href="{{ route('admin.products.index') }}" class="btn-outline-secondary-sm rounded-pill" title="Clear Filters" style="height: 38px; display: inline-flex; align-items: center; padding: 0 14px;">
                        <i class="bi bi-x-circle me-1"></i> Clear
                    </a>
                @endif
            </div>

        </div>

        {{-- Bottom Bar: Category, Brand, Supplier Dropdowns --}}
        <form id="product-filter-form" action="{{ route('admin.products.index') }}" method="GET" class="filter-controls-bar">
            <input type="hidden" name="filter" value="{{ $filter }}">

            {{-- Category Filter --}}
            <div class="filter-control-group">
                <span class="filter-control-icon"><i class="bi bi-grid-fill"></i></span>
                <select name="category_id" class="custom-filter-select" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Brand Filter --}}
            <div class="filter-control-group">
                <span class="filter-control-icon"><i class="bi bi-award-fill"></i></span>
                <select name="brand_id" class="custom-filter-select" onchange="this.form.submit()">
                    <option value="">All Brands</option>
                    @foreach($brands as $b)
                        <option value="{{ $b->id }}" {{ $brandId == $b->id ? 'selected' : '' }}>
                            {{ $b->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Supplier Filter --}}
            <div class="filter-control-group">
                <span class="filter-control-icon"><i class="bi bi-building"></i></span>
                <select name="supplier_id" class="custom-filter-select" onchange="this.form.submit()">
                    <option value="">All Suppliers</option>
                    @foreach($suppliers as $sup)
                        <option value="{{ $sup->id }}" {{ $supplierId == $sup->id ? 'selected' : '' }}>
                            {{ $sup->company_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

    </div>

    {{-- Data Table --}}
    <div class="table-responsive" style="margin-top: 16px;">
        <table class="table align-middle custom-table mb-0">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category & Brand</th>
                    <th>Supplier</th>
                    <th>Wholesale Price</th>
                    <th>MOQ</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th class="text-end" style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr id="product-row-{{ $product->id }}">
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="product-img-box me-3 shadow-sm" style="width: 48px; height: 48px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; background: rgba(37,99,235,0.08); border: 1px solid var(--border); color: var(--primary); flex-shrink: 0;">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 9px;">
                                @else
                                    <i class="bi {{ $product->category?->icon ?: 'bi-box-seam' }}"></i>
                                @endif
                            </div>
                            <div>
                                <div class="fw-semibold text-dark fs-6 d-flex align-items-center gap-2">
                                    {{ $product->name }}
                                    @if($product->is_featured)
                                        <span class="badge bg-warning-subtle text-amber border border-warning-subtle rounded-pill px-2 py-0.5" style="font-size: 0.7rem;">
                                            ★ Featured
                                        </span>
                                    @endif
                                </div>
                                <div class="text-muted small">
                                    <code class="text-primary me-2">SKU: {{ $product->sku }}</code>
                                    @if($product->short_description)
                                        <span class="text-truncate d-inline-block" style="max-width: 280px; vertical-align: bottom;">— {{ $product->short_description }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex flex-column gap-1">
                            <span class="badge bg-light text-dark border align-self-start" style="font-weight: 500;">
                                <i class="bi {{ $product->category?->icon ?: 'bi-tag-fill' }} me-1 text-primary"></i> {{ $product->category?->name ?? 'Uncategorized' }}
                            </span>
                            @if($product->brand)
                                <span class="small text-secondary fw-semibold">
                                    <i class="bi bi-award me-1"></i> {{ $product->brand->name }}
                                </span>
                            @endif
                        </div>
                    </td>
                    <td>
                        @if($product->supplier)
                            <div class="d-flex flex-column">
                                <span class="fw-semibold text-dark small">{{ $product->supplier->company_name }}</span>
                                @if($product->supplier->contact_name)
                                    <span class="text-muted fs-7">{{ $product->supplier->contact_name }}</span>
                                @endif
                            </div>
                        @else
                            <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td>
                        <div>
                            <div class="fw-bold text-dark fs-6">${{ number_format($product->wholesale_price, 2) }}</div>
                            @if($product->cost_price > 0)
                                <div class="text-muted fs-7">Cost: ${{ number_format($product->cost_price, 2) }}</div>
                            @endif
                        </div>
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border font-monospace px-2.5 py-1">
                            {{ $product->min_order_qty }} pcs
                        </span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            @if($product->stock_qty > 10)
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1">
                                    <i class="bi bi-box-seam me-1"></i> {{ $product->stock_qty }} in stock
                                </span>
                            @elseif($product->stock_qty > 0)
                                <span class="badge bg-warning-subtle text-amber border border-warning-subtle px-2.5 py-1">
                                    <i class="bi bi-exclamation-triangle me-1"></i> {{ $product->stock_qty }} low stock
                                </span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1">
                                    Out of stock
                                </span>
                            @endif

                            <form action="{{ route('admin.products.update-stock', $product) }}" method="POST" class="d-inline-flex align-items-center gap-1 ms-1">
                                @csrf
                                <input type="number" name="stock_qty" value="{{ $product->stock_qty }}" min="0" 
                                       class="form-control form-control-sm text-center font-monospace" style="width: 65px; height: 26px; font-size: 0.75rem;" 
                                       title="Quick Update Stock">
                                <button type="submit" class="btn btn-sm btn-primary-solid p-0 d-inline-flex align-items-center justify-content-center" style="width: 26px; height: 26px;" title="Save Stock">
                                    <i class="bi bi-check-lg" style="font-size: 0.85rem;"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                    <td>
                        <form action="{{ route('admin.products.toggle-status', $product) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm border-0 bg-transparent p-0" title="Click to toggle status">
                                @if($product->is_active)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1" style="border-radius: 20px; font-weight: 500;">
                                        Active
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2.5 py-1" style="border-radius: 20px; font-weight: 500;">
                                        Inactive
                                    </span>
                                @endif
                            </button>
                        </form>
                    </td>
                    <td class="text-end">
                        <div class="d-inline-flex gap-1 align-items-center">
                            <form action="{{ route('admin.products.toggle-featured', $product) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-light border" title="Toggle Featured">
                                    <i class="bi bi-star{{ $product->is_featured ? '-fill text-warning' : '' }}"></i>
                                </button>
                            </form>

                            <a href="{{ route('admin.products.edit', $product) }}" 
                               class="btn btn-sm btn-light text-dark border" 
                               title="Edit Product" style="padding: 4px 8px;">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" 
                                  class="d-inline" onsubmit="return confirm('Are you sure you want to delete product \'{{ $product->name }}\'?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger border" 
                                        title="Delete Product" style="padding: 4px 8px;">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-5">
                        <div class="text-muted">
                            <i class="bi bi-box-seam display-4 d-block mb-3 opacity-50"></i>
                            <h5>No products found</h5>
                            <p class="small text-secondary mb-3">Try adjusting your search or filter options, or add a new product.</p>
                            <a href="{{ route('admin.products.create') }}" class="btn-primary-solid btn-sm">
                                <i class="bi bi-plus-lg me-1"></i> Add Product
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
