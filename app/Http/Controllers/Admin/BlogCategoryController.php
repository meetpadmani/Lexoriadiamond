<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\BlogCategory;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::withCount('posts')->latest()->get();
        return view('admin.blog-categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        BlogCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->back()->with('success', 'Category created successfully!');
    }

    public function update(Request $request, string $id)
    {
        $category = BlogCategory::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    public function destroy(string $id)
    {
        $category = BlogCategory::findOrFail($id);
        if ($category->posts()->count() > 0) {
            return redirect()->back()->withErrors('Cannot delete category because it has posts.');
        }
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
}
