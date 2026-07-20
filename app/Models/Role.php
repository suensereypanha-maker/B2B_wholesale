<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'is_system',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'is_system' => 'boolean',
    ];

    // ─── Relationships ───────────────────────────────────────────────

    /**
     * A role belongs to many permissions (many-to-many).
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'role_permission',
            'role_id',
            'permission_id'
        );
    }

    /**
     * A role has many users.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'role_id');
    }

    // ─── Accessors ───────────────────────────────────────────────────

    /**
     * Get user count for this role.
     */
    public function getUserCountAttribute(): int
    {
        return $this->users()->count();
    }

    /**
     * Get permission count for this role.
     */
    public function getPermissionCountAttribute(): int
    {
        return $this->permissions()->count();
    }

    // ─── Scopes ──────────────────────────────────────────────────────

    /**
     * Scope: only system roles.
     */
    public function scopeSystem($query)
    {
        return $query->where('is_system', true);
    }

    /**
     * Scope: only non-system (custom) roles.
     */
    public function scopeCustom($query)
    {
        return $query->where('is_system', false);
    }

    // ─── Helpers ─────────────────────────────────────────────────────

    /**
     * Check if this role has a specific permission by slug.
     */
    public function hasPermission(string $slug): bool
    {
        return $this->permissions->contains('slug', $slug);
    }

    /**
     * Sync permissions by an array of permission IDs.
     */
    public function syncPermissions(array $permissionIds): void
    {
        $this->permissions()->sync($permissionIds);
    }
}
