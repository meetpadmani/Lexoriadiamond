<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitorStat extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'last_scraped_at' => 'datetime',
    ];

    public function competitor()
    {
        return $this->belongsTo(Competitor::class);
    }
}
