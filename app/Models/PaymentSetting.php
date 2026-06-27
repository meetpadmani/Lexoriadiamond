<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentSetting extends Model
{
    protected $fillable = [
        'razorpay_key', 
        'razorpay_secret',
        'payoneer_client_id',
        'payoneer_client_secret'
    ];
}
