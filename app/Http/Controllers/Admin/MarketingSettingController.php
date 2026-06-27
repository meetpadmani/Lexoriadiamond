<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MarketingSetting;
use Illuminate\Http\Request;

class MarketingSettingController extends Controller
{
    public function index()
    {
        $settings = MarketingSetting::first();
        
        if (!$settings) {
            $settings = new MarketingSetting();
        }

        return view('admin.marketing.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'meta_pixel_id' => 'nullable|string',
            'meta_access_token' => 'nullable|string',
            'google_ads_id' => 'nullable|string',
            'google_ads_script' => 'nullable|string',
        ]);

        MarketingSetting::updateOrCreate(
            ['id' => 1],
            [
                'meta_pixel_id' => $validated['meta_pixel_id'] ?? null,
                'meta_access_token' => $validated['meta_access_token'] ?? null,
                'google_ads_id' => $validated['google_ads_id'] ?? null,
                'google_ads_script' => $validated['google_ads_script'] ?? null,
                'meta_event_page_view' => $request->has('meta_event_page_view'),
                'meta_event_view_content' => $request->has('meta_event_view_content'),
                'meta_event_add_to_cart' => $request->has('meta_event_add_to_cart'),
                'meta_event_initiate_checkout' => $request->has('meta_event_initiate_checkout'),
                'meta_event_purchase' => $request->has('meta_event_purchase'),
            ]
        );

        return redirect()->back()->with('success', 'Marketing integrations updated successfully!');
    }
}
