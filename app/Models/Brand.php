<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'logo',
        'website',
        'description',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_active'   => 'boolean',
        'is_featured' => 'boolean',
        'sort_order'  => 'integer',
    ];

    // ─── Scopes ──────────────────────────────────────────────────────

    /**
     * Scope: Only active brands.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Only featured brands.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
