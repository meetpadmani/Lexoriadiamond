<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    protected $fillable = ['title', 'image', 'mobile_image', 'link', 'status'];
}
