<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('category')
            ->where('is_published', true)
            ->latest()
            ->paginate(9);
            
        $categories = BlogCategory::where('is_active', true)->get();
        
        return view('frontend.blog.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        $post = BlogPost::with(['category', 'tags'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();
            
        $relatedPosts = BlogPost::where('blog_category_id', $post->blog_category_id)
            ->where('id', '!=', $post->id)
            ->limit(3)
            ->get();
            
        return view('frontend.blog.show', compact('post', 'relatedPosts'));
    }

    public function category(BlogCategory $category)
    {
        $posts = $category->posts()
            ->where('is_published', true)
            ->latest()
            ->paginate(9);
            
        return view('frontend.blog.index', compact('posts', 'category'));
    }
}
