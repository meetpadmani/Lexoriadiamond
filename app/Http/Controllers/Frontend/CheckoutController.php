<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentSetting;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;
use App\Services\WhatsAppService;

class CheckoutController extends Controller
{
    private function getRazorpayApi()
    {
        $settings = PaymentSetting::first();
        $key = $settings->razorpay_key ?? env('RAZORPAY_KEY');
        $secret = $settings->razorpay_secret ?? env('RAZORPAY_SECRET');
        
        if (!$key || !$secret) {
            throw new \Exception('Razorpay credentials not configured. Please contact the administrator.');
        }
        
        return new Api($key, $secret);
    }

    private function getRazorpayKey()
    {
        $settings = PaymentSetting::first();
        return $settings ? ($settings->razorpay_key ?? env('RAZORPAY_KEY')) : env('RAZORPAY_KEY');
    }

    private function getCartItems()
    {
        if (\Illuminate\Support\Facades\Auth::check()) {
            $items = \App\Models\CartItem::with('product')->where('user_id', \Illuminate\Support\Facades\Auth::id())->get();
            $cart = [];
            foreach ($items as $item) {
                $cart[$item->product_id] = [
                    "id" => $item->product_id,
                    "name" => $item->product->name,
                    "quantity" => $item->quantity,
                    "price" => $item->product->price,
                    "image" => $item->product->image
                ];
            }
            return $cart;
        }

        return session()->get('cart', []);
    }

    private function clearCart()
    {
        if (\Illuminate\Support\Facades\Auth::check()) {
            \App\Models\CartItem::where('user_id', \Illuminate\Support\Facades\Auth::id())->delete();
        }
        session()->forget(['cart', 'coupon']);
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $coupon = \App\Models\Coupon::where('code', $request->code)->first();

        if (!$coupon) {
            return back()->with('error', 'The royal treasury does not recognize this mandate code.');
        }

        $cartItems = $this->getCartItems();
        $total = collect($cartItems)->sum(fn($i) => $i['price'] * $i['quantity']);

        if (!$coupon->isValid($total, auth()->id())) {
            return back()->with('error', 'This mandate code is no longer valid or requirements are not met.');
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'discount' => $coupon->calculateDiscount($total),
        ]);

