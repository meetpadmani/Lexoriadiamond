<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function ajaxSearch(Request $request)
    {
        $query = $request->get('q');

        if (!$query) {
            return response()->json([]);
        }

        $products = Product::with('collection')
            ->where('is_active', true)
            ->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('sku', 'LIKE', '%' . $query . '%')
                    ->orWhere('metal_type', 'LIKE', '%' . $query . '%')
                    ->orWhereHas('collection', function ($c) use ($query) {
                        $c->where('title', 'LIKE', '%' . $query . '%');
                    });
            })
            ->take(6)
            ->get();

        $results = $products->map(function ($product) {
            $image = $product->image;
            if ($image && !str_starts_with($image, 'http') && !str_starts_with($image, '/')) {
                $image = asset($image);
            }
            return [
                'id' => $product->id,
                'name' => $product->name,
                'collection' => $product->collection ? $product->collection->title : 'Boutique Collection',
                'price' => number_format((float) $product->price),
                'image' => $image,
                'url' => route('collections.product', [
                    'collectionSlug' => $product->collection ? $product->collection->slug : 'all',
                    'productSlug' => $product->slug
                ]),
            ];
        });

        return response()->json($results);
    }
}
