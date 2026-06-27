<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CartItem;
use App\Models\WishlistItem;
use App\Mail\AbandonedCartReminder;
use App\Mail\WishlistReminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Services\WhatsAppService;

class EngagementController extends Controller
{
    public function abandonedCarts()
    {
        // Users who have items in cart but haven't placed an order recently
        // For simplicity, we get all users who have cart items
        $users = User::has('cartItems')
            ->with(['cartItems.product'])
            ->withCount('cartItems')
            ->get();

        return view('admin.engagement.abandoned_carts', compact('users'));
    }

    public function sendAbandonedReminder(User $user)
    {
        $cartItems = $user->cartItems()->with('product')->get();
        
        if ($cartItems->count() > 0) {
            Mail::to($user->email)->send(new AbandonedCartReminder($user, $cartItems));
            
            if ($user->phone) {
                $product = $cartItems->first()->product;
                $imageUrl = $product && $product->cover_image ? asset('storage/' . $product->cover_image) : null;
                $cartUrl = route('cart.index');
                
                $message = "*Lexoria Diamond Studio* 💎\n\nHi {$user->name}, we noticed you left some masterpieces in your cart! 🛒\n\n*Your Reserved Items:*\n";
                foreach ($cartItems as $item) {
                    if ($item->product) {
                        $message .= "- {$item->quantity}x {$item->product->name} ($" . number_format($item->product->price) . ")\n";
                    }
                }
                $message .= "\nReturn to your cart securely here to complete your checkout: {$cartUrl}";
                
                app(WhatsAppService::class)->sendMessage($user->phone, $message, $imageUrl);
            }

            return redirect()->back()->with('success', 'Reminder email & WhatsApp sent to ' . $user->name);
        }

        return redirect()->back()->with('error', 'Cart is empty.');
    }

    public function sendBulkAbandonedReminder(Request $request)
    {
        $userIds = $request->input('selected_users', []);
        
        if (empty($userIds)) {
            return redirect()->back()->with('error', 'No users selected.');
        }

        $users = User::whereIn('id', $userIds)->with(['cartItems.product'])->get();
        $sentCount = 0;
        $waService = app(WhatsAppService::class);

        foreach ($users as $user) {
            if ($user->cartItems->count() > 0) {
                Mail::to($user->email)->send(new AbandonedCartReminder($user, $user->cartItems));
                
                if ($user->phone) {
                    $product = $user->cartItems->first()->product;
                    $imageUrl = $product && $product->cover_image ? asset('storage/' . $product->cover_image) : null;
                    $cartUrl = route('cart.index');
                    
                    $message = "*Lexoria Diamond Studio* 💎\n\nHi {$user->name}, we noticed you left some masterpieces in your cart! 🛒\n\n*Your Reserved Items:*\n";
                    foreach ($user->cartItems as $item) {
                        if ($item->product) {
                            $message .= "- {$item->quantity}x {$item->product->name} ($" . number_format($item->product->price) . ")\n";
                        }
                    }
                    $message .= "\nReturn to your cart securely here to complete your checkout: {$cartUrl}";
                    
                    $waService->sendMessage($user->phone, $message, $imageUrl);
                }

                $sentCount++;
            }
        }

        return redirect()->back()->with('success', "Bulk reminder emails and WhatsApps sent to {$sentCount} users.");
    }

    public function wishlists()
    {
        $users = User::has('wishlistItems')
            ->with(['wishlistItems.product'])
            ->withCount('wishlistItems')
            ->get();

        return view('admin.engagement.wishlists', compact('users'));
    }

    public function sendWishlistReminder(User $user)
    {
        $wishlistItems = $user->wishlistItems()->with('product')->get();
        
        if ($wishlistItems->count() > 0) {
            Mail::to($user->email)->send(new WishlistReminder($user, $wishlistItems));
            
            if ($user->phone) {
                $product = $wishlistItems->first()->product;
                $imageUrl = $product && $product->cover_image ? asset('storage/' . $product->cover_image) : null;
                $wishlistUrl = route('wishlist.index');
                
                $message = "*Lexoria Diamond Studio* 💎\n\nHi {$user->name}, the items you love are waiting for you! ✨\n\nView your royal wishlist here: {$wishlistUrl}";
                
                app(WhatsAppService::class)->sendMessage($user->phone, $message, $imageUrl);
            }

            return redirect()->back()->with('success', 'Wishlist reminder sent to ' . $user->name);
        }

        return redirect()->back()->with('error', 'Wishlist is empty.');
    }

    public function whatsapp()
    {
        return view('admin.engagement.whatsapp');
    }

    public function whatsappQr(WhatsAppService $wa)
    {
        return response()->json($wa->getQrCode());
    }

    public function whatsappStatus(WhatsAppService $wa)
    {
        return response()->json($wa->getStatus());
    }

    public function sendBroadcast(Request $request, WhatsAppService $wa)
    {
        $request->validate([
            'audience' => 'required|string',
            'message' => 'required|string',
        ]);

        $usersQuery = User::whereNotNull('phone')->where('phone', '!=', '');

        if ($request->audience === 'abandoned_cart') {
            $usersQuery->has('cartItems');
        } elseif ($request->audience === 'recent_buyers') {
            $usersQuery->has('orders');
        }

        $users = $usersQuery->get();
        $sentCount = 0;

        foreach ($users as $user) {
            $message = str_replace('{name}', $user->name, $request->message);
            $wa->sendMessage($user->phone, $message);
            $sentCount++;
        }

        return redirect()->back()->with('success', "Broadcast message successfully sent to {$sentCount} customers.");
    }
}
