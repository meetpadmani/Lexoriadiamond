<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    public function setLocale($locale)
    {
        if (in_array($locale, ['en', 'hi', 'gu'])) {
            session()->put('locale', $locale);
        }
        return redirect()->back();
    }
}
