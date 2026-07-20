<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'slug',
        'module',
        'description',
    ];

    // ─── Relationships ───────────────────────────────────────────────

    /**
     * A permission belongs to many roles (many-to-many).
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'role_permission',
            'permission_id',
            'role_id'
        );
    }

    // ─── Scopes ──────────────────────────────────────────────────────

    /**
     * Scope: filter by module.
     */
    public function scopeByModule($query, string $module)
    {
        return $query->where('module', $module);
    }

    /**
     * Scope: order by module then name for consistent grouping.
     */
    public function scopeGroupedByModule($query)
    {
        return $query->orderBy('module')->orderBy('name');
    }

    // ─── Helpers ─────────────────────────────────────────────────────

    /**
     * Get all distinct modules from the permissions table.
     */
    public static function allModules(): array
    {
        return self::select('module')
            ->distinct()
            ->orderBy('module')
            ->pluck('module')
            ->toArray();
    }

    /**
     * Get permissions grouped by module as a collection.
     */
    public static function groupedByModule()
    {
        return self::groupedByModule()->get()->groupBy('module');
    }
}
