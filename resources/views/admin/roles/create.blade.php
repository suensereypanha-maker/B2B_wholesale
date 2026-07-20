@extends('layouts.admin.dashboard')

@section('title', isset($role) ? 'Edit Role — ' . $role->name : 'Create Role')
@section('page-title', isset($role) ? 'Edit Role' : 'Create Role')

@section('content')

    <div class="page-header animate-fadeInUp">
        <div class="page-header-left">
            <a href="{{ route('admin.roles.index') }}" class="page-back-btn">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div class="page-header-icon"
                style="{{ isset($role) ? 'background:var(--amber-light);color:var(--amber)' : '' }}">
                <i class="bi {{ isset($role) ? 'bi-pencil-fill' : 'bi-plus-circle-fill' }}"></i>
            </div>
            <div>
                <h1 class="page-header-title">{{ isset($role) ? 'Edit Role: ' . $role->name : 'Create New Role' }}</h1>
                <p class="page-header-subtitle">
                    {{ isset($role) ? 'Update the role name, description, and permission assignments.' : 'Define a new role and select the permissions it should have.' }}
                </p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ isset($role) ? route('admin.roles.update', $role) : route('admin.roles.store') }}"
        id="roleForm">
        @csrf
        @if (isset($role))
            @method('PUT')
        @endif

        <div class="row g-4">

            {{-- Left Column: Role Details --}}
            <div class="col-12 col-xl-4">

                {{-- Role Info Card --}}
                <div class="card-panel animate-fadeInUp" style="animation-delay:.04s">
                    <div class="panel-header">
                        <div>
                            <h2 class="panel-title">Role Details</h2>
                            <p class="panel-subtitle">Basic information about this role</p>
                        </div>
                    </div>
                    <div class="form-body">

                        {{-- Name --}}
                        <div class="form-group">
                            <label class="form-label" for="name">
                                Role Name <span class="form-required">*</span>
                            </label>
                            <input type="text" id="name" name="name"
                                class="form-control-custom @error('name') is-invalid @enderror"
                                value="{{ old('name', $role->name ?? '') }}" placeholder="e.g. Warehouse Manager" required
                                autocomplete="off" />
                            @error('name')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Slug (auto-generated, read-only) --}}
                        <div class="form-group">
                            <label class="form-label" for="slugPreview">
                                Slug <span class="form-hint">(auto-generated)</span>
                            </label>
                            <div class="slug-preview" id="slugPreview">
                                {{ isset($role) ? $role->slug : 'will-be-generated' }}
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label class="form-label" for="description">Description</label>
                            <textarea id="description" name="description" class="form-control-custom @error('description') is-invalid @enderror"
                                rows="3" placeholder="Briefly describe what this role can do…">{{ old('description', $role->description ?? '') }}</textarea>
                            @error('description')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Color --}}
                        <div class="form-group">
                            <label class="form-label">Badge Color <span class="form-required">*</span></label>
                            <div class="color-picker-grid" id="colorPickerGrid">
                                @php
                                    $colors = [
                                        '#2563EB' => 'Blue',
                                        '#7C3AED' => 'Violet',
                                        '#059669' => 'Emerald',
                                        '#D97706' => 'Amber',
                                        '#0891B2' => 'Cyan',
                                        '#DC2626' => 'Red',
                                        '#DB2777' => 'Pink',
                                        '#9333EA' => 'Purple',
                                        '#65A30D' => 'Lime',
                                        '#EA580C' => 'Orange',
                                        '#0284C7' => 'Sky',
                                        '#6B7280' => 'Gray',
                                    ];
                                    $selectedColor = old('color', $role->color ?? '#2563EB');
                                @endphp
                                @foreach ($colors as $hex => $label)
                                    <label class="color-option {{ $selectedColor === $hex ? 'selected' : '' }}"
                                        title="{{ $label }}">
                                        <input type="radio" name="color" value="{{ $hex }}"
                                            {{ $selectedColor === $hex ? 'checked' : '' }} />
                                        <span class="color-swatch" style="background:{{ $hex }}">
                                            {{ $selectedColor === $hex ? '✓' : '' }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                            @error('color')
                                <p class="form-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- System Role (only show for super admin use) --}}
                        @if (!isset($role) || !$role->is_system)
                            <div class="form-group">
                                <label class="form-toggle-label">
                                    <div class="toggle-info">
                                        <span class="toggle-title">System Role</span>
                                        <span class="toggle-desc">System roles cannot be deleted</span>
                                    </div>
                                    <div class="toggle-switch">
                                        <input type="checkbox" name="is_system" id="isSystem" value="1"
                                            {{ old('is_system', false) ? 'checked' : '' }} />
                                        <span class="toggle-slider"></span>
                                    </div>
                                </label>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- Live Preview --}}
                <div class="card-panel animate-fadeInUp" style="animation-delay:.08s">
                    <div class="panel-header">
                        <div>
                            <h2 class="panel-title">Live Preview</h2>
                            <p class="panel-subtitle">How this role will appear in the UI</p>
                        </div>
                    </div>
                    <div class="form-body">
                        <div class="role-preview" id="rolePreview">
                            <div class="role-badge" id="previewBadge"
                                style="background:{{ $selectedColor }}20;border:1.5px solid {{ $selectedColor }}40;">
                                <span class="role-badge-dot" id="previewDot"
                                    style="background:{{ $selectedColor }}"></span>
                                <span class="role-badge-name" id="previewName" style="color:{{ $selectedColor }}">
                                    {{ old('name', $role->name ?? 'Role Name') }}
                                </span>
                            </div>
                            <p class="role-description mt-2" id="previewDesc" style="font-size:.8rem">
                                {{ old('description', $role->description ?? 'Role description will appear here…') }}
                            </p>
                            <div class="role-stat mt-2">
                                <i class="bi bi-key" id="previewIcon" style="color:{{ $selectedColor }}"></i>
                                <span id="previewPermCount">
                                    <strong id="previewPermNum">0</strong> permissions selected
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Right Column: Permission Matrix --}}
            <div class="col-12 col-xl-8">
                <div class="card-panel animate-fadeInUp" style="animation-delay:.1s">
                    <div class="panel-header">
                        <div>
                            <h2 class="panel-title">Permission Assignment</h2>
                            <p class="panel-subtitle">Select the permissions this role should have</p>
                        </div>
                        <div class="panel-actions">
                            <button type="button" class="btn-outline-primary-sm" id="selectAll">
                                <i class="bi bi-check2-all me-1"></i>Select All
                            </button>
                            <button type="button" class="btn-outline-primary-sm" id="deselectAll"
                                style="border-color:var(--border);color:var(--text-secondary)">
                                <i class="bi bi-x-circle me-1"></i>Clear All
                            </button>
                        </div>
                    </div>

                    <div class="perm-counter-bar">
                        <span id="permCountLabel">
                            <strong id="selectedCount">0</strong> of {{ $permissionsByModule->flatten()->count() }}
                            permissions selected
                        </span>
                        <div class="perm-counter-progress">
                            <div class="perm-counter-fill" id="permCountFill" style="width:0%"></div>
                        </div>
                    </div>

                    <div class="permission-matrix-editor" id="permissionMatrixEditor">
                        @foreach ($permissionsByModule as $module => $permissions)
                            <div class="perm-module-block" data-module="{{ $module }}">
                                <div class="perm-module-header">
                                    <div class="perm-module-title-wrap">
                                        <span class="perm-module-icon">
                                            <i class="bi bi-grid-3x3-gap-fill"></i>
                                        </span>
                                        <span class="perm-module-title">
                                            {{ ucwords(str_replace(['_', '-'], ' ', $module)) }}
                                        </span>
                                        <span class="perm-module-count">{{ $permissions->count() }}</span>
                                    </div>
                                    <label class="module-select-all-label">
                                        <input type="checkbox" class="module-select-all"
                                            data-module="{{ $module }}" />
                                        <span>Select all</span>
                                    </label>
                                </div>
                                <div class="perm-checkboxes-grid">
                                    @foreach ($permissions as $permission)
                                        <label
                                            class="perm-checkbox-item {{ isset($rolePermissionIds) && in_array($permission->id, $rolePermissionIds) ? 'checked' : '' }}"
                                            id="perm-label-{{ $permission->id }}">
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                                id="perm-{{ $permission->id }}" class="perm-checkbox"
                                                data-module="{{ $module }}"
                                                {{ isset($rolePermissionIds) && in_array($permission->id, $rolePermissionIds) ? 'checked' : '' }} />
                                            <span class="perm-checkbox-custom"></span>
                                            <div class="perm-info">
                                                <span class="perm-item-name">{{ $permission->name }}</span>
                                                <span class="perm-item-slug">{{ $permission->slug }}</span>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Submit --}}
                    <div class="form-footer">
                        <a href="{{ route('admin.roles.index') }}" class="btn-cancel">
                            <i class="bi bi-x-lg me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn-primary-solid ripple-btn" id="submitRole">
                            <i class="bi bi-{{ isset($role) ? 'check-lg' : 'plus-lg' }} me-2"></i>
                            {{ isset($role) ? 'Update Role' : 'Create Role' }}
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </form>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const nameInput = document.getElementById('name');
            const slugPreview = document.getElementById('slugPreview');
            const previewName = document.getElementById('previewName');
            const previewDesc = document.getElementById('previewDesc');
            const descInput = document.getElementById('description');
            const previewBadge = document.getElementById('previewBadge');
            const previewDot = document.getElementById('previewDot');
            const previewIcon = document.getElementById('previewIcon');
            const selectedCountEl = document.getElementById('selectedCount');
            const previewPermNum = document.getElementById('previewPermNum');
            const permCountFill = document.getElementById('permCountFill');
            const allCheckboxes = document.querySelectorAll('.perm-checkbox');
            const totalPerms = allCheckboxes.length;

            // ── Slug generator ─────────────────────────────────────────────
            function toSlug(str) {
                return str.toLowerCase().trim().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
            }

            if (nameInput && slugPreview) {
                nameInput.addEventListener('input', () => {
                    const slug = toSlug(nameInput.value) || 'role-slug';
                    slugPreview.textContent = slug;
                    if (previewName) previewName.textContent = nameInput.value || 'Role Name';
                });
            }

            if (descInput && previewDesc) {
                descInput.addEventListener('input', () => {
                    previewDesc.textContent = descInput.value || 'Role description will appear here…';
                });
            }

            // ── Color picker ───────────────────────────────────────────────
            document.querySelectorAll('input[name="color"]').forEach(radio => {
                radio.addEventListener('change', () => {
                    const color = radio.value;
                    if (previewBadge) {
                        previewBadge.style.background = color + '20';
                        previewBadge.style.borderColor = color + '40';
                    }
                    if (previewDot) previewDot.style.background = color;
                    if (previewName) previewName.style.color = color;
                    if (previewIcon) previewIcon.style.color = color;

                    // Update swatch check marks
                    document.querySelectorAll('.color-swatch').forEach(sw => sw.textContent = '');
                    radio.nextElementSibling.textContent = '✓';
                    document.querySelectorAll('.color-option').forEach(opt => opt.classList.remove(
                        'selected'));
                    radio.closest('.color-option')?.classList.add('selected');
                });
            });

            // ── Permission counter ─────────────────────────────────────────
            function updatePermCount() {
                const checked = document.querySelectorAll('.perm-checkbox:checked').length;
                if (selectedCountEl) selectedCountEl.textContent = checked;
                if (previewPermNum) previewPermNum.textContent = checked;
                if (permCountFill) permCountFill.style.width = totalPerms > 0 ? (checked / totalPerms * 100) + '%' :
                    '0%';
            }

            allCheckboxes.forEach(cb => {
                cb.addEventListener('change', () => {
                    const label = document.getElementById('perm-label-' + cb.value);
                    if (label) label.classList.toggle('checked', cb.checked);
                    updatePermCount();
                });
            });

            // ── Module select-all ──────────────────────────────────────────
            document.querySelectorAll('.module-select-all').forEach(cb => {
                cb.addEventListener('change', () => {
                    const mod = cb.getAttribute('data-module');
                    document.querySelectorAll(`.perm-checkbox[data-module="${mod}"]`).forEach(
                        perm => {
                            perm.checked = cb.checked;
                            const label = document.getElementById('perm-label-' + perm.value);
                            if (label) label.classList.toggle('checked', cb.checked);
                        });
                    updatePermCount();
                });
            });

            // ── Global select/deselect ─────────────────────────────────────
            document.getElementById('selectAll')?.addEventListener('click', () => {
                allCheckboxes.forEach(cb => {
                    cb.checked = true;
                    document.getElementById('perm-label-' + cb.value)?.classList.add('checked');
                });
                document.querySelectorAll('.module-select-all').forEach(cb => cb.checked = true);
                updatePermCount();
            });

            document.getElementById('deselectAll')?.addEventListener('click', () => {
                allCheckboxes.forEach(cb => {
                    cb.checked = false;
                    document.getElementById('perm-label-' + cb.value)?.classList.remove('checked');
                });
                document.querySelectorAll('.module-select-all').forEach(cb => cb.checked = false);
                updatePermCount();
            });

            // Initial count
            updatePermCount();

            // Update module-select-all checkboxes to reflect pre-checked state
            document.querySelectorAll('.module-select-all').forEach(cb => {
                const mod = cb.getAttribute('data-module');
                const modPerms = document.querySelectorAll(`.perm-checkbox[data-module="${mod}"]`);
                const allChecked = [...modPerms].every(p => p.checked);
                cb.checked = allChecked && modPerms.length > 0;
            });
        });
    </script>
@endpush
