<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'added_at' => 'datetime',
    ];

    public function stats()
    {
        return $this->hasMany(CompetitorStat::class);
    }

    public function latestStat()
    {
        return $this->hasOne(CompetitorStat::class)->latestOfMany();
    }

    public function prices()
    {
        return $this->hasMany(CompetitorPrice::class);
    }

    public function latestPrice()
    {
        return $this->hasOne(CompetitorPrice::class)->latestOfMany();
    }

    public function alerts()
    {
        return $this->hasMany(CompetitorAlert::class);
    }
}
