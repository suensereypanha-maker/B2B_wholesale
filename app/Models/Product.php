<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'supplier_id',
        'name',
        'sku',
        'slug',
        'short_description',
        'description',
        'cost_price',
        'wholesale_price',
        'retail_price',
        'min_order_qty',
        'stock_qty',
        'image',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'cost_price'      => 'decimal:2',
        'wholesale_price' => 'decimal:2',
        'retail_price'    => 'decimal:2',
        'min_order_qty'   => 'integer',
        'stock_qty'       => 'integer',
        'is_active'       => 'boolean',
        'is_featured'     => 'boolean',
    ];

    // ─── Relationships ───────────────────────────────────────────────

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    // ─── Scopes ──────────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock_qty', '>', 0);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }
}
