<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandStoryController extends Controller
{
    public function index()
    {
        $story = \App\Models\BrandStory::firstOrCreate(
            ['id' => 1],
            [
                'subtitle' => 'Our Heritage',
                'title' => 'The Bhaumik Legacy',
                'content' => 'Crafting brilliance since generations...',
                'image' => 'https://images.unsplash.com/photo-1573408301185-9146fe634ad0',
                'stat_1_num' => '25+',
                'stat_1_label' => 'Years of Trust',
                'stat_2_num' => '10k+',
                'stat_2_label' => 'Certified Masterpieces',
                'button_text' => 'Read Full Story',
                'button_link' => '#story'
            ]
        );
        $collections = \App\Models\Collection::orderBy('title')->get();
        return view('admin.brand-story.index', compact('story', 'collections'));
    }

    public function update(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'subtitle' => 'required|string',
            'title' => 'required|string',
            'content' => 'required|string',
            'image' => 'nullable|string',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'stat_1_num' => 'required|string',
            'stat_1_label' => 'required|string',
            'stat_2_num' => 'required|string',
            'stat_2_label' => 'required|string',
            'button_text' => 'required|string',
            'button_link' => 'required|string',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->move(public_path('uploads/brand'), time() . '_' . $request->file('image_file')->getClientOriginalName());
            $data['image'] = 'uploads/brand/' . basename($path);
        }

        unset($data['image_file']);

        \App\Models\BrandStory::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', 'Brand Story updated!');
    }
}
