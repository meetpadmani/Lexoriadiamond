<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SystemSetting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $group = $request->get('group', 'general');
        
        // 1. Process normal text fields
        $textFields = $request->except(['_token', 'group', 'logo', 'favicon', 'loader_img']);
        foreach ($textFields as $key => $value) {
            \App\Models\SystemSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => $group]
            );
        }

        // 2. Process file uploads only if new ones are provided
        $fileFields = ['logo', 'favicon', 'loader_img'];
        foreach ($fileFields as $field) {
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = 'uploads/settings/' . $filename;
                
                // Ensure the directory exists
                if (!file_exists(public_path('uploads/settings'))) {
                    mkdir(public_path('uploads/settings'), 0755, true);
                }
                
                $file->move(public_path('uploads/settings'), $filename);

                \App\Models\SystemSetting::updateOrCreate(
                    ['key' => $field],
                    ['value' => $path, 'group' => 'branding']
                );
            }
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
