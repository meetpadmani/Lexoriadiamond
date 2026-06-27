<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandStory extends Model
{
    protected $fillable = [
        'subtitle',
        'title',
        'content',
        'image',
        'stat_1_num',
        'stat_1_label',
        'stat_2_num',
        'stat_2_label',
        'button_text',
        'button_link',
    ];
}
