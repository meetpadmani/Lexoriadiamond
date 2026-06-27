<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VideoProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoProductController extends Controller
{
    public function index()
    {
        $videoProducts = VideoProduct::orderBy('order')->get();
        return view('admin.video-products.index', compact('videoProducts'));
    }

    public function create()
    {
        return view('admin.video-products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'video' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:102400',
            'chunked_video_path' => 'nullable|string',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'image2' => 'nullable|image|max:5120',
            'image3' => 'nullable|image|max:5120',
            'image4' => 'nullable|image|max:5120',
            'image5' => 'nullable|image|max:5120',
            'image6' => 'nullable|image|max:5120',
            'product_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'current_price' => 'nullable|numeric',
            'original_price' => 'nullable|numeric',
            'metal_type' => 'nullable|string',
            'metal_purity' => 'nullable|string',
            'weight' => 'nullable|string',
            'sku' => 'nullable|string',
            'views' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        if (!$request->chunked_video_path && !$request->hasFile('video')) {
            return redirect()->back()->withErrors(['video' => 'The video field is required.'])->withInput();
        }

        $videoPath = $request->chunked_video_path ?: ($request->hasFile('video') ? $request->file('video')->store('videos', 'public') : null);
        
        $data = [
            'video_path' => $videoPath,
            'product_name' => $request->product_name,
            'description' => $request->description,
            'current_price' => $request->current_price,
            'original_price' => $request->original_price,
            'metal_type' => $request->metal_type,
            'metal_purity' => $request->metal_purity,
            'weight' => $request->weight,
            'sku' => $request->sku,
            'views' => $request->views ?? '0',
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active'),
        ];

        foreach (['product_image', 'image2', 'image3', 'image4', 'image5', 'image6'] as $imgField) {
            if ($request->hasFile($imgField)) {
                $data[$imgField] = $request->file($imgField)->store('products', 'public');
            }
        }

        VideoProduct::create($data);

        return redirect()->route('admin.video-products.index')->with('success', 'Video product created successfully.');
    }

    public function edit(VideoProduct $videoProduct)
    {
        return view('admin.video-products.edit', compact('videoProduct'));
    }

    public function update(Request $request, VideoProduct $videoProduct)
    {
        $request->validate([
            'video' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:102400',
            'chunked_video_path' => 'nullable|string',
            'product_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'image2' => 'nullable|image|max:5120',
            'image3' => 'nullable|image|max:5120',
            'image4' => 'nullable|image|max:5120',
            'image5' => 'nullable|image|max:5120',
            'image6' => 'nullable|image|max:5120',
            'product_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'current_price' => 'nullable|numeric',
            'original_price' => 'nullable|numeric',
            'metal_type' => 'nullable|string',
            'metal_purity' => 'nullable|string',
            'weight' => 'nullable|string',
            'sku' => 'nullable|string',
            'views' => 'nullable|string|max:50',
            'order' => 'nullable|integer',
        ]);

        if ($request->chunked_video_path) {
            if ($videoProduct->video_path) Storage::disk('public')->delete($videoProduct->video_path);
            $videoProduct->video_path = $request->chunked_video_path;
        } elseif ($request->hasFile('video')) {
            if ($videoProduct->video_path) Storage::disk('public')->delete($videoProduct->video_path);
            $videoProduct->video_path = $request->file('video')->store('videos', 'public');
        }

        foreach (['product_image', 'image2', 'image3', 'image4', 'image5', 'image6'] as $imgField) {
            if ($request->hasFile($imgField)) {
                if ($videoProduct->$imgField) Storage::disk('public')->delete($videoProduct->$imgField);
                $videoProduct->$imgField = $request->file($imgField)->store('products', 'public');
            }
        }

        $videoProduct->product_name = $request->product_name;
        $videoProduct->description = $request->description;
        $videoProduct->current_price = $request->current_price;
        $videoProduct->original_price = $request->original_price;
        $videoProduct->metal_type = $request->metal_type;
        $videoProduct->metal_purity = $request->metal_purity;
        $videoProduct->weight = $request->weight;
        $videoProduct->sku = $request->sku;
        $videoProduct->views = $request->views ?? '0';
        $videoProduct->order = $request->order ?? 0;
        $videoProduct->is_active = $request->has('is_active');
        $videoProduct->save();

        return redirect()->route('admin.video-products.index')->with('success', 'Video product updated successfully.');
    }


    public function destroy(VideoProduct $videoProduct)
    {
        if ($videoProduct->video_path) {
            Storage::disk('public')->delete($videoProduct->video_path);
        }
        if ($videoProduct->product_image) {
            Storage::disk('public')->delete($videoProduct->product_image);
        }
        $videoProduct->delete();

        return redirect()->route('admin.video-products.index')->with('success', 'Video product deleted successfully.');
    }

    public function toggleStatus(VideoProduct $videoProduct)
    {
        $videoProduct->is_active = !$videoProduct->is_active;
        $videoProduct->save();

        return redirect()->back()->with('success', 'Visibility updated.');
    }
}
