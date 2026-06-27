<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\CompetitorScrapeJob;
use Illuminate\Http\Request;

class CompetitorScrapeController extends Controller
{
    public function scrapeAll()
    {
        // Dispatch the background job to scrape all competitors
        CompetitorScrapeJob::dispatch();

        return response()->json([
            'success' => true,
            'message' => 'સ્ક્રૅપિંગ પ્રક્રિયા પૃષ્ઠભૂમિમાં શરૂ કરવામાં આવી છે.'
        ]);
    }
}
