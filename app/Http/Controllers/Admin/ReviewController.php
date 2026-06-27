<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = ProductReview::with(['user', 'product'])->orderBy('created_at', 'desc')->paginate(20);
        $products = \App\Models\Product::orderBy('name')->get();
        $users = \App\Models\User::orderBy('name')->get();
        return view('admin.reviews.index', compact('reviews', 'products', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'user_id' => 'required|exists:users,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
            'status' => 'required|in:approved,rejected,pending',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = 'storage/' . $request->file('image')->store('reviews', 'public');
        }

        ProductReview::create([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'status' => $request->status,
            'image' => $imagePath,
        ]);

        return back()->with('success', 'Manual review added successfully.');
    }

    public function updateStatus(Request $request, ProductReview $review)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected,pending',
        ]);

        $review->status = $request->status;
        $review->save();

        return back()->with('success', "Review status updated to {$request->status}.");
    }

    public function destroy(ProductReview $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted successfully.');
    }
}
