<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::with('category')->latest()->paginate(10);
        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        $categories = BlogCategory::where('is_active', true)->get();
        $tags = BlogTag::all();
        return view('admin.blog.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'content' => 'required',
            'featured_image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('blogs', 'public');
            $data['featured_image'] = 'storage/' . $imagePath;
        }

        $post = BlogPost::create($data);
        
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.blog-posts.index')->with('success', 'Post created successfully.');
    }

    public function edit(BlogPost $blogPost)
    {
        $categories = BlogCategory::where('is_active', true)->get();
        $tags = BlogTag::all();
        return view('admin.blog.edit', compact('blogPost', 'categories', 'tags'));
    }

    public function update(Request $request, BlogPost $blogPost)
    {
        $request->validate([
            'title' => 'required|max:255',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'content' => 'required',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['is_published'] = $request->has('is_published');

        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($blogPost->featured_image) {
                // Handle path carefully
            }
            $imagePath = $request->file('featured_image')->store('blogs', 'public');
            $data['featured_image'] = 'storage/' . $imagePath;
        }

        $blogPost->update($data);
        
        if ($request->has('tags')) {
            $blogPost->tags()->sync($request->tags);
        }

        return redirect()->route('admin.blog-posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(BlogPost $blogPost)
    {
        $blogPost->delete();
        return redirect()->route('admin.blog-posts.index')->with('success', 'Post deleted successfully.');
    }
}
