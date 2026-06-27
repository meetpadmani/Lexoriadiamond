<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Collection;
use App\Models\BlogPost;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->get();
        $collections = Collection::all();
        $posts = BlogPost::where('is_published', true)->get();

        return response()->view('frontend.sitemap', [
            'products' => $products,
            'collections' => $collections,
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');
    }
}
