<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $settings = PaymentSetting::first();
        
        // If no settings exist yet, we can show empty or get from env
        if (!$settings) {
            $settings = new PaymentSetting([
                'razorpay_key' => env('RAZORPAY_KEY'),
                'razorpay_secret' => env('RAZORPAY_SECRET')
            ]);
        }

        return view('admin.payment-settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'razorpay_key' => 'required|string',
            'razorpay_secret' => 'required|string',
            'payoneer_client_id' => 'nullable|string',
            'payoneer_client_secret' => 'nullable|string',
        ]);

        PaymentSetting::updateOrCreate(
            ['id' => 1],
            [
                'razorpay_key' => $validated['razorpay_key'],
                'razorpay_secret' => $validated['razorpay_secret'],
                'payoneer_client_id' => $validated['payoneer_client_id'] ?? null,
                'payoneer_client_secret' => $validated['payoneer_client_secret'] ?? null,
            ]
        );

        return redirect()->back()->with('success', 'Payment credentials updated successfully!');
    }
}
