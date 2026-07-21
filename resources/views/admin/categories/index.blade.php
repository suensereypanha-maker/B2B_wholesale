@extends('layouts.admin.dashboard')

@section('title', 'Category & Subcategory Management')
@section('page-title', 'Categories')

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
        <div class="page-header-icon" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%); color: #fff;">
            <i class="bi bi-grid-fill"></i>
        </div>
        <div>
            <h1 class="page-header-title">Categories & Subcategories</h1>
            <p class="page-header-subtitle">Organize products into main categories and sub-level classifications for B2B wholesale.</p>
        </div>
    </div>
    <div class="page-header-actions">
        <a href="{{ route('admin.categories.create') }}" class="btn-primary-solid ripple-btn" id="btn-create-category">
            <i class="bi bi-plus-lg me-2"></i> Add Category / Subcategory
        </a>
    </div>
</div>

{{-- Summary Stats Cards --}}
<div class="roles-summary-grid animate-fadeInUp" style="animation-delay:.06s">
    
    {{-- Total Categories --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--primary-light);color:var(--primary)">
            <i class="bi bi-grid-3x3-gap-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['all'] }}</div>
            <div class="roles-stat-label">Total Items</div>
        </div>
    </div>

    {{-- Parent Categories --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--violet-light);color:var(--violet)">
            <i class="bi bi-folder-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['parents'] }}</div>
            <div class="roles-stat-label">Main Categories</div>
        </div>
    </div>

    {{-- Subcategories --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--emerald-light);color:var(--emerald)">
            <i class="bi bi-diagram-3-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['subcategories'] }}</div>
            <div class="roles-stat-label">Subcategories</div>
        </div>
    </div>

    {{-- Inactive Items --}}
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--warning-light);color:var(--amber)">
            <i class="bi bi-eye-slash-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $counts['inactive'] }}</div>
            <div class="roles-stat-label">Inactive Items</div>
        </div>
    </div>

</div>

{{-- Main Panel --}}
<div class="card-panel animate-fadeInUp" style="animation-delay:.12s; margin-top: 24px;">
    
    {{-- Filter Header --}}
    <div class="panel-header" style="flex-wrap: wrap; gap: 16px;">
        <div class="matrix-module-filter" style="border: 1px solid var(--border); padding: 4px; display: inline-flex; border-radius: var(--radius-full);">
            <a href="{{ route('admin.categories.index', ['filter' => 'all', 'search' => $search, 'parent_id' => $parentId]) }}" 
               class="role-action-btn {{ $filter === 'all' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full); text-decoration:none;">
               All <span class="badge ms-1" style="background: var(--border); color: var(--text-secondary)">{{ $counts['all'] }}</span>
            </a>
            <a href="{{ route('admin.categories.index', ['filter' => 'parents', 'search' => $search]) }}" 
               class="role-action-btn {{ $filter === 'parents' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full); text-decoration:none;">
               Main Categories <span class="badge ms-1" style="background: var(--violet-light); color: var(--violet)">{{ $counts['parents'] }}</span>
            </a>
            <a href="{{ route('admin.categories.index', ['filter' => 'subcategories', 'search' => $search, 'parent_id' => $parentId]) }}" 
               class="role-action-btn {{ $filter === 'subcategories' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full); text-decoration:none;">
               Subcategories <span class="badge ms-1" style="background: var(--emerald-light); color: var(--emerald)">{{ $counts['subcategories'] }}</span>
            </a>
            <a href="{{ route('admin.categories.index', ['filter' => 'inactive', 'search' => $search]) }}" 
               class="role-action-btn {{ $filter === 'inactive' ? 'active-filter' : '' }}" 
               style="border: none; border-radius: var(--radius-full); text-decoration:none;">
               Inactive <span class="badge ms-1" style="background: var(--warning-light); color: var(--amber)">{{ $counts['inactive'] }}</span>
            </a>
        </div>

        {{-- Search & Parent Filter Controls --}}
        <form action="{{ route('admin.categories.index') }}" method="GET" class="d-flex align-items-center gap-2 flex-wrap ms-auto">
            <input type="hidden" name="filter" value="{{ $filter }}">
            
            <select name="parent_id" class="form-select form-select-sm" style="min-width: 180px; height: 38px; border-radius: 8px;" onchange="this.form.submit()">
                <option value="">All Parent Categories</option>
                @foreach($parentCategories as $parentCat)
                    <option value="{{ $parentCat->id }}" {{ $parentId == $parentCat->id ? 'selected' : '' }}>
                        {{ $parentCat->name }}
                    </option>
                @endforeach
            </select>

            <div class="position-relative">
                <input type="search" name="search" class="search-input search-input-sm" 
                       placeholder="Search categories..." value="{{ $search }}" 
                       style="min-width: 220px; padding-left: 36px; height: 38px;">
            </div>

            @if($search || $parentId || $filter !== 'all')
                <a href="{{ route('admin.categories.index') }}" class="btn-outline-secondary-sm" title="Clear Filters" style="height: 38px; display: inline-flex; align-items: center;">
                    <i class="bi bi-x-circle me-1"></i> Clear
                </a>
            @endif
        </form>
    </div>

    {{-- Data Table --}}
    <div class="table-responsive" style="margin-top: 16px;">
        <table class="table align-middle custom-table mb-0">
            <thead>
                <tr>
                    <th style="width: 50px;">Sort</th>
                    <th>Category Name</th>
                    <th>Type</th>
                    <th>Subcategories</th>
                    <th>Status</th>
                    <th class="text-end" style="width: 160px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr id="category-row-{{ $category->id }}">
                    <td class="text-center font-monospace text-muted">
                        <span class="badge bg-light text-dark border">{{ $category->sort_order }}</span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="category-icon-box me-3" style="width: 42px; height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; background: {{ $category->is_parent ? 'rgba(99, 102, 241, 0.1)' : 'rgba(16, 185, 129, 0.1)' }}; color: {{ $category->is_parent ? '#4f46e5' : '#10b981' }}; border: 1px solid rgba(0,0,0,0.05);">
                                @if($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 9px;">
                                @else
                                    <i class="bi {{ $category->icon ?: ($category->is_parent ? 'bi-folder-fill' : 'bi-tag-fill') }}"></i>
                                @endif
                            </div>
                            <div>
                                <div class="fw-semibold text-dark fs-6 d-flex align-items-center gap-2">
                                    {{ $category->name }}
                                    @if($category->is_subcategory)
                                        <span class="badge bg-light text-secondary border fw-normal" style="font-size: 0.72rem;">Sub</span>
                                    @endif
                                </div>
                                <div class="text-muted small">
                                    <code>/{{ $category->slug }}</code>
                                    @if($category->description)
                                        <span class="ms-2 text-truncate d-inline-block" style="max-width: 260px; vertical-align: bottom;">— {{ $category->description }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($category->is_parent)
                            <span class="badge" style="background: rgba(124, 58, 237, 0.1); color: #7c3aed; padding: 6px 12px; font-weight: 600; border-radius: 6px;">
                                <i class="bi bi-folder-fill me-1"></i> Main Category
                            </span>
                        @else
                            <div class="d-flex align-items-center text-secondary small">
                                <i class="bi bi-arrow-return-right me-1 text-primary"></i>
                                <span class="fw-medium text-dark">{{ $category->parent?->name ?? 'Parent' }}</span>
                            </div>
                        @endif
                    </td>
                    <td>
                        @if($category->is_parent)
                            <a href="{{ route('admin.categories.index', ['parent_id' => $category->id, 'filter' => 'subcategories']) }}" 
                               class="badge bg-emerald-light text-emerald text-decoration-none" style="padding: 6px 12px; font-size: 0.82rem;">
                                <i class="bi bi-diagram-3 me-1"></i> {{ $category->subcategories->count() }} Subcategories
                            </a>
                        @else
                            <span class="text-muted small">—</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.categories.toggle-status', $category) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm border-0 bg-transparent p-0" title="Click to toggle status">
                                @if($category->is_active)
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" style="border-radius: 20px; font-weight: 500;">
                                        <i class="bi bi-check-circle-fill me-1"></i> Active
                                    </span>
                                @else
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1" style="border-radius: 20px; font-weight: 500;">
                                        <i class="bi bi-slash-circle me-1"></i> Inactive
                                    </span>
                                @endif
                            </button>
                        </form>
                    </td>
                    <td class="text-end">
                        <div class="d-inline-flex gap-1 align-items-center">
                            @if($category->is_parent)
                                <a href="{{ route('admin.categories.create', ['parent_id' => $category->id]) }}" 
                                   class="btn btn-sm btn-light text-primary border me-1" 
                                   title="Add Subcategory under {{ $category->name }}" style="padding: 4px 8px;">
                                    <i class="bi bi-plus-circle-fill"></i>
                                </a>
                            @endif

                            <a href="{{ route('admin.categories.edit', $category) }}" 
                               class="btn btn-sm btn-light text-dark border" 
                               title="Edit Category" style="padding: 4px 8px;">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" 
                                  class="d-inline" onsubmit="return confirm('Are you sure you want to delete category \'{{ $category->name }}\'? @if($category->is_parent && $category->subcategories->count() > 0) WARNING: This will also delete {{ $category->subcategories->count() }} subcategories! @endif')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger border" 
                                        title="Delete Category" style="padding: 4px 8px;">
                                    <i class="bi bi-trash3-fill"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5">
                        <div class="text-muted">
                            <i class="bi bi-grid-3x3-gap display-4 d-block mb-3 opacity-50"></i>
                            <h5>No categories found</h5>
                            <p class="small text-secondary mb-3">Try adjusting your search or filter options, or add a new category.</p>
                            <a href="{{ route('admin.categories.create') }}" class="btn-primary-solid btn-sm">
                                <i class="bi bi-plus-lg me-1"></i> Add Category
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
