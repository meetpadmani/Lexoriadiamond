<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Collection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('collection')->where('is_active', true);

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

        return view('frontend.products', compact('products'));
    }
}
