<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoProduct extends Model
{
    protected $fillable = [
        'video_path',
        'product_image',
        'image2',
        'image3',
        'image4',
        'image5',
        'image6',
        'product_name',
        'slug',
        'description',
        'current_price',
        'original_price',
        'metal_type',
        'metal_purity',
        'weight',
        'sku',
        'views',
        'order',
        'is_active',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saving(function ($product) {
            if (empty($product->slug)) {
                $product->slug = \Illuminate\Support\Str::slug($product->product_name ?: 'product') . '-' . \Illuminate\Support\Str::random(5);
            }
        });
    }


}
