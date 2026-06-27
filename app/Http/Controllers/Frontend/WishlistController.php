<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\WishlistItem;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = $this->getWishlistItems();
        return view('frontend.wishlist', compact('wishlistItems'));
    }

    public function add(Request $request)
    {
        $productId = $request->product_id;
        $product = Product::findOrFail($productId);

        if (Auth::check()) {
            WishlistItem::updateOrCreate([
                'user_id' => Auth::id(),
                'product_id' => $productId
            ]);
        } else {
            $wishlist = session()->get('wishlist', []);
            if (!isset($wishlist[$productId])) {
                $wishlist[$productId] = [
                    "id" => $productId,
                    "name" => $product->name,
                    "price" => $product->price,
                    "image" => $product->image
                ];
                session()->put('wishlist', $wishlist);
            }
        }

        if ($request->ajax()) {
            $items = $this->getWishlistItems();
            return response()->json([
                'success' => true,
                'message' => 'Added to wishlist!',
                'count' => count($items)
            ]);
        }

        return redirect()->back()->with('success', 'Product added to wishlist successfully!');
    }

    public function remove(Request $request)
    {
        $productId = $request->id;

        if (Auth::check()) {
            WishlistItem::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->delete();
        } else {
            $wishlist = session()->get('wishlist', []);
            if (isset($wishlist[$productId])) {
                unset($wishlist[$productId]);
                session()->put('wishlist', $wishlist);
            }
        }

        if ($request->ajax()) {
            $items = $this->getWishlistItems();
            return response()->json([
                'success' => true,
                'message' => 'Removed from wishlist!',
                'count' => count($items)
            ]);
        }

        return redirect()->back()->with('success', 'Product removed from wishlist!');
    }

    private function getWishlistItems()
    {
        if (Auth::check()) {
            $items = WishlistItem::with('product')->where('user_id', Auth::id())->get();
            $wishlist = [];
            foreach ($items as $item) {
                $wishlist[$item->product_id] = [
                    "id" => $item->product_id,
                    "name" => $item->product->name,
                    "price" => $item->product->price,
                    "image" => $item->product->image
                ];
            }
            return $wishlist;
        }

        return session()->get('wishlist', []);
    }
}
