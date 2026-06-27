<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'collection_id',
        'name',
        'slug',
        'description',
        'image',
        'image2',
        'image3',
        'image4',
        'image5',
        'image6',
        'price',
        'cost_price',
        'original_price',
        'sku',
        'metal_type',
        'metal_purity',
        'weight',
        'is_active',
        'is_featured',
        'is_digital',
        'product_type',
        'digital_file_path',
        'order',
        'meta_title',
        'meta_description',
        'schema_markup',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'weight' => 'decimal:2',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name) . '-' . Str::random(5);
            }
        });
    }
}
