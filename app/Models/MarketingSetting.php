<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketingSetting extends Model
{
    protected $fillable = [
        'meta_pixel_id',
        'meta_access_token',
        'google_ads_id',
        'google_ads_script',
        'meta_event_page_view',
        'meta_event_view_content',
        'meta_event_add_to_cart',
        'meta_event_initiate_checkout',
        'meta_event_purchase'
    ];
}
