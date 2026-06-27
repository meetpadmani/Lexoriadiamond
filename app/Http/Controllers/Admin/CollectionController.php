<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index()
    {
        $collections = \App\Models\Collection::withCount('products')->orderBy('order')->get();
        return view('admin.collections.index', compact('collections'));
    }

    public function create()
    {
        return view('admin.collections.form');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:51200',
            'type' => 'required|in:tall,half',
            'overlay_position' => 'required|string',
            'order' => 'integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'schema_markup' => 'nullable|string',
            'slug' => 'nullable|string|unique:collections,slug',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->move(public_path('uploads/collections'), time() . '_' . $request->file('image_file')->getClientOriginalName());
            $data['image'] = 'uploads/collections/' . basename($path);
        }

        if (empty($data['image'])) {
            return back()->withErrors(['image' => 'Please provide either an image URL or upload an image file.'])->withInput();
        }

        \App\Models\Collection::create($data);

        return redirect()->route('admin.collections.index')->with('success', 'Collection item added!');
    }

    public function edit($id)
    {
        $collection = \App\Models\Collection::findOrFail($id);
        return view('admin.collections.form', compact('collection'));
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $collection = \App\Models\Collection::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:51200',
            'type' => 'required|in:tall,half',
            'overlay_position' => 'required|string',
            'order' => 'integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'schema_markup' => 'nullable|string',
            'slug' => 'nullable|string|unique:collections,slug,' . $id,
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->move(public_path('uploads/collections'), time() . '_' . $request->file('image_file')->getClientOriginalName());
            $data['image'] = 'uploads/collections/' . basename($path);
        }

        // Prevent overwriting existing image with null if no new image is provided
        if (empty($data['image'])) {
            unset($data['image']);
        }

        $collection->update($data);

        return redirect()->route('admin.collections.index')->with('success', 'Collection updated!');
    }

    public function destroy($id)
    {
        $collection = \App\Models\Collection::findOrFail($id);
        $collection->delete();
        return redirect()->route('admin.collections.index')->with('success', 'Item deleted!');
    }
}
