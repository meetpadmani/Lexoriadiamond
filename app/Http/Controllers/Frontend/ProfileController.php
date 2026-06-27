<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Order;
use App\Models\WishlistItem;

class ProfileController extends Controller
{
    /**
     * Display the user's unified profile dashboard.
     */
    public function index()
    {
        $user = Auth::user();

        // Fetch user's orders
        $orders = Order::where('user_id', $user->id)
            ->with(['items.product'])
            ->latest()
            ->paginate(5); // Show top 5 on dashboard

        // Fetch user's wishlist items
        $wishlists = WishlistItem::where('user_id', $user->id)
            ->with('product')
            ->latest()
            ->get();

        return view('frontend.profile.index', compact('user', 'orders', 'wishlists'));
    }

    /**
     * Update the user's profile information.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully.');
    }

    /**
     * Download a purchased digital product securely.
     */
    public function downloadDigitalProduct($id)
    {
        $user = Auth::user();
        $product = \App\Models\Product::findOrFail($id);

        if (!$product->is_digital || empty($product->digital_file_path)) {
            return back()->with('error', 'This product is not a valid digital download.');
        }

        // Verify purchase by checking OrderItems linked to this User's Orders
        $orderItem = \App\Models\OrderItem::whereHas('order', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('product_id', $product->id)->first();

        if (!$orderItem) {
            return back()->with('error', 'You must purchase this digital product before downloading it.');
        }

        if (!\Illuminate\Support\Facades\Storage::disk('local')->exists($product->digital_file_path)) {
            return back()->with('error', 'The digital file could not be found on the secure server.');
        }

        $order = $orderItem->order;
        if ($order && $order->status == 'delivered') {
            $order->update(['status' => 'downloaded']);
        }

        return \Illuminate\Support\Facades\Storage::disk('local')->download($product->digital_file_path);
    }
}
