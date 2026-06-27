<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index()
    {
        $hero = \App\Models\Hero::firstOrCreate(
            ['id' => 1],
            [
                'title' => 'Bhaumik Diamond',
                'subtitle' => 'A Legacy of Brilliance',
                'video_url' => 'videos/hero.mp4',
                'button_1_text' => 'View Collection',
                'button_1_link' => '/collections',
                'button_2_text' => 'Our Story',
                'button_2_link' => '#story'
            ]
        );
        return view('admin.hero.index', compact('hero'));
    }

    public function update(\Illuminate\Http\Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string',
            'video_url' => 'nullable|string',
            'video_file' => 'nullable|file|mimes:mp4,mov,ogg,webm|max:102400',
            'chunked_video_path' => 'nullable|string',
            'button_1_text' => 'required|string|max:50',
            'button_1_link' => 'required|string|max:255',
            'button_2_text' => 'required|string|max:50',
            'button_2_link' => 'required|string|max:255',
        ]);

        $data['is_active'] = $request->has('is_active');

        if ($request->chunked_video_path) {
            $data['video_url'] = $request->chunked_video_path;
        } elseif ($request->hasFile('video_file')) {
            $file = $request->file('video_file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/videos'), $filename);
            $data['video_url'] = 'uploads/videos/' . $filename;
        }

        unset($data['video_file']);
        unset($data['chunked_video_path']);

        \App\Models\Hero::updateOrCreate(['id' => 1], $data);

        return redirect()->back()->with('success', 'Hero section updated successfully!');
    }
}
