<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PosterController extends Controller
{
    public function index()
    {
        $posters = \App\Models\Poster::orderBy('sort_order')->get();
        return view('admin.posters.index', compact('posters'));
    }

    public function reorder(Request $request)
    {
        foreach ($request->order as $item) {
            \App\Models\Poster::where('id', $item['id'])->update(['sort_order' => $item['position']]);
        }
        return response()->json(['status' => 'success']);
    }

    public function create()
    {
        return view('admin.posters.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'mobile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'status' => 'boolean'
        ]);

        $data = $request->except(['image', 'mobile_image']);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/posters'), $imageName);
            $data['image'] = 'uploads/posters/' . $imageName;
        }

        if ($request->hasFile('mobile_image')) {
            $mobileImageName = time() . '_mobile.' . $request->mobile_image->extension();
            $request->mobile_image->move(public_path('uploads/posters'), $mobileImageName);
            $data['mobile_image'] = 'uploads/posters/' . $mobileImageName;
        }

        \App\Models\Poster::create($data);

        return redirect()->route('admin.posters.index')->with('success', 'Poster created successfully.');
    }

    public function edit(\App\Models\Poster $poster)
    {
        return view('admin.posters.edit', compact('poster'));
    }

    public function update(Request $request, \App\Models\Poster $poster)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'mobile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'title' => 'nullable|string|max:255',
            'link' => 'nullable|string|max:255',
            'status' => 'boolean'
        ]);

        $data = $request->except(['image', 'mobile_image']);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/posters'), $imageName);
            $data['image'] = 'uploads/posters/' . $imageName;

            // Delete old image if exists
            if ($poster->image && file_exists(public_path($poster->image))) {
                unlink(public_path($poster->image));
            }
        }

        if ($request->hasFile('mobile_image')) {
            $mobileImageName = time() . '_mobile.' . $request->mobile_image->extension();
            $request->mobile_image->move(public_path('uploads/posters'), $mobileImageName);
            $data['mobile_image'] = 'uploads/posters/' . $mobileImageName;

            // Delete old mobile image if exists
            if ($poster->mobile_image && file_exists(public_path($poster->mobile_image))) {
                unlink(public_path($poster->mobile_image));
            }
        }

        $poster->update($data);

        return redirect()->route('admin.posters.index')->with('success', 'Poster updated successfully.');
    }

    public function destroy(\App\Models\Poster $poster)
    {
        if ($poster->image && file_exists(public_path($poster->image))) {
            unlink(public_path($poster->image));
        }
        if ($poster->mobile_image && file_exists(public_path($poster->mobile_image))) {
            unlink(public_path($poster->mobile_image));
        }
        $poster->delete();
        return redirect()->route('admin.posters.index')->with('success', 'Poster deleted successfully.');
    }
}
