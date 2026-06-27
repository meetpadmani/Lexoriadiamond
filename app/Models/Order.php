<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'first_name',
        'last_name',
        'email',
        'mobile',
        'address',
        'city',
        'pincode',
        'payment_method',
        'total_amount',
        'tax_amount',
        'discount_amount',
        'coupon_code',
        'status',
        'gst_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function scopeConfirmed($query)
    {
        return $query->where(function($q) {
            $q->where('payment_method', '!=', 'razorpay')
              ->orWhere('status', '!=', 'pending');
        });
    }
}
