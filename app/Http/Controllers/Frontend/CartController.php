<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = $this->getCartItems();
        return view('frontend.cart', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity ?? 1;
        $product = Product::findOrFail($productId);

        if (Auth::check()) {
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $quantity);
            } else {
                CartItem::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'quantity' => $quantity
                ]);
            }
        } else {
            // Guest session handling
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                $cart[$productId] = [
                    "id" => $productId,
                    "name" => $product->name,
                    "quantity" => $quantity,
                    "price" => $product->price,
                    "image" => $product->image
                ];
            }
            session()->put('cart', $cart);
        }

        if ($request->ajax()) {
            $cartItems = $this->getCartItems();
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart!',
                'count' => count($cartItems),
                'total' => $this->getCartTotal($cartItems),
                'cart' => $cartItems
            ]);
        }

        if ($request->has('buy_now')) {
            return redirect()->route('checkout.index');
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request)
    {
        $productId = $request->id;
        $quantity = (int) $request->quantity;

        if (Auth::check()) {
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                if ($quantity <= 0) {
                    $cartItem->delete();
                } else {
                    $cartItem->update(['quantity' => $quantity]);
                }
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                if ($quantity <= 0) {
                    unset($cart[$productId]);
                } else {
                    $cart[$productId]['quantity'] = $quantity;
                }
                session()->put('cart', $cart);
            }
        }

        if ($request->ajax()) {
            $cartItems = $this->getCartItems();
            return response()->json([
                'success' => true,
                'message' => 'Cart updated!',
                'count' => count($cartItems),
                'total' => $this->getCartTotal($cartItems),
                'cart' => $cartItems
            ]);
        }

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    public function remove(Request $request)
    {
        $productId = $request->id;

        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->delete();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                unset($cart[$productId]);
                session()->put('cart', $cart);
            }
        }

        if ($request->ajax()) {
            $cartItems = $this->getCartItems();
            return response()->json([
                'success' => true,
                'message' => 'Product removed!',
                'count' => count($cartItems),
                'total' => $this->getCartTotal($cartItems),
                'cart' => $cartItems
            ]);
        }

        return redirect()->back()->with('success', 'Product removed successfully!');
    }

    private function getCartItems()
    {
        if (Auth::check()) {
            $items = CartItem::with('product')->where('user_id', Auth::id())->get();
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

    private function getCartTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
