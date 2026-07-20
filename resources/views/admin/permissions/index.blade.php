@extends('layouts.admin.dashboard')

@section('title', 'Permissions')
@section('page-title', 'Permissions')

@section('content')

@if(session('success'))
<div class="flash-alert flash-success animate-fadeInUp">
    <i class="bi bi-check-circle-fill"></i>
    <span>{{ session('success') }}</span>
    <button class="flash-close" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button>
</div>
@endif

<div class="page-header animate-fadeInUp">
    <div class="page-header-left">
        <a href="{{ route('admin.roles.index') }}" class="page-back-btn" title="Back to Roles">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div class="page-header-icon" style="background:var(--violet-light);color:var(--violet)">
            <i class="bi bi-key-fill"></i>
        </div>
        <div>
            <h1 class="page-header-title">Permissions</h1>
            <p class="page-header-subtitle">{{ $totalPermissions }} permissions across {{ $totalModules }} modules</p>
        </div>
    </div>
    <div class="page-header-actions">
        <a href="{{ route('admin.permissions.create') }}" class="btn-primary-solid ripple-btn" id="btn-create-perm">
            <i class="bi bi-plus-lg me-2"></i> New Permission
        </a>
    </div>
</div>

{{-- Module Tabs --}}
<div class="card-panel animate-fadeInUp" style="animation-delay:.06s">
    <div class="panel-header" style="flex-wrap:wrap;gap:12px">
        <div>
            <h2 class="panel-title">All Permissions</h2>
            <p class="panel-subtitle">Grouped by module — click a module tab to filter</p>
        </div>
        <div class="panel-actions" style="flex-wrap:wrap">
            <div class="chart-period-toggle" id="permModuleFilter" style="flex-wrap:wrap">
                <button class="period-btn active" data-module="all">All</button>
                @foreach($permissionsByModule->keys() as $mod)
                <button class="period-btn" data-module="{{ $mod }}">
                    {{ ucwords(str_replace(['_', '-'], ' ', $mod)) }}
                </button>~
                @endforeach
            </div>
        </div>
    </div>

    <div class="permissions-module-list" id="permModuleList">
        @foreach($permissionsByModule as $module => $permissions)
        <div class="perm-module-section" data-module="{{ $module }}" id="perm-section-{{ $module }}">

            {{-- Module Header --}}
            <div class="perm-section-header">
                <div class="perm-section-title">
                    <span class="perm-section-dot"></span>
                    <span>{{ ucwords(str_replace(['_', '-'], ' ', $module)) }}</span>
                    <span class="perm-section-count">{{ $permissions->count() }} permissions</span>
                </div>
                <div class="perm-section-roles">
                    @foreach($roles->take(4) as $role)
                    <span class="perm-role-mini-badge" style="background:{{ $role->color }}20;color:{{ $role->color }};border:1px solid {{ $role->color }}30">
                        {{ $role->name }}
                    </span>
                    @endforeach
                </div>
            </div>

            {{-- Permissions Table --}}
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Permission Name</th>
                            <th>Slug</th>
                            <th>Roles with Access</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                        <tr>
                            <td>
                                <div class="perm-cell">
                                    <span class="perm-name">{{ $permission->name }}</span>
                                    @if($permission->description)
                                    <span class="perm-slug">{{ $permission->description }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <code class="perm-code">{{ $permission->slug }}</code>
                            </td>
                            <td>
                                <div class="perm-roles-chips">
                                    @forelse($permission->roles as $role)
                                    <span class="perm-role-chip"
                                          style="background:{{ $role->color }}15;color:{{ $role->color }};border:1px solid {{ $role->color }}30">
                                        {{ $role->name }}
                                    </span>
                                    @empty
                                    <span class="text-muted" style="font-size:.78rem">No roles</span>
                                    @endforelse
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="table-actions">
                                    <a href="{{ route('admin.permissions.edit', $permission) }}"
                                       class="tbl-action-btn" title="Edit permission">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form method="POST"
                                          action="{{ route('admin.permissions.destroy', $permission) }}"
                                          style="display:inline"
                                          onsubmit="return confirm('Delete permission \'{{ $permission->name }}\'? This will remove it from all roles.')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="tbl-action-btn tbl-action-danger" title="Delete permission">
                                            <i class="bi bi-trash3-fill"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const filterBtns = document.querySelectorAll('#permModuleFilter .period-btn');
    const sections   = document.querySelectorAll('.perm-module-section');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            const mod = btn.getAttribute('data-module');
            sections.forEach(sec => {
                sec.style.display = (mod === 'all' || sec.getAttribute('data-module') === mod) ? '' : 'none';
            });
        });
    });
});
</script>
@endpush
