@extends('layouts.admin.dashboard')

@section('title', 'Roles & Permissions')
@section('page-title', 'Roles & Permissions')

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
        <div class="page-header-icon">
            <i class="bi bi-shield-lock-fill"></i>
        </div>
        <div>
            <h1 class="page-header-title">Roles & Permissions</h1>
            <p class="page-header-subtitle">Manage access control — define roles and assign permissions to each.</p>
        </div>
    </div>
    <div class="page-header-actions">
        <a href="{{ route('admin.permissions.index') }}" class="btn-outline-primary-sm" id="btn-view-permissions">
            <i class="bi bi-key-fill me-1"></i> All Permissions
        </a>
        <a href="{{ route('admin.roles.create') }}" class="btn-primary-solid ripple-btn" id="btn-create-role">
            <i class="bi bi-plus-lg me-2"></i> New Role
        </a>
    </div>
</div>

{{-- Summary Stats --}}
<div class="roles-summary-grid animate-fadeInUp" style="animation-delay:.06s">
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--primary-light);color:var(--primary)">
            <i class="bi bi-shield-fill-check"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $roles->count() }}</div>
            <div class="roles-stat-label">Total Roles</div>
        </div>
    </div>
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--violet-light);color:var(--violet)">
            <i class="bi bi-key-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $totalPermissions }}</div>
            <div class="roles-stat-label">Permissions</div>
        </div>
    </div>
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--emerald-light);color:var(--emerald)">
            <i class="bi bi-people-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $totalUsers }}</div>
            <div class="roles-stat-label">Total Users</div>
        </div>
    </div>
    <div class="roles-stat-card">
        <div class="roles-stat-icon" style="background:var(--warning-light);color:var(--amber)">
            <i class="bi bi-lock-fill"></i>
        </div>
        <div>
            <div class="roles-stat-value">{{ $roles->where('is_system', true)->count() }}</div>
            <div class="roles-stat-label">System Roles</div>
        </div>
    </div>
</div>

{{-- Role Cards Grid --}}
<div class="card-panel animate-fadeInUp" style="animation-delay:.12s">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">All Roles</h2>
            <p class="panel-subtitle">Click on a role to view its full permission matrix</p>
        </div>
        <div class="panel-actions">
            <input type="search" class="search-input search-input-sm" id="roleSearch"
                   placeholder="Search roles…" style="min-width:200px;padding-left:36px;height:36px;">
        </div>
    </div>

    <div class="roles-cards-grid" id="rolesGrid">
        @forelse($roles as $role)
        <div class="role-card" data-role-name="{{ strtolower($role->name) }}" id="role-card-{{ $role->id }}">
            <div class="role-card-header">
                <div class="role-badge" style="background:{{ $role->color }}20;border:1.5px solid {{ $role->color }}40;">
                    <span class="role-badge-dot" style="background:{{ $role->color }}"></span>
                    <span class="role-badge-name" style="color:{{ $role->color }}">{{ $role->name }}</span>
                </div>
                @if($role->is_system)
                <span class="system-badge"><i class="bi bi-lock-fill me-1"></i>System</span>
                @endif
            </div>

            <p class="role-description">{{ $role->description ?? 'No description provided.' }}</p>

            <div class="role-stats">
                <div class="role-stat">
                    <i class="bi bi-key" style="color:{{ $role->color }}"></i>
                    <span><strong>{{ $role->permissions_count }}</strong> permissions</span>
                </div>
                <div class="role-stat">
                    <i class="bi bi-people" style="color:{{ $role->color }}"></i>
                    <span><strong>{{ $role->users_count }}</strong> users</span>
                </div>
            </div>

            {{-- Permission progress bar --}}
            @php $pct = $totalPermissions > 0 ? round(($role->permissions_count / $totalPermissions) * 100) : 0; @endphp
            <div class="role-perm-bar-wrap">
                <div class="role-perm-bar">
                    <div class="role-perm-fill" style="width:{{ $pct }}%;background:{{ $role->color }}"></div>
                </div>
                <span class="role-perm-pct">{{ $pct }}%</span>
            </div>

            <div class="role-card-actions">
                <a href="{{ route('admin.roles.show', $role) }}" class="role-action-btn" title="View Role">
                    <i class="bi bi-eye-fill"></i> View
                </a>
                <a href="{{ route('admin.roles.edit', $role) }}" class="role-action-btn" title="Edit Role">
                    <i class="bi bi-pencil-fill"></i> Edit
                </a>
                @if(!$role->is_system && $role->users_count === 0)
                <form method="POST" action="{{ route('admin.roles.destroy', $role) }}"
                      class="role-delete-form" onsubmit="return confirmDelete('{{ $role->name }}')">
                    @csrf @method('DELETE')
                    <button type="submit" class="role-action-btn role-action-delete" title="Delete Role">
                        <i class="bi bi-trash3-fill"></i> Delete
                    </button>
                </form>
                @else
                <span class="role-action-btn role-action-locked" title="{{ $role->is_system ? 'System role' : 'Has users assigned' }}">
                    <i class="bi bi-lock-fill"></i> {{ $role->is_system ? 'Protected' : 'In Use' }}
                </span>
                @endif
            </div>
        </div>
        @empty
        <div class="empty-state">
            <i class="bi bi-shield-exclamation"></i>
            <p>No roles found. <a href="{{ route('admin.roles.create') }}">Create the first role</a>.</p>
        </div>
        @endforelse
    </div>
