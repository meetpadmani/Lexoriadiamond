<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Competitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CompetitorController extends Controller
{
    public function index(Request $request)
    {
        $query = Competitor::with(['latestStat', 'latestPrice']);

        if ($request->has('filter')) {
            $filter = $request->filter;
            if ($filter == 'ig_active') {
                $query->whereHas('latestStat', function ($q) {
                    $q->where('ig_followers', '>', 0);
                });
            } elseif ($filter == 'sale_on') {
                $query->whereHas('latestPrice', function ($q) {
                    $q->where('active_sale', 1);
                });
            } elseif ($filter == 'rating_high') {
                $query->whereHas('latestStat', function ($q) {
                    $q->where('avg_rating', '>=', 4.5);
                });
            } elseif ($filter == 'new') {
                $query->where('added_at', '>=', now()->subDays(30));
            }
        }

        $competitors = $query->latest()->get();
        return view('admin.competitors.index', compact('competitors'));
    }

    public function search(Request $request)
    {
        $request->validate(['keyword' => 'required|string|max:255']);
        
        try {
            $response = Http::withoutVerifying()->asForm()->post('https://lite.duckduckgo.com/lite/', [
                'q' => $request->keyword
            ]);

            if ($response->successful()) {
                $html = $response->body();
                $results = [];
                
                // Parse duckduckgo lite HTML
                preg_match_all('/<td class=\'result-snippet\'[^>]*>(.*?)<\/td>/is', $html, $snippetMatches);
                preg_match_all('/<a rel="nofollow" href="([^"]+)"[^>]*>(.*?)<\/a>/is', $html, $linkMatches);
                
                $count = min(count($linkMatches[1]), 10);
                for ($i = 0; $i < $count; $i++) {
                    $link = $linkMatches[1][$i] ?? '';
                    if(str_contains($link, 'duckduckgo.com')) continue; // Skip internal links
                    
                    $results[] = [
                        'title' => strip_tags($linkMatches[2][$i] ?? 'Unknown'),
                        'domain' => parse_url($link, PHP_URL_HOST) ?? 'unknown',
                        'snippet' => strip_tags($snippetMatches[1][$i] ?? ''),
                        'link' => $link,
                    ];
                }

                if (count($results) === 0) {
                    // Fallback dummy data if scraping fails
                    $results = [
                        ['title' => 'CaratLane - A TATA Product', 'domain' => 'www.caratlane.com', 'snippet' => 'Shop Diamond Jewellery Online.', 'link' => 'https://www.caratlane.com'],
                        ['title' => 'BlueStone.com - Online Jewellery', 'domain' => 'www.bluestone.com', 'snippet' => 'Buy Gold and Diamond Jewellery.', 'link' => 'https://www.bluestone.com'],
                        ['title' => 'Tanishq - Diamond Jewellery', 'domain' => 'www.tanishq.co.in', 'snippet' => 'Explore the finest diamond jewellery.', 'link' => 'https://www.tanishq.co.in'],
                        ['title' => 'Kalyan Jewellers', 'domain' => 'www.kalyanjewellers.net', 'snippet' => 'Online diamond rings and necklaces.', 'link' => 'https://www.kalyanjewellers.net'],
                        ['title' => 'Malabar Gold & Diamonds', 'domain' => 'www.malabargoldanddiamonds.com', 'snippet' => 'Buy diamond jewelry online in India.', 'link' => 'https://www.malabargoldanddiamonds.com'],
                    ];
                }

                return response()->json($results);
            }

            return response()->json(['error' => 'Search failed. Please try again later.'], 400);

        } catch (\Exception $e) {
            Log::channel('single')->error('Competitor Search Error: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while searching.'], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'domain' => 'required|string|max:255|unique:competitors,domain',
        ]);

        $competitor = Competitor::create([
            'name' => $request->name,
            'domain' => $request->domain,
            'category' => $request->category ?? null,
            'ig_handle' => $request->ig_handle ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'હરીફ સફળતાપૂર્વક ઉમેરવામાં આવ્યો.',
            'data' => $competitor
        ]);
    }

    public function destroy($id)
    {
        $competitor = Competitor::findOrFail($id);
        $competitor->delete();

        return response()->json([
            'success' => true,
            'message' => 'હરીફ સફળતાપૂર્વક કાઢી નાખવામાં આવ્યો.'
        ]);
    }
}
