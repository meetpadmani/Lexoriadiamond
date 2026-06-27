<?php

namespace App\Http\Controllers;

use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryImageController extends Controller
{
    public function index()
    {
        $galleryImages = GalleryImage::orderBy('order')->get();
        return view('admin.gallery-images.index', compact('galleryImages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_file' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'order' => 'nullable|integer'
        ]);

        $data = [
            'is_active' => $request->has('is_active') ? true : false,
            'order' => $request->order ?? 0
        ];

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->move(public_path('uploads/gallery'), time() . '_' . $request->file('image_file')->getClientOriginalName());
            $data['image_path'] = 'uploads/gallery/' . basename($path);
        }

        GalleryImage::create($data);

        return redirect()->back()->with('success', 'Image added successfully!');
    }

    public function destroy(GalleryImage $galleryImage)
    {
        if ($galleryImage->image_path && file_exists(public_path($galleryImage->image_path))) {
            unlink(public_path($galleryImage->image_path));
        }
        $galleryImage->delete();

        return redirect()->back()->with('success', 'Image deleted successfully!');
    }
}
