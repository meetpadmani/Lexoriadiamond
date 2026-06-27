<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type',
        'value',
        'min_purchase_amount',
        'usage_limit',
        'used_count',
        'expiry_date',
        'is_active',
        'is_one_time',
    ];

    protected $casts = [
        'expiry_date' => 'date',
        'is_active' => 'boolean',
        'is_one_time' => 'boolean',
    ];

    /**
     * Check if the coupon is valid.
     */
    public function isValid($amount = 0, $userId = null)
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->expiry_date && $this->expiry_date->isPast()) {
            return false;
        }

        if ($this->usage_limit && $this->used_count >= $this->usage_limit) {
            return false;
        }

        if ($amount < $this->min_purchase_amount) {
            return false;
        }
        
        if ($this->is_one_time && $userId) {
            $hasUsed = \App\Models\Order::where('user_id', $userId)
                ->where('coupon_code', $this->code)
                ->where('status', '!=', 'cancelled')
                ->exists();
                
            if ($hasUsed) {
                return false;
            }
        }

        return true;
    }

    /**
     * Calculate discount amount.
     */
    public function calculateDiscount($total)
    {
        if ($this->type === 'percentage') {
            return ($this->value / 100) * $total;
        }

        return min($this->value, $total);
    }
}
