<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $hero = \App\Models\Hero::where('is_active', true)->first();
        $collections = \App\Models\Collection::orderBy('order')->limit(6)->get();
        $collectionsWithFeatured = \App\Models\Collection::with(['products' => function($q) { 
            $q->where('is_active', true)->orderBy('order')->limit(6); 
        }])->orderBy('order')->get();
        
        $brandStory = \App\Models\BrandStory::first();
        $videoProducts = \App\Models\VideoProduct::where('is_active', true)->orderBy('order')->get();
        $posters = \App\Models\Poster::where('status', true)->get();
        $brands = \App\Models\Brand::where('is_active', true)->orderBy('order')->get();
        $featuredProducts = \App\Models\Product::with('collection')->where('is_active', true)->where('is_featured', true)->limit(8)->get();

        return view('welcome', compact('hero', 'collections', 'collectionsWithFeatured', 'brandStory', 'videoProducts', 'posters', 'brands', 'featuredProducts'));
    }

    public function diamondShapes()
    {
        return view('frontend.informational.diamond-shapes');
    }

    public function diamondEducation()
    {
        return view('frontend.informational.diamond-education');
    }

    public function investment()
    {
        return view('frontend.informational.investment-masterpieces');
    }

    // ===== CUSTOMER CARE =====
    public function helpFaqs()
    {
        return view('frontend.pages.help-faqs');
    }

    public function trackOrder()
    {
        return view('frontend.pages.track-order');
    }

    public function viewOrder($order_number)
    {
        $order = \App\Models\Order::with('items.product')->where('order_number', $order_number)->firstOrFail();
        return view('frontend.order-detail', compact('order'));
    }

    public function returnPolicy()
    {
        return view('frontend.pages.return-policy');
    }

    public function jewellleryCare()
    {
        return view('frontend.pages.jewellery-care');
    }

    public function storeLocator()
    {
        return view('frontend.pages.store-locator');
    }

    // ===== ABOUT BHAUMIK =====
    public function about()
    {
        return view('frontend.pages.about');
    }

    public function ourStory()
    {
        return view('frontend.pages.our-story');
    }

    public function heritage()
    {
        return view('frontend.pages.heritage');
    }

    public function craftsmanship()
    {
        return view('frontend.pages.craftsmanship');
    }

    public function ethicalDiamonds()
    {
        return view('frontend.pages.ethical-diamonds');
    }

    public function contactUs()
    {
        return view('frontend.pages.contact-us');
    }

    // ===== POLICIES =====
    public function privacyPolicy()
    {
        return view('frontend.pages.privacy-policy');
    }

    public function termsConditions()
    {
        return view('frontend.pages.terms-conditions');
    }

    public function shippingPolicy()
    {
        return view('frontend.pages.shipping-policy');
    }

    public function exchangeBuyback()
    {
        return view('frontend.pages.exchange-buyback');
    }

    public function cookiePolicy()
    {
        return view('frontend.pages.cookie-policy');
    }

    public function videoProductDetail($slug)
    {
        $product = \App\Models\VideoProduct::where('slug', $slug)->where('is_active', true)->firstOrFail();
        
        $relatedProducts = \App\Models\Product::where('is_active', true)->limit(4)->get();
        
        return view('frontend.video-product-detail', compact('product', 'relatedProducts'));
    }

    public function customized()
    {
        return view('frontend.pages.customized');
    }
}
