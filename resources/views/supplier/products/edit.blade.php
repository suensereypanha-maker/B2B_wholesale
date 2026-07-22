@extends('layouts.admin.dashboard')

@section('title', 'Edit Supplier Item - ' . $product->name)
@section('page-title', 'Edit Product')

@section('content')

{{-- Page Header --}}
<div class="page-header animate-fadeInUp mb-4">
    <div class="page-header-left d-flex align-items-center gap-3">
        <a href="{{ route('supplier.products') }}" class="btn btn-light border shadow-sm rounded-3 p-2 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;" title="Back to Products">
            <i class="bi bi-arrow-left fs-5"></i>
        </a>
        <div class="d-flex align-items-center gap-3">
            <div class="product-header-icon rounded-3 d-flex align-items-center justify-content-center text-white shadow-sm" style="width: 48px; height: 48px; background: linear-gradient(135deg, #db2777 0%, #be185d 100%); font-size: 1.4rem;">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div>
                <h1 class="page-header-title mb-0 fs-3 fw-bold">Edit Supply Product Item</h1>
                <p class="page-header-subtitle text-muted mb-0 small">Update product details, wholesale pricing, MOQ, or inventory stock for <strong>{{ $product->name }}</strong>.</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 animate-fadeInUp" style="animation-delay:.08s;">
    
    {{-- Form Column --}}
    <div class="col-lg-8">
        <div class="card-panel border-0 shadow-sm rounded-4 p-4 bg-white">
            <form action="{{ route('supplier.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Section 1: Basic Information --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill text-pink" style="color: #be185d;"></i> Basic Product Details
                    </h5>
                    
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label for="name" class="form-label fw-semibold text-secondary small">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control rounded-3 p-2.5 @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $product->name) }}" required placeholder="e.g. Industrial Brass Fitting 1/2 inch">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="sku" class="form-label fw-semibold text-secondary small">SKU Code</label>
                            <input type="text" name="sku" id="sku" class="form-control rounded-3 p-2.5 @error('sku') is-invalid @enderror" 
                                   value="{{ old('sku', $product->sku) }}" placeholder="SUPP-FIT-001">
                            @error('sku')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="short_description" class="form-label fw-semibold text-secondary small">Short Summary</label>
                        <input type="text" name="short_description" id="short_description" class="form-control rounded-3 p-2.5 @error('short_description') is-invalid @enderror" 
                               value="{{ old('short_description', $product->short_description) }}" placeholder="Brief summary of key specifications...">
                        @error('short_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="description" class="form-label fw-semibold text-secondary small">Technical Specifications / Full Description</label>
                        <textarea name="description" id="description" rows="4" class="form-control rounded-3 p-2.5 @error('description') is-invalid @enderror" 
                                  placeholder="Detailed product descriptions, material specifications, warranty...">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4 text-border opacity-25">

                {{-- Section 2: Relations (Category & Brand) --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-diagram-3-fill text-pink" style="color: #be185d;"></i> Categorization
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="category_id" class="form-label fw-semibold text-secondary small">Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-select rounded-3 p-2.5 @error('category_id') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="brand_id" class="form-label fw-semibold text-secondary small">Brand</label>
                            <select name="brand_id" id="brand_id" class="form-select rounded-3 p-2.5 @error('brand_id') is-invalid @enderror">
                                <option value="">Select Brand (Optional)</option>
                                @foreach($brands as $b)
                                    <option value="{{ $b->id }}" {{ old('brand_id', $product->brand_id) == $b->id ? 'selected' : '' }}>
                                        {{ $b->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4 text-border opacity-25">

                {{-- Section 3: Pricing & Inventory --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-tags-fill text-pink" style="color: #be185d;"></i> Pricing & Supply MOQ
                    </h5>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="wholesale_price" class="form-label fw-semibold text-secondary small">Wholesale Price ($) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 fw-bold">$</span>
                                <input type="number" step="0.01" name="wholesale_price" id="wholesale_price" class="form-control border-start-0 rounded-end-3 p-2.5 @error('wholesale_price') is-invalid @enderror" 
                                       value="{{ old('wholesale_price', $product->wholesale_price) }}" required placeholder="125.00">
                            </div>
                            @error('wholesale_price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="cost_price" class="form-label fw-semibold text-secondary small">Cost Price ($) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0 fw-bold">$</span>
                                <input type="number" step="0.01" name="cost_price" id="cost_price" class="form-control border-start-0 rounded-end-3 p-2.5 @error('cost_price') is-invalid @enderror" 
                                       value="{{ old('cost_price', $product->cost_price) }}" required placeholder="100.00">
                            </div>
                            @error('cost_price')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label for="min_order_qty" class="form-label fw-semibold text-secondary small">Minimum Order Quantity (MOQ) <span class="text-danger">*</span></label>
                            <input type="number" name="min_order_qty" id="min_order_qty" class="form-control rounded-3 p-2.5 @error('min_order_qty') is-invalid @enderror" 
                                   value="{{ old('min_order_qty', $product->min_order_qty) }}" min="1" required>
                            @error('min_order_qty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="stock_qty" class="form-label fw-semibold text-secondary small">Stock Quantity Available <span class="text-danger">*</span></label>
                            <input type="number" name="stock_qty" id="stock_qty" class="form-control rounded-3 p-2.5 @error('stock_qty') is-invalid @enderror" 
                                   value="{{ old('stock_qty', $product->stock_qty) }}" min="0" required>
                            @if($product->stock_qty <= 10)
                                <div class="form-text text-amber small fw-semibold"><i class="bi bi-exclamation-triangle-fill me-1"></i> Stock is Low/Out of Stock. Note: Stock increases must be requested from Admin.</div>
                            @endif
                            @error('stock_qty')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="my-4 text-border opacity-25">

                {{-- Section 4: Image --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-image text-pink" style="color: #be185d;"></i> Product Image
                    </h5>

                    @if($product->image)
                    <div class="mb-3 d-flex align-items-center gap-3">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 70px; height: 70px; object-fit: cover; border-radius: 12px; border: 1px solid var(--border);">
                        <div>
                            <div class="fw-semibold text-dark small">Current Image</div>
                            <div class="text-muted small">Upload a new file below to replace it.</div>
                        </div>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="image" class="form-label fw-semibold text-secondary small">Replace Product Image</label>
                        <input type="file" name="image" id="image" class="form-control rounded-3 p-2 @error('image') is-invalid @enderror" accept="image/*">
                        <div class="form-text small">Upload clear product photo (JPG, PNG, WebP max 2MB).</div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Form Actions --}}
                <div class="pt-4 border-top d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-primary px-4 py-2.5 rounded-3 fw-semibold" style="background: linear-gradient(135deg, #db2777 0%, #be185d 100%); border: none;">
                        <i class="bi bi-check2-circle me-1 fs-5 align-middle"></i> Update Product
                    </button>
                    <a href="{{ route('supplier.products') }}" class="btn btn-light border px-4 py-2.5 rounded-3 text-secondary fw-medium">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>

    {{-- Live Card Preview Column --}}
    <div class="col-lg-4">
        <div class="sticky-top" style="top: 90px;">
            <div class="card-panel border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-uppercase text-muted fw-bold small letter-spacing-1">Live Product Card</span>
                    <span class="badge bg-success-subtle text-success border rounded-pill px-2.5 py-1 small">
                        In Stock
                    </span>
                </div>

                {{-- Product Preview Card --}}
                <div class="product-preview-card p-4 rounded-4 text-center border position-relative overflow-hidden" style="background: linear-gradient(180deg, #fdf2f8 0%, #ffffff 100%);">
                    
                    {{-- Image / Icon Box --}}
                    <div class="mx-auto mb-3 shadow-sm rounded-4 d-flex align-items-center justify-content-center bg-white border text-pink" id="preview-image-box" style="width: 90px; height: 90px; font-size: 2.4rem; color: #be185d;">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" style="width:100%;height:100%;object-fit:cover;border-radius:12px;">
                        @else
                        <i class="bi bi-box-seam-fill" id="preview-icon"></i>
                        @endif
                    </div>

                    <h5 class="fw-bold text-dark mb-1" id="preview-name">{{ $product->name }}</h5>
                    <p class="text-muted small mb-2 font-monospace" id="preview-sku">SKU: {{ $product->sku }}</p>

                    {{-- Price & MOQ Box --}}
                    <div class="bg-light p-3 rounded-3 mb-3 border">
                        <div class="fs-4 fw-bold text-dark" id="preview-price">${{ number_format($product->wholesale_price, 2) }}</div>
                        <div class="small text-muted" id="preview-moq">Min. Order (MOQ): {{ $product->min_order_qty }} pcs</div>
                    </div>

                    <div class="text-start small text-secondary d-flex flex-column gap-1 pt-2 border-top">
                        <div>Category: <strong class="text-dark" id="preview-cat">{{ $product->category?->name ?? 'Unassigned' }}</strong></div>
                        <div>Brand: <strong class="text-dark" id="preview-brand">{{ $product->brand?->name ?? 'Unassigned' }}</strong></div>
                        <div>Stock Level: <strong class="text-dark" id="preview-stock">{{ $product->stock_qty }} units</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Live Sync Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nameInput = document.getElementById('name');
        const skuInput = document.getElementById('sku');
        const priceInput = document.getElementById('wholesale_price');
        const moqInput = document.getElementById('min_order_qty');
        const stockInput = document.getElementById('stock_qty');
        const catSelect = document.getElementById('category_id');
        const brandSelect = document.getElementById('brand_id');
        const imageInput = document.getElementById('image');

        const previewName = document.getElementById('preview-name');
        const previewSku = document.getElementById('preview-sku');
        const previewPrice = document.getElementById('preview-price');
        const previewMoq = document.getElementById('preview-moq');
        const previewStock = document.getElementById('preview-stock');
        const previewCat = document.getElementById('preview-cat');
        const previewBrand = document.getElementById('preview-brand');
        const previewImageBox = document.getElementById('preview-image-box');

        nameInput.addEventListener('input', function () {
            previewName.textContent = nameInput.value.trim() || 'Product Name';
        });

        skuInput.addEventListener('input', function () {
            previewSku.textContent = 'SKU: ' + (skuInput.value.trim() || 'SUPP-000');
        });

        priceInput.addEventListener('input', function () {
            previewPrice.textContent = '$' + (parseFloat(priceInput.value || 0).toFixed(2));
        });

        moqInput.addEventListener('input', function () {
            previewMoq.textContent = 'Min. Order (MOQ): ' + (moqInput.value || 1) + ' pcs';
        });

        stockInput.addEventListener('input', function () {
            previewStock.textContent = (stockInput.value || 0) + ' units';
        });

        catSelect.addEventListener('change', function () {
            const opt = catSelect.options[catSelect.selectedIndex];
            previewCat.textContent = catSelect.value ? opt.text.trim() : 'Unassigned';
        });

        brandSelect.addEventListener('change', function () {
            const opt = brandSelect.options[brandSelect.selectedIndex];
            previewBrand.textContent = brandSelect.value ? opt.text.trim() : 'Unassigned';
        });

        imageInput.addEventListener('change', function () {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewImageBox.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;border-radius:12px;">`;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>

@endsection
