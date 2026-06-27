<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitorPrice extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'recorded_at' => 'datetime',
        'active_sale' => 'boolean',
    ];

    public function competitor()
    {
        return $this->belongsTo(Competitor::class);
    }
}
