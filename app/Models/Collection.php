<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Collection extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'description',
        'image',
        'type',
        'overlay_position',
        'order',
        'meta_title',
        'meta_description',
        'schema_markup',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function activeProducts()
    {
        return $this->hasMany(Product::class)->where('is_active', true)->orderBy('order');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($collection) {
            if (empty($collection->slug)) {
                $collection->slug = Str::slug($collection->title);
            }
        });
        static::updating(function ($collection) {
            if ($collection->isDirty('title') && !$collection->isDirty('slug')) {
                $collection->slug = Str::slug($collection->title);
            }
        });
    }
}
