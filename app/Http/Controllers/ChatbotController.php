<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotKnowledge;

class ChatbotController extends Controller
{
    public function getResponse(Request $request)
    {
        $query = strtolower($request->input('query'));
        $knowledge = ChatbotKnowledge::where('is_active', true)->get();

        foreach ($knowledge as $item) {
            $keywords = explode(',', strtolower($item->keywords));
            foreach ($keywords as $keyword) {
                $keyword = trim($keyword);
                if (!empty($keyword) && str_contains($query, $keyword)) {
                    $item->increment('hits');
                    return response()->json([
                        'success' => true,
                        'answer' => $item->answer,
                        'category' => $item->category
                    ]);
                }
            }
        }

        // Fallback to basic hardcoded logic or default response
        return response()->json([
            'success' => false,
            'answer' => "That is an intriguing query! While I am still learning every detail of our vast heritage, I can certainly connect you with one of our human master jewelers for a personal consultation. Would you like our contact details?"
        ]);
    }
}
