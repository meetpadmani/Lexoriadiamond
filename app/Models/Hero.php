<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'video_url',
        'button_1_text',
        'button_1_link',
        'button_2_text',
        'button_2_link',
        'is_active',
    ];
}
