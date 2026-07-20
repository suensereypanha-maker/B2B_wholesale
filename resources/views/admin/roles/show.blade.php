@extends('layouts.admin.dashboard')

@section('title', 'Role: '.$role->name)
@section('page-title', 'Role Detail')

@section('content')

<div class="page-header animate-fadeInUp">
    <div class="page-header-left">
        <a href="{{ route('admin.roles.index') }}" class="page-back-btn">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div class="page-header-icon" style="background:{{ $role->color }}20;color:{{ $role->color }}">
            <i class="bi bi-shield-fill-check"></i>
        </div>
        <div>
            <h1 class="page-header-title">{{ $role->name }}</h1>
            <p class="page-header-subtitle">{{ $role->description ?? 'No description.' }}</p>
        </div>
    </div>
    <div class="page-header-actions">
        @if(!$role->is_system)
        <a href="{{ route('admin.roles.edit', $role) }}" class="btn-primary-solid ripple-btn">
            <i class="bi bi-pencil-fill me-2"></i> Edit Role
        </a>
        @endif
    </div>
</div>

<div class="row g-4">

    {{-- Role Info Card --}}
    <div class="col-12 col-lg-4">
        <div class="card-panel animate-fadeInUp" style="animation-delay:.06s">
            <div class="panel-header">
                <h2 class="panel-title">Role Info</h2>
            </div>
            <div class="form-body">
                <div class="detail-row">
                    <span class="detail-label">Name</span>
                    <span class="role-badge" style="background:{{ $role->color }}20;border:1.5px solid {{ $role->color }}40;">
                        <span class="role-badge-dot" style="background:{{ $role->color }}"></span>
                        <span class="role-badge-name" style="color:{{ $role->color }}">{{ $role->name }}</span>
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Slug</span>
                    <code class="detail-code">{{ $role->slug }}</code>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Type</span>
                    @if($role->is_system)
                    <span class="system-badge"><i class="bi bi-lock-fill me-1"></i>System Role</span>
                    @else
                    <span class="status-badge status-completed"><span class="status-dot"></span>Custom</span>
                    @endif
                </div>
                <div class="detail-row">
                    <span class="detail-label">Users</span>
                    <strong>{{ $role->users->count() }}</strong>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Permissions</span>
                    <strong>{{ $role->permissions->count() }}</strong>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Created</span>
                    <span>{{ $role->created_at->format('d M Y') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Updated</span>
                    <span>{{ $role->updated_at->diffForHumans() }}</span>
                </div>
            </div>
        </div>

        {{-- Users with this Role --}}
        <div class="card-panel animate-fadeInUp" style="animation-delay:.1s">
            <div class="panel-header">
                <h2 class="panel-title">Users ({{ $role->users->count() }})</h2>
            </div>
            <div class="users-role-list">
                @forelse($role->users as $user)
                <div class="users-role-item">
                    <div class="user-avatar-sm" style="background:{{ $role->color }}">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                    <div class="user-info-sm">
                        <span class="user-name-sm">{{ $user->name }}</span>
                        <span class="user-email-sm">{{ $user->email }}</span>
                    </div>
                    <span class="status-badge {{ $user->is_active ? 'status-completed' : 'status-cancelled' }}">
                        <span class="status-dot"></span>
                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                @empty
                <div class="empty-state-sm">
                    <i class="bi bi-person-slash"></i>
                    <span>No users assigned to this role</span>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Permission Matrix (Read-Only) --}}
    <div class="col-12 col-lg-8">
        <div class="card-panel animate-fadeInUp" style="animation-delay:.08s">
            <div class="panel-header">
                <div>
                    <h2 class="panel-title">Permissions ({{ $role->permissions->count() }})</h2>
                    <p class="panel-subtitle">All permissions assigned to the {{ $role->name }} role</p>
                </div>
            </div>
            <div class="permission-matrix-editor" style="padding-top:8px">
                @foreach($permissionsByModule as $module => $permissions)
                <div class="perm-module-block">
                    <div class="perm-module-header">
                        <div class="perm-module-title-wrap">
                            <span class="perm-module-icon"><i class="bi bi-grid-3x3-gap-fill"></i></span>
                            <span class="perm-module-title">{{ ucwords(str_replace(['_', '-'], ' ', $module)) }}</span>
                            @php
                                $hasCount = $permissions->filter(fn($p) => in_array($p->id, $rolePermissionIds))->count();
                            @endphp
                            <span class="perm-module-count">{{ $hasCount }} / {{ $permissions->count() }}</span>
                        </div>
                    </div>
                    <div class="perm-checkboxes-grid">
                        @foreach($permissions as $permission)
                        @php $has = in_array($permission->id, $rolePermissionIds); @endphp
                        <div class="perm-checkbox-item perm-readonly {{ $has ? 'checked' : 'unchecked' }}">
                            <span class="perm-checkbox-custom {{ $has ? 'checked' : '' }}">
                                @if($has) ✓ @endif
                            </span>
                            <div class="perm-info">
                                <span class="perm-item-name">{{ $permission->name }}</span>
                                <span class="perm-item-slug">{{ $permission->slug }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

@endsection
