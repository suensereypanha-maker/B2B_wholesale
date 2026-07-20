@extends('layouts.admin.dashboard')

@section('title', isset($permission) ? 'Edit Permission' : 'New Permission')
@section('page-title', isset($permission) ? 'Edit Permission' : 'New Permission')

@section('content')

<div class="page-header animate-fadeInUp">
    <div class="page-header-left">
        <a href="{{ route('admin.permissions.index') }}" class="page-back-btn">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div class="page-header-icon" style="background:var(--violet-light);color:var(--violet)">
            <i class="bi bi-key-fill"></i>
        </div>
        <div>
            <h1 class="page-header-title">{{ isset($permission) ? 'Edit Permission' : 'New Permission' }}</h1>
            <p class="page-header-subtitle">
                {{ isset($permission) ? "Updating: {$permission->name}" : 'Create a new permission for role assignment.' }}
            </p>
        </div>
    </div>
</div>

<div class="row g-4 justify-content-center">
    <div class="col-12 col-lg-7">
        <div class="card-panel animate-fadeInUp" style="animation-delay:.06s">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Permission Details</h2>
                    <p class="panel-subtitle">The slug is auto-generated from the module and name</p>
                </div>
            </div>

            <form method="POST"
                  action="{{ isset($permission) ? route('admin.permissions.update', $permission) : route('admin.permissions.store') }}"
                  id="permForm">
                @csrf
                @if(isset($permission)) @method('PUT') @endif

                <div class="form-body">

                    {{-- Module --}}
                    <div class="form-group">
                        <label class="form-label" for="module">
                            Module <span class="form-required">*</span>
                        </label>
                        <input type="text"
                               id="module"
                               name="module"
                               list="moduleDatalist"
                               class="form-control-custom @error('module') is-invalid @enderror"
                               value="{{ old('module', $permission->module ?? '') }}"
                               placeholder="e.g. products, orders, reports…"
                               required
                               autocomplete="off" />
                        <datalist id="moduleDatalist">
                            @foreach($modules as $mod)
                            <option value="{{ $mod }}">{{ ucwords(str_replace(['_','-'],' ',$mod)) }}</option>
                            @endforeach
                        </datalist>
                        <p class="form-hint-text">Choose an existing module or type a new one. Grouped in the permission matrix.</p>
                        @error('module') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    {{-- Name --}}
                    <div class="form-group">
                        <label class="form-label" for="perm-name">
                            Permission Name <span class="form-required">*</span>
                        </label>
                        <input type="text"
                               id="perm-name"
                               name="name"
                               class="form-control-custom @error('name') is-invalid @enderror"
                               value="{{ old('name', $permission->name ?? '') }}"
                               placeholder="e.g. Create Products, Approve Orders…"
                               required
                               autocomplete="off" />
                        @error('name') <p class="form-error">{{ $message }}</p> @enderror
                    </div>

                    {{-- Slug Preview --}}
                    <div class="form-group">
                        <label class="form-label">Auto-generated Slug</label>
                        <div class="slug-preview" id="permSlugPreview">
                            {{ isset($permission) ? $permission->slug : 'module.permission-name' }}
                        </div>
                        <p class="form-hint-text">Format: <code>module.permission-name</code></p>
                    </div>

                    {{-- Description --}}
                    <div class="form-group">
                        <label class="form-label" for="perm-desc">Description</label>
                        <textarea id="perm-desc"
                                  name="description"
                                  class="form-control-custom"
                                  rows="3"
                                  placeholder="Briefly describe what this permission allows the user to do…">{{ old('description', $permission->description ?? '') }}</textarea>
                    </div>

                </div>

                <div class="form-footer">
                    <a href="{{ route('admin.permissions.index') }}" class="btn-cancel">
                        <i class="bi bi-x-lg me-2"></i>Cancel
                    </a>
                    <button type="submit" class="btn-primary-solid ripple-btn">
                        <i class="bi bi-{{ isset($permission) ? 'check-lg' : 'plus-lg' }} me-2"></i>
                        {{ isset($permission) ? 'Update Permission' : 'Create Permission' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const moduleInput = document.getElementById('module');
    const nameInput   = document.getElementById('perm-name');
    const slugPreview = document.getElementById('permSlugPreview');

    function toSlug(str) {
        return str.toLowerCase().trim().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
    }

    function updateSlug() {
        const mod  = toSlug(moduleInput?.value || '');
        const name = toSlug(nameInput?.value || '');
        if (slugPreview) {
            slugPreview.textContent = (mod && name) ? `${mod}.${name}` : 'module.permission-name';
        }
    }

    moduleInput?.addEventListener('input', updateSlug);
    nameInput?.addEventListener('input', updateSlug);
});
</script>
@endpush
