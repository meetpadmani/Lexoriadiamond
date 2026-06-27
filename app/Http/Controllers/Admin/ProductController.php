<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Collection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('collection')->orderBy('order')->get();
        $collections = Collection::orderBy('title')->get();
        return view('admin.products.index', compact('products', 'collections'));
    }

    public function create()
    {
        $collections = Collection::orderBy('title')->get();
        return view('admin.products.form', compact('collections'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'collection_id' => 'required|exists:collections,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:100',
            'metal_type' => 'nullable|string|max:100',
            'metal_purity' => 'nullable|string|max:50',
            'weight' => 'nullable|numeric|min:0',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image2' => 'nullable|string',
            'image2_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image3' => 'nullable|string',
            'image3_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image4' => 'nullable|string',
            'image4_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image5' => 'nullable|string',
            'image5_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image6' => 'nullable|string',
            'image6_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'is_active' => 'nullable',
            'is_featured' => 'nullable',
            'order' => 'integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'schema_markup' => 'nullable|string',
            'slug' => 'nullable|string|unique:products,slug',
            'is_digital' => 'nullable',
            'product_type' => 'required|in:physical,digital,both',
            'digital_file' => 'nullable|file|max:51200', // 50MB max
        ]);

        // Handle primary image
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->move(public_path('uploads/products'), time() . '_' . $request->file('image_file')->getClientOriginalName());
            $data['image'] = 'uploads/products/' . basename($path);
        }

        if (empty($data['image'])) {
            return back()->withErrors(['image' => 'Please provide either an image URL or upload an image file.'])->withInput();
        }

        // Handle secondary images
        if ($request->hasFile('image2_file')) {
            $path = $request->file('image2_file')->move(public_path('uploads/products'), time() . '_2_' . $request->file('image2_file')->getClientOriginalName());
            $data['image2'] = 'uploads/products/' . basename($path);
        }

        if ($request->hasFile('image3_file')) {
            $path = $request->file('image3_file')->move(public_path('uploads/products'), time() . '_3_' . $request->file('image3_file')->getClientOriginalName());
            $data['image3'] = 'uploads/products/' . basename($path);
        }

        if ($request->hasFile('image4_file')) {
            $path = $request->file('image4_file')->move(public_path('uploads/products'), time() . '_4_' . $request->file('image4_file')->getClientOriginalName());
            $data['image4'] = 'uploads/products/' . basename($path);
        }

        if ($request->hasFile('image5_file')) {
            $path = $request->file('image5_file')->move(public_path('uploads/products'), time() . '_5_' . $request->file('image5_file')->getClientOriginalName());
            $data['image5'] = 'uploads/products/' . basename($path);
        }

        if ($request->hasFile('image6_file')) {
            $path = $request->file('image6_file')->move(public_path('uploads/products'), time() . '_6_' . $request->file('image6_file')->getClientOriginalName());
            $data['image6'] = 'uploads/products/' . basename($path);
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $data['is_digital'] = ($request->product_type === 'digital' || $request->product_type === 'both') ? 1 : 0;

        if ($request->hasFile('digital_file')) {
            $path = $request->file('digital_file')->store('digital_products', 'local');
            $data['digital_file_path'] = $path;
        }

        if (empty($data['slug'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
        }

        Product::create($data);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $collections = Collection::orderBy('title')->get();
        return view('admin.products.form', compact('product', 'collections'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'collection_id' => 'required|exists:collections,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'cost_price' => 'nullable|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'sku' => 'nullable|string|max:100',
            'metal_type' => 'nullable|string|max:100',
            'metal_purity' => 'nullable|string|max:50',
            'weight' => 'nullable|numeric|min:0',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image2' => 'nullable|string',
            'image2_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image3' => 'nullable|string',
            'image3_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image4' => 'nullable|string',
            'image4_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image5' => 'nullable|string',
            'image5_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'image6' => 'nullable|string',
            'image6_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'is_active' => 'nullable',
            'is_featured' => 'nullable',
            'order' => 'integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'schema_markup' => 'nullable|string',
            'slug' => 'nullable|string|unique:products,slug,' . $id,
            'is_digital' => 'nullable',
            'product_type' => 'required|in:physical,digital,both',
            'digital_file' => 'nullable|file|max:51200',
        ]);

        // Handle primary image
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->move(public_path('uploads/products'), time() . '_' . $request->file('image_file')->getClientOriginalName());
            $data['image'] = 'uploads/products/' . basename($path);
        }

        if (empty($data['image'])) {
            unset($data['image']);
        }

        // Handle secondary images
        if ($request->hasFile('image2_file')) {
            $path = $request->file('image2_file')->move(public_path('uploads/products'), time() . '_2_' . $request->file('image2_file')->getClientOriginalName());
            $data['image2'] = 'uploads/products/' . basename($path);
        }
        if (empty($data['image2'])) {
            unset($data['image2']);
        }

        if ($request->hasFile('image3_file')) {
            $path = $request->file('image3_file')->move(public_path('uploads/products'), time() . '_3_' . $request->file('image3_file')->getClientOriginalName());
            $data['image3'] = 'uploads/products/' . basename($path);
        }
        if (empty($data['image3'])) {
            unset($data['image3']);
        }

        if ($request->hasFile('image4_file')) {
            $path = $request->file('image4_file')->move(public_path('uploads/products'), time() . '_4_' . $request->file('image4_file')->getClientOriginalName());
            $data['image4'] = 'uploads/products/' . basename($path);
        }
        if (empty($data['image4'])) {
            unset($data['image4']);
        }

        if ($request->hasFile('image5_file')) {
            $path = $request->file('image5_file')->move(public_path('uploads/products'), time() . '_5_' . $request->file('image5_file')->getClientOriginalName());
            $data['image5'] = 'uploads/products/' . basename($path);
        }
        if (empty($data['image5'])) {
            unset($data['image5']);
        }

        if ($request->hasFile('image6_file')) {
            $path = $request->file('image6_file')->move(public_path('uploads/products'), time() . '_6_' . $request->file('image6_file')->getClientOriginalName());
            $data['image6'] = 'uploads/products/' . basename($path);
        }
        if (empty($data['image6'])) {
            unset($data['image6']);
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;
        $data['is_featured'] = $request->has('is_featured') ? 1 : 0;
        $data['is_digital'] = ($request->product_type === 'digital' || $request->product_type === 'both') ? 1 : 0;

        if ($request->hasFile('digital_file')) {
            $path = $request->file('digital_file')->store('digital_products', 'local');
            $data['digital_file_path'] = $path;
        }

        if (empty($data['slug'])) {
            $data['slug'] = \Illuminate\Support\Str::slug($data['name']);
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted!');
    }

    public function toggleStatus($id)
    {
        $product = Product::findOrFail($id);
        $product->is_active = !$product->is_active;
        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'Product status updated!');
    }
}
