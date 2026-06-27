<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Exclude Razorpay orders that are still 'pending' (meaning payment was not successful/abandoned)
        $orders = Order::where(function($q) {
                $q->where('payment_method', '!=', 'razorpay')
                  ->orWhere('status', '!=', 'pending');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        $abandonedCartsCount = \App\Models\User::has('cartItems')->count();
        return view('admin.orders.index', compact('orders', 'abandonedCartsCount'));
    }

    public function show(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders.show', compact('order'));
    }

    public function sticker(Order $order)
    {
        $order->load('items.product');
        return view('admin.orders.sticker', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return back()->with('success', 'Order status updated successfully.');
    }

    public function updateTracking(Request $request, Order $order)
    {
        $request->validate([
            'courier_name' => 'required|string|max:255',
            'tracking_number' => 'required|string|max:255',
            'tracking_url' => 'nullable|url'
        ]);

        $order->update([
            'courier_name' => $request->courier_name,
            'tracking_number' => $request->tracking_number,
            'tracking_url' => $request->tracking_url
        ]);

        return back()->with('success', 'Tracking information updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}
