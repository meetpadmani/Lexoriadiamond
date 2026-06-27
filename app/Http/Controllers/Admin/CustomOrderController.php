<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomOrder;

class CustomOrderController extends Controller
{
    public function index()
    {
        $customOrders = CustomOrder::orderBy('created_at', 'desc')->paginate(15);
        
        $customOrderStats = [
            'total' => CustomOrder::count(),
            'pending' => CustomOrder::where('status', 'pending')->count(),
            'reviewed' => CustomOrder::where('status', 'reviewed')->count(),
            'accepted' => CustomOrder::where('status', 'accepted')->count(),
            'completed' => CustomOrder::where('status', 'completed')->count(),
            'rejected' => CustomOrder::where('status', 'rejected')->count(),
        ];

        return view('admin.custom_orders.index', compact('customOrders', 'customOrderStats'));
    }

    public function show($id)
    {
        $customOrder = CustomOrder::findOrFail($id);
        return view('admin.custom_orders.show', compact('customOrder'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,reviewed,accepted,rejected,completed'
        ]);

        $customOrder = CustomOrder::findOrFail($id);
        $customOrder->status = $request->status;
        $customOrder->save();

        return back()->with('success', 'Custom order status updated successfully.');
    }

    public function destroy($id)
    {
        $customOrder = CustomOrder::findOrFail($id);
        
        // Optionally delete the image files
        if (is_array($customOrder->images)) {
            foreach ($customOrder->images as $imagePath) {
                if (\Illuminate\Support\Facades\Storage::disk('public')->exists($imagePath)) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($imagePath);
                }
            }
        }
        
        $customOrder->delete();

        return back()->with('success', 'Custom inquiry deleted successfully.');
    }
}