        return back()->with('success', 'Royal discount mandate applied successfully!');
    }

    public function index()
    {
        $cartItems = $this->getCartItems();
        if (count($cartItems) == 0) {
            return redirect()->route('cart.index')->with('error', 'Your royal cart is empty.');
        }
        
        $total = collect($cartItems)->sum(fn($i) => $i['price'] * $i['quantity']);
        $coupon = session()->get('coupon');
        $discount = 0;

        if ($coupon) {
            $discount = $coupon['discount'];
        }

        $isOnlyDigital = true;
        foreach ($cartItems as $item) {
            $product = \App\Models\Product::find($item['id'] ?? null);
            if (!$product || !$product->is_digital) {
                $isOnlyDigital = false;
                break;
            }
        }

        return view('frontend.checkout', compact('cartItems', 'total', 'discount', 'isOnlyDigital'));
    }

    public function placeOrder(Request $request)
    {
        $cartItems = $this->getCartItems();
        
        if (count($cartItems) == 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $isOnlyDigital = true;
        foreach ($cartItems as $item) {
            $product = \App\Models\Product::find($item['id'] ?? null);
            if (!$product || !$product->is_digital) {
                $isOnlyDigital = false;
                break;
            }
        }

        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required',
            'payment_method' => 'required'
        ];

        if ($isOnlyDigital) {
            $rules['country'] = 'required';
        } else {
            $rules['address'] = 'required';
            $rules['city'] = 'required';
            $rules['pincode'] = 'required';
        }

        $request->validate($rules);

        try {
            DB::beginTransaction();

            $subtotal = collect($cartItems)->sum(fn($i) => $i['price'] * $i['quantity']);
            $coupon = session()->get('coupon');
            $discount = $coupon ? $coupon['discount'] : 0;
            
            // Calculate 3% Tax (Standard for Jewellery)
            $taxAmount = ($subtotal - $discount) * 0.03;
            $total = ($subtotal - $discount) + $taxAmount;

            $orderNumber = 'BD-' . strtoupper(substr(md5(time()), 0, 8));

            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => $orderNumber,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'address' => $isOnlyDigital ? $request->country : $request->address,
                'city' => $isOnlyDigital ? 'Digital' : $request->city,
                'pincode' => $isOnlyDigital ? '000000' : $request->pincode,
                'payment_method' => $request->payment_method,
                'total_amount' => $total,
                'tax_amount' => $taxAmount,
                'discount_amount' => $discount,
                'coupon_code' => $coupon ? $coupon['code'] : null,
                'status' => 'pending',
                'gst_number' => $request->gst_number
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'] ?? null,
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['price'] * $item['quantity']
                ]);
            }

            // Update coupon used count
            if ($coupon) {
                $couponModel = \App\Models\Coupon::where('code', $coupon['code'])->first();
                if ($couponModel) {
                    $couponModel->increment('used_count');
                }
            }

            if ($request->payment_method == 'razorpay') {
                $api = $this->getRazorpayApi();
                
                $razorpayOrder = $api->order->create([
                    'receipt'         => $order->order_number,
                    'amount'          => (int)round($total * 100),
                    'currency'        => 'USD',
                ]);

                // Commit BEFORE returning the razorpay view
                DB::commit();

                return view('frontend.razorpay_checkout', [
                    'order' => $order,
                    'razorpay_order_id' => $razorpayOrder['id'],
                    'razorpay_key' => $this->getRazorpayKey(),
                    'amount' => (int)round($total * 100)
                ]);
            }

            // If not Razorpay (COD or Bank Transfer), commit and clear cart
            DB::commit();
            $this->clearCart();

            // Send Digital Product Email if applicable
            if ($isOnlyDigital) {
                $order->update(['status' => 'delivered']);
                try {
                    \Illuminate\Support\Facades\Mail::to($order->email)->send(new \App\Mail\DigitalProductPurchased($order));
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Failed to send digital product email: ' . $e->getMessage());
                }
            }
            
            // Send WhatsApp Order Confirmation
            if ($order->mobile) {
                $waService = app(WhatsAppService::class);
                $product = $order->items->first()->product ?? null;
                $imageUrl = $product && $product->cover_image ? asset('storage/' . $product->cover_image) : null;
                $trackUrl = route('order.tracking', $order->order_number);
                
                $message = "*Lexoria Diamond Studio* 💎\n\nThank you for your royal mandate! Your order *{$order->order_number}* is confirmed. ✅\n\n*Total Invoice:* $" . number_format($order->total_amount) . "\n\nTrack your order securely here: {$trackUrl}";
                
                if ($isOnlyDigital) {
                    $message .= "\n\n*Digital Downloads:* Your digital products have been sent to your email! 📥";
                }
                
                $waService->sendMessage($order->mobile, $message, $imageUrl);
            }

            return redirect()->route('order.success', $order->order_number);

        } catch (\Exception $e) {
            if (DB::transactionLevel() > 0) {
                DB::rollBack();
            }
            
            return back()->with('error', 'Order Error: ' . $e->getMessage())->withInput();
        }
    }

    public function paymentCallback(Request $request)
    {
        $input = $request->all();
        $api = $this->getRazorpayApi();

        try {
            $attributes = [
                'razorpay_order_id' => $input['razorpay_order_id'],
                'razorpay_payment_id' => $input['razorpay_payment_id'],
                'razorpay_signature' => $input['razorpay_signature']
            ];

            $api->utility->verifyPaymentSignature($attributes);

            $order = Order::where('order_number', $request->order_number)->firstOrFail();
            $order->update(['status' => 'processing']);

            // Clear Cart and Coupon
            $this->clearCart();

            // Send Digital Product Email if applicable
            $isOnlyDigital = true;
            foreach ($order->items as $item) {
                if (!$item->product || !$item->product->is_digital) {
                    $isOnlyDigital = false;
                    break;
                }
            }
            if ($isOnlyDigital) {
                $order->update(['status' => 'delivered']);
                try {
                    \Illuminate\Support\Facades\Mail::to($order->email)->send(new \App\Mail\DigitalProductPurchased($order));
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::error('Failed to send digital product email: ' . $e->getMessage());
                }
            }

            // Send WhatsApp Order Confirmation
            if ($order->mobile) {
                $waService = app(WhatsAppService::class);
                $product = $order->items->first()->product ?? null;
                $imageUrl = $product && $product->cover_image ? asset('storage/' . $product->cover_image) : null;
                $trackUrl = route('order.tracking', $order->order_number);
                
                $message = "*Lexoria Diamond Studio* 💎\n\nThank you for your royal mandate! Your order *{$order->order_number}* is confirmed. ✅\n\n*Total Invoice:* $" . number_format($order->total_amount) . "\n\nTrack your order securely here: {$trackUrl}";
                
                if ($isOnlyDigital) {
                    $message .= "\n\n*Digital Downloads:* Your digital products have been sent to your email! 📥";
                }
                
                $waService->sendMessage($order->mobile, $message, $imageUrl);
            }

            return redirect()->route('order.success', $order->order_number);

        } catch (\Exception $e) {
            return redirect()->route('checkout.index')->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function success($id)
    {
        $order = Order::with('items')
            ->where('order_number', $id)
            ->firstOrFail();
        
        if ($order->payment_method == 'bank_transfer') {
            return view('frontend.bank_transfer', compact('order'));
        }
        
        return view('frontend.success', compact('order'));
    }

    public function invoice($id)
    {
        $order = Order::with('items.product')
            ->where('order_number', $id)
            ->firstOrFail();
        return view('frontend.invoice', compact('order'));
    }
}
