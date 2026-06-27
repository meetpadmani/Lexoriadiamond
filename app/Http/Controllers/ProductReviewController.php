<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return back()->with('error', 'Please login to share your feedback on our royal masterpieces.');
        }

        $hasPurchased = \App\Models\Order::where('user_id', Auth::id())
            ->whereHas('items', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })
            ->where('status', '!=', 'cancelled')
            ->exists();

        if (!$hasPurchased) {
            return back()->with('error', 'Only patrons who have acquired this masterpiece can share their appraisal.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        ProductReview::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => 'pending', // Requires admin approval
        ]);

        return back()->with('success', 'Your feedback has been submitted for royal appraisal. It will be visible after moderation.');
    }
}
