<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'description',
        'icon',
        'image',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // ─── Relationships ───────────────────────────────────────────────

    /**
     * Parent category (for subcategories).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Subcategories (children categories).
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')
            ->orderBy('sort_order')
            ->orderBy('name');
    }

    /**
     * Alias for subcategories.
     */
    public function children(): HasMany
    {
        return $this->subcategories();
    }

    // ─── Scopes ──────────────────────────────────────────────────────

    /**
     * Scope: Only parent categories (where parent_id IS NULL).
     */
    public function scopeParents($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeOnlyParents($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Scope: Only subcategories (where parent_id IS NOT NULL).
     */
    public function scopeSubcategories($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function scopeOnlySubcategories($query)
    {
        return $query->whereNotNull('parent_id');
    }

    /**
     * Scope: Only active categories.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ─── Accessors & Helpers ──────────────────────────────────────────

    public function getIsParentAttribute(): bool
    {
        return is_null($this->parent_id);
    }

    public function getIsSubcategoryAttribute(): bool
    {
        return !is_null($this->parent_id);
    }
}
