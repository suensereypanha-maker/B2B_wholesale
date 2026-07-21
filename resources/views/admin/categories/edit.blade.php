@extends('layouts.admin.dashboard')

@section('title', 'Edit Category — ' . $category->name)
@section('page-title', 'Edit Category')

@section('content')

{{-- Page Header --}}
<div class="page-header animate-fadeInUp mb-4">
    <div class="page-header-left d-flex align-items-center gap-3">
        <a href="{{ route('admin.categories.index') }}" class="btn btn-light border shadow-sm rounded-3 p-2 d-inline-flex align-items-center justify-content-center" style="width: 42px; height: 42px;" title="Back to Categories">
            <i class="bi bi-arrow-left fs-5"></i>
        </a>
        <div class="d-flex align-items-center gap-3">
            <div class="category-header-icon rounded-3 d-flex align-items-center justify-content-center text-white shadow-sm" style="width: 48px; height: 48px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); font-size: 1.4rem;">
                <i class="bi {{ $category->icon ?: ($category->is_parent ? 'bi-folder-fill' : 'bi-tag-fill') }}"></i>
            </div>
            <div>
                <div class="d-flex align-items-center gap-2">
                    <h1 class="page-header-title mb-0 fs-3 fw-bold">{{ $category->name }}</h1>
                    @if($category->is_parent)
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 fw-semibold fs-7">
                            <i class="bi bi-folder-fill me-1"></i> Main Category
                        </span>
                    @else
                        <span class="badge bg-emerald-light text-emerald border rounded-pill px-3 py-1 fw-semibold fs-7">
                            <i class="bi bi-diagram-3 me-1"></i> Subcategory of {{ $category->parent?->name }}
                        </span>
                    @endif
                </div>
                <p class="page-header-subtitle text-muted mb-0 small">Update category details, parent hierarchy, icon, and visibility status.</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 animate-fadeInUp" style="animation-delay:.08s;">
    
    {{-- Form Column --}}
    <div class="col-lg-8">
        <div class="card-panel border-0 shadow-sm rounded-4 p-4 bg-white">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Section 1: Basic Details --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-info-circle-fill text-primary"></i> General Information
                    </h5>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-semibold text-secondary small">Category Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control rounded-3 p-2.5 @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $category->name) }}" required placeholder="e.g. Processors & Motherboards">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="slug" class="form-label fw-semibold text-secondary small">URL Slug</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted small">/category/</span>
                                <input type="text" name="slug" id="slug" class="form-control border-start-0 rounded-end-3 p-2.5 @error('slug') is-invalid @enderror" 
                                       value="{{ old('slug', $category->slug) }}" placeholder="processors-motherboards">
                            </div>
                            @error('slug')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-3">
                        <label for="description" class="form-label fw-semibold text-secondary small">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-control rounded-3 p-2.5 @error('description') is-invalid @enderror" 
                                  placeholder="Briefly describe the hardware items contained in this category...">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4 text-border opacity-25">

                {{-- Section 2: Hierarchy & Icon --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-diagram-3-fill text-primary"></i> Classification & Icon
                    </h5>

                    <div class="mb-3">
                        <label for="parent_id" class="form-label fw-semibold text-secondary small">Parent Category</label>
                        <select name="parent_id" id="parent_id" class="form-select rounded-3 p-2.5 @error('parent_id') is-invalid @enderror">
                            <option value="" {{ is_null(old('parent_id', $category->parent_id)) ? 'selected' : '' }}>
                                📁 None (Top-Level Main Category)
                            </option>
                            <optgroup label="Select Parent Category">
                                @foreach($parentCategories as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                        ↳ {{ $parent->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        </select>
                        <div class="form-text small">Select "None" to set as a main category, or assign to a parent category to create a subcategory.</div>
                        @error('parent_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <label for="icon" class="form-label fw-semibold text-secondary small">Bootstrap Icon Class</label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0" id="icon-preview-box">
                                    <i class="bi {{ $category->icon ?: ($category->is_parent ? 'bi-folder-fill' : 'bi-tag-fill') }} fs-5 text-primary" id="icon-preview"></i>
                                </span>
                                <input type="text" name="icon" id="icon" class="form-control border-start-0 rounded-end-3 p-2.5 @error('icon') is-invalid @enderror" 
                                       value="{{ old('icon', $category->icon) }}" placeholder="e.g. bi-cpu-fill">
                            </div>
                            @error('icon')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="image" class="form-label fw-semibold text-secondary small">Category Image / Banner</label>
                            <input type="file" name="image" id="image" class="form-control rounded-3 p-2 @error('image') is-invalid @enderror" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Icon Quick Selector Chips --}}
                    <div class="mt-3">
                        <label class="form-label fw-semibold text-muted small d-block mb-2">Quick Icon Selection:</label>
                        <div class="d-flex flex-wrap gap-2">
                            @php
                                $presetIcons = ['bi-cpu-fill', 'bi-memory', 'bi-gpu-card', 'bi-device-ssd', 'bi-hdd-fill', 'bi-laptop', 'bi-display', 'bi-keyboard', 'bi-router', 'bi-printer', 'bi-plug', 'bi-battery-charging', 'bi-disc'];
                            @endphp
                            @foreach($presetIcons as $pIcon)
                                <button type="button" class="btn btn-sm btn-light border rounded-3 p-2 icon-chip d-inline-flex align-items-center gap-1" data-icon="{{ $pIcon }}">
                                    <i class="bi {{ $pIcon }} text-primary"></i> <span class="small text-muted">{{ str_replace('bi-', '', $pIcon) }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <hr class="my-4 text-border opacity-25">

                {{-- Section 3: Display Settings --}}
                <div class="form-section mb-4">
                    <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-sliders text-primary"></i> Display & Status
                    </h5>

                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <label for="sort_order" class="form-label fw-semibold text-secondary small">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" class="form-control rounded-3 p-2.5 @error('sort_order') is-invalid @enderror" 
                                   value="{{ old('sort_order', $category->sort_order) }}" min="0" style="max-width: 160px;">
                            <div class="form-text small">Lower numbers appear first in the catalog.</div>
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small d-block">Catalog Visibility</label>
                            <div class="form-check form-switch p-0 ms-4">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_active" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }} style="width: 48px; height: 24px; cursor: pointer;">
                                <label class="form-check-label fw-semibold ms-3 pt-1" for="is_active" id="status-label">
                                    {{ old('is_active', $category->is_active) ? 'Active (Visible in Store)' : 'Inactive (Hidden)' }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="pt-4 border-top d-flex align-items-center gap-3">
                    <button type="submit" class="btn-primary-solid ripple-btn px-4 py-2.5 rounded-3 fw-semibold" id="btn-update-category">
                        <i class="bi bi-check2-circle me-1 fs-5 align-middle"></i> Save Changes
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light border px-4 py-2.5 rounded-3 text-secondary fw-medium">
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
                    <span class="text-uppercase text-muted fw-bold small letter-spacing-1">Live Card Preview</span>
                    <span class="badge bg-light text-secondary border rounded-pill px-2.5 py-1 small" id="preview-type-badge">
                        {{ $category->is_parent ? 'Main Category' : 'Subcategory' }}
                    </span>
                </div>

                {{-- Category Preview Box --}}
                <div class="category-preview-card p-4 rounded-4 text-center border position-relative overflow-hidden style-preview-bg" style="background: linear-gradient(180deg, #f8fafc 0%, #ffffff 100%);">
                    
                    {{-- Status Ribbon --}}
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-secondary' }} rounded-pill px-2.5 py-1" id="preview-status-pill">
                            {{ $category->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    {{-- Image / Icon --}}
                    <div class="mx-auto mb-3 shadow-sm rounded-4 d-flex align-items-center justify-content-center position-relative overflow-hidden" id="preview-icon-box" style="width: 72px; height: 72px; background: rgba(59, 130, 246, 0.1); color: #2563eb; font-size: 2.2rem; border: 1px solid rgba(59, 130, 246, 0.2);">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" id="preview-img-tag" alt="{{ $category->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <i class="bi {{ $category->icon ?: ($category->is_parent ? 'bi-folder-fill' : 'bi-tag-fill') }}" id="preview-card-icon"></i>
                        @endif
                    </div>

                    <h4 class="fw-bold text-dark mb-1" id="preview-name">{{ $category->name }}</h4>
                    <p class="text-muted small mb-2 font-monospace" id="preview-slug">/category/{{ $category->slug }}</p>

                    <p class="text-secondary small mb-3 text-truncate-2" id="preview-description" style="min-height: 40px;">
                        {{ $category->description ?: 'No description provided.' }}
                    </p>

                    <div class="pt-3 border-top d-flex align-items-center justify-content-between small text-muted">
                        <span>Parent: <strong class="text-dark" id="preview-parent-name">{{ $category->parent?->name ?? 'None (Top Level)' }}</strong></span>
                        <span>Sort: <strong class="text-dark" id="preview-sort">{{ $category->sort_order }}</strong></span>
                    </div>
                </div>
            </div>

            {{-- Quick Action Card --}}
            <div class="card-panel border-0 shadow-sm rounded-4 p-4 bg-white">
                <h6 class="fw-bold text-dark mb-2">Category Actions</h6>
                <p class="small text-muted mb-3">Delete or permanently remove this category and its associated subcategories.</p>

                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete category \'{{ $category->name }}\'?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger w-100 rounded-3 py-2 fw-semibold btn-sm">
                        <i class="bi bi-trash3-fill me-1"></i> Delete Category
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Live Sync Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');
        const descInput = document.getElementById('description');
        const iconInput = document.getElementById('icon');
        const parentSelect = document.getElementById('parent_id');
        const sortInput = document.getElementById('sort_order');
        const activeSwitch = document.getElementById('is_active');
        const imageInput = document.getElementById('image');

        const previewName = document.getElementById('preview-name');
        const previewSlug = document.getElementById('preview-slug');
        const previewDesc = document.getElementById('preview-description');
        const previewIcon = document.getElementById('preview-card-icon');
        const previewIconBox = document.getElementById('preview-icon-box');
        const previewParent = document.getElementById('preview-parent-name');
        const previewSort = document.getElementById('preview-sort');
        const previewStatusPill = document.getElementById('preview-status-pill');
        const previewTypeBadge = document.getElementById('preview-type-badge');
        const statusLabel = document.getElementById('status-label');
        const formIconPreview = document.getElementById('icon-preview');

        // Name & Slug sync
        nameInput.addEventListener('input', function () {
            previewName.textContent = nameInput.value || 'Category Name';
        });

        slugInput.addEventListener('input', function () {
            previewSlug.textContent = '/category/' + (slugInput.value || 'slug');
        });

        descInput.addEventListener('input', function () {
            previewDesc.textContent = descInput.value || 'No description provided.';
        });

        // Icon input sync
        iconInput.addEventListener('input', function () {
            const val = iconInput.value.trim() || 'bi-folder-fill';
            if (formIconPreview) formIconPreview.className = 'bi ' + val + ' fs-5 text-primary';
            if (previewIcon) previewIcon.className = 'bi ' + val;
        });

        // Icon chips quick select
        document.querySelectorAll('.icon-chip').forEach(button => {
            button.addEventListener('click', function () {
                const iconClass = this.getAttribute('data-icon');
                iconInput.value = iconClass;
                iconInput.dispatchEvent(new Event('input'));
            });
        });

        // Parent select sync
        parentSelect.addEventListener('change', function () {
            const selectedOpt = parentSelect.options[parentSelect.selectedIndex];
            const text = selectedOpt.text.replace('↳', '').trim();
            previewParent.textContent = parentSelect.value ? text : 'None (Top Level)';
            previewTypeBadge.textContent = parentSelect.value ? 'Subcategory' : 'Main Category';
        });

        // Sort order sync
        sortInput.addEventListener('input', function () {
            previewSort.textContent = sortInput.value || 0;
        });

        // Status switch sync
        activeSwitch.addEventListener('change', function () {
            const isActive = activeSwitch.checked;
            statusLabel.textContent = isActive ? 'Active (Visible in Store)' : 'Inactive (Hidden)';
            previewStatusPill.textContent = isActive ? 'Active' : 'Inactive';
            previewStatusPill.className = isActive ? 'badge bg-success rounded-pill px-2.5 py-1' : 'badge bg-secondary rounded-pill px-2.5 py-1';
        });

        // Image file preview
        imageInput.addEventListener('change', function () {
            const file = imageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewIconBox.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover;">`;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>

@endsection
