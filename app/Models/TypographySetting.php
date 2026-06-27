<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypographySetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'heading_font_family',
        'heading_font_url',
        'body_font_family',
        'body_font_url',
        'accent_color'
    ];
}
