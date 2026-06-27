<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomOrder;
use App\Services\WhatsAppService;

class CustomOrderController extends Controller
{
    public function submit(Request $request, WhatsAppService $waService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'description' => 'required|string',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:5120', // 5MB max per image
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('custom_orders', 'public');
            }
        }

        $customOrder = CustomOrder::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'description' => $request->description,
            'images' => $imagePaths,
            'status' => 'pending',
        ]);

        // Send WhatsApp notification to Admin
        $adminPhone = '8488046732';
        
        $message = "*New Custom Jewelry Design Request!*\n\n";
        $message .= "Name: " . $customOrder->name . "\n";
        $message .= "Phone: " . $customOrder->phone . "\n";
        $message .= "Email: " . $customOrder->email . "\n";
        $message .= "Description: " . $customOrder->description . "\n";
        $message .= "\nPlease review this request in the admin panel.";

        // Send first image with the text message
        if (count($imagePaths) > 0) {
            $firstImageUrl = asset('storage/' . $imagePaths[0]);
            $waService->sendMessage($adminPhone, $message, $firstImageUrl);
            
            // Send subsequent images without text
            for ($i = 1; $i < count($imagePaths); $i++) {
                $subsequentImageUrl = asset('storage/' . $imagePaths[$i]);
                $waService->sendMessage($adminPhone, "", $subsequentImageUrl);
            }
        } else {
            $waService->sendMessage($adminPhone, $message);
        }

        return back()->with('success', 'Your custom design request has been submitted successfully! We will contact you soon.');
    }
}