</div>

{{-- Permission Matrix Table --}}
<div class="card-panel animate-fadeInUp" style="animation-delay:.18s">
    <div class="panel-header">
        <div>
            <h2 class="panel-title">Permission Matrix</h2>
            <p class="panel-subtitle">Overview of which roles have which permissions across all modules</p>
        </div>
        <div class="panel-actions">
            <div class="matrix-module-filter" id="matrixModuleFilter">
                <button class="period-btn active" data-module="all">All Modules</button>
                @foreach($permissionsByModule->keys() as $mod)
                <button class="period-btn" data-module="{{ $mod }}">
                    {{ ucwords(str_replace(['_', '-'], ' ', $mod)) }}
                </button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="table-responsive matrix-table-wrap">
        <table class="admin-table matrix-table" id="permissionMatrix">
            <thead>
                <tr>
                    <th class="matrix-perm-col">Permission</th>
                    <th class="matrix-module-col">Module</th>
                    @foreach($roles as $role)
                    <th class="text-center matrix-role-col">
                        <div class="matrix-role-header">
                            <span class="matrix-role-dot" style="background:{{ $role->color }}"></span>
                            <span class="matrix-role-name">{{ $role->name }}</span>
                        </div>
                    </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($permissionsByModule as $module => $permissions)
                {{-- Module Group Header --}}
                <tr class="matrix-module-row" data-module="{{ $module }}">
                    <td colspan="{{ $roles->count() + 2 }}">
                        <div class="matrix-module-label">
                            <i class="bi bi-grid-3x3-gap-fill me-2"></i>
                            {{ ucwords(str_replace(['_', '-'], ' ', $module)) }}
                            <span class="matrix-module-count">{{ $permissions->count() }} permissions</span>
                        </div>
                    </td>
                </tr>
                {{-- Permission Rows --}}
                @foreach($permissions as $permission)
                <tr class="matrix-perm-row" data-module="{{ $module }}">
                    <td>
                        <div class="perm-cell">
                            <span class="perm-name">{{ $permission->name }}</span>
                            <span class="perm-slug">{{ $permission->slug }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="module-tag">{{ ucwords(str_replace(['_', '-'], ' ', $module)) }}</span>
                    </td>
                    @foreach($roles as $role)
                    <td class="text-center">
                        @if($role->permissions->contains('id', $permission->id))
                            <span class="matrix-check" title="{{ $role->name }} has {{ $permission->name }}">
                                <i class="bi bi-check-circle-fill"></i>
                            </span>
                        @else
                            <span class="matrix-cross" title="{{ $role->name }} does not have {{ $permission->name }}">
                                <i class="bi bi-dash"></i>
                            </span>
                        @endif
                    </td>
                    @endforeach
                </tr>
                @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
// Role search filter
document.addEventListener('DOMContentLoaded', () => {
    const roleSearch = document.getElementById('roleSearch');
    if (roleSearch) {
        // Add a search icon inside
        roleSearch.style.paddingLeft = '36px';
        roleSearch.addEventListener('input', function () {
            const q = this.value.toLowerCase();
            document.querySelectorAll('.role-card').forEach(card => {
                const name = card.getAttribute('data-role-name') || '';
                card.style.display = name.includes(q) ? '' : 'none';
            });
        });
    }

    // Matrix module filter
    const filterBtns = document.querySelectorAll('#matrixModuleFilter .period-btn');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const mod = btn.getAttribute('data-module');
            document.querySelectorAll('.matrix-module-row, .matrix-perm-row').forEach(row => {
                if (mod === 'all') {
                    row.style.display = '';
                } else {
                    row.style.display = row.getAttribute('data-module') === mod ? '' : 'none';
                }
            });
        });
    });
});

function confirmDelete(roleName) {
    return confirm(`Are you sure you want to delete the role "${roleName}"? This action cannot be undone.`);
}
</script>
@endpush
