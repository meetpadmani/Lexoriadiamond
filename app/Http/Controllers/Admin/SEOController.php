<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Collection;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class SEOController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'missing_product_seo' => Product::whereNull('meta_description')->count(),
            'total_collections' => Collection::count(),
            'missing_collection_seo' => Collection::whereNull('meta_description')->count(),
            'total_posts' => BlogPost::count(),
            'missing_post_seo' => BlogPost::whereNull('meta_description')->count(),
        ];

        return view('admin.seo.index', compact('stats'));
    }
}
