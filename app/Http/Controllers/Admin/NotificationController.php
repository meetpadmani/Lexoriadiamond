<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class NotificationController extends Controller
{
    public function index()
    {
        // For now, let's fetch recent orders as "notifications"
        $notifications = Order::latest()->take(20)->get()->map(function($order) {
            return (object) [
                'id' => $order->id,
                'title' => 'New Order Received',
                'message' => 'Order #' . $order->order_number . ' has been placed by ' . ($order->user->name ?? 'Guest'),
                'time' => $order->created_at->diffForHumans(),
                'icon' => 'bi-cart-check',
                'color' => 'success',
                'link' => route('admin.orders.show', $order->id)
            ];
        });

        return view('admin.notifications.index', compact('notifications'));
    }
}
