<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = Collection::withCount('products')->orderBy('order')->get();
        return view('frontend.collections', compact('collections'));
    }

    public function show(Request $request, $slug)
    {
        $collection = Collection::where('slug', $slug)->firstOrFail();
        
        $query = $collection->activeProducts();

        // Filter by Price Range
        if ($request->has('price_range')) {
            $range = explode('-', $request->price_range);
            if (count($range) == 2) {
                $query->whereBetween('price', [$range[0], $range[1]]);
            } elseif ($request->price_range == '500000+') {
                $query->where('price', '>=', 500000);
            }
        }

        // Filter by Weight Range
        if ($request->has('weight_range')) {
            $range = explode('-', $request->weight_range);
            if (count($range) == 2) {
                $query->whereBetween('weight', [$range[0], $range[1]]);
            } elseif ($request->weight_range == '50+') {
                $query->where('weight', '>=', 50);
            }
        }

        // Filter by Metal Type
        if ($request->filled('metal')) {
            $query->where('metal_type', $request->metal);
        }

        // Filter by Metal Purity
        if ($request->filled('purity')) {
            $query->where('metal_purity', $request->purity);
        }

        // Filter by Availability (Stock)
        if ($request->filled('availability')) {
            if ($request->availability == 'in_stock') {
                $query->where('is_active', true); // Assuming active means in stock for now
            }
        }

        // Filter by Offers/Sale
        if ($request->filled('premium')) {
            if ($request->premium == 'on_sale') {
                $query->whereNotNull('original_price')->whereColumn('price', '<', 'original_price');
            } elseif ($request->premium == 'featured') {
                $query->where('is_featured', true);
            }
        }

        // Sorting
        $sort = $request->get('sort', 'default');
        switch($sort) {
            case 'price_low': $query->orderBy('price', 'asc'); break;
            case 'price_high': $query->orderBy('price', 'desc'); break;
            case 'newest': $query->latest(); break;
            default: $query->orderBy('order');
        }

        $products = $query->paginate(12)->withQueryString();

        $otherCollections = Collection::where('id', '!=', $collection->id)
            ->withCount('products')
            ->orderBy('order')
            ->limit(4)
            ->get();

        return view('frontend.collection-detail', compact('collection', 'products', 'otherCollections'));
    }

    public function productDetail($collectionSlug, $productSlug)
    {
        $collection = Collection::where('slug', $collectionSlug)->firstOrFail();
        $product = Product::where('slug', $productSlug)
            ->where('collection_id', $collection->id)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedProducts = Product::where('collection_id', $collection->id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->orderBy('order')
            ->limit(4)
            ->get();

        $reviews = $product->reviews()->where('status', 'approved')->with('user')->latest()->get();

        $hasPurchased = false;
        if (auth()->check()) {
            $hasPurchased = \App\Models\Order::where('user_id', auth()->id())
                ->whereHas('items', function ($query) use ($product) {
                    $query->where('product_id', $product->id);
                })
                ->where('status', '!=', 'cancelled')
                ->exists();
        }

        return view('frontend.product-detail', compact('collection', 'product', 'relatedProducts', 'reviews', 'hasPurchased'));
    }
}
