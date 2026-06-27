<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['items.product'])
            ->latest()
            ->paginate(10);

        return view('frontend.orders.index', compact('orders'));
    }

    public function show($orderNumber)
    {
        $order = Order::where('user_id', Auth::id())
            ->where('order_number', $orderNumber)
            ->with(['items.product.collection'])
            ->firstOrFail();

        return view('frontend.order-detail', compact('order'));
    }
}
