@extends('admin.layout')

@section('title', 'Search Visibility DNA')

@section('styles')
<style>
    /* Premium Page Header */
    .premium-page-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 20px;
        padding: 2.5rem 2rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.02);
        margin-bottom: 2rem;
        border: 1px solid rgba(0,0,0,0.03);
    }

    /* Premium Buttons */
    .btn-premium {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        color: #fff;
        padding: 14px 28px;
        border-radius: 30px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(13, 110, 253, 0.4);
        background: linear-gradient(135deg, #0b5ed7 0%, #094eb3 100%);
        color: #fff;
    }

    .btn-outline-premium {
        background: transparent;
        border: 2px solid #212529;
        color: #212529;
        padding: 12px 26px;
        border-radius: 30px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }
    .btn-outline-premium:hover {
        background: #212529;
        color: #fff;
        transform: translateY(-2px);
    }

    /* SEO Dashboard Cards */
    .seo-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        padding: 2.5rem 2rem;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .seo-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.06);
    }
    .seo-icon-wrapper {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem auto;
        font-size: 2rem;
    }
    .seo-title {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        color: #212529;
        font-size: 1.25rem;
        margin-bottom: 0.5rem;
    }
    .seo-stat {
        font-size: 3rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 1rem;
        color: #212529;
    }

    /* Feature Blocks */
    .feature-block {
        background: #f8f9fa;
        border-radius: 20px;
        padding: 2rem;
        height: 100%;
        border: 1px solid #f1f3f5;
        transition: all 0.3s ease;
    }
    .feature-block:hover {
        background: #ffffff;
        border-color: #0d6efd;
        box-shadow: 0 10px 30px rgba(13, 110, 253, 0.05);
    }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .status-warning { background: #fff3cd; color: #856404; }
    .status-success { background: #d1e7dd; color: #0f5132; }

    .fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    @keyframes fadeInUp {
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection

@section('content')

    <!-- Premium Page Header -->
    <div class="premium-page-header fade-in-up">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
            <div class="d-flex align-items-center gap-4">
                <div class="bg-dark text-white p-4 rounded-4 d-flex align-items-center justify-content-center shadow-lg">
                    <i class="bi bi-google" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="font-family: 'Playfair Display', serif; letter-spacing: -0.5px;">Search Visibility DNA</h2>
                    <p class="text-secondary mb-0 fs-6">Elevate your brand's presence across the digital search realm.</p>
                </div>
            </div>
            <a href="{{ route('sitemap') }}" target="_blank" class="btn btn-outline-premium d-flex align-items-center gap-2">
                <i class="bi bi-diagram-3"></i> View Live Sitemap
            </a>
        </div>
    </div>

    <!-- SEO Analytics Cards -->
    <div class="row g-4 mb-5">
        <!-- Product SEO -->
        <div class="col-md-4 fade-in-up" style="animation-delay: 0.1s;">
            <div class="seo-card">
                <div class="seo-icon-wrapper bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-gem"></i>
                </div>
                <h5 class="seo-title">Product Optimization</h5>
                <div class="seo-stat">{{ $stats['total_products'] }}</div>
                
                <div class="mb-4">
                    @if($stats['missing_product_seo'] > 0)
                        <div class="status-pill status-warning">
                            <i class="bi bi-exclamation-triangle-fill"></i> {{ $stats['missing_product_seo'] }} Missing Metadata
                        </div>
                    @else
                        <div class="status-pill status-success">
                            <i class="bi bi-check-circle-fill"></i> Fully Optimized
                        </div>
                    @endif
                </div>
                
                <div class="mt-auto pt-4 border-top">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-light rounded-pill w-100 fw-bold border">
                        Optimize Masterpieces <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Collection SEO -->
        <div class="col-md-4 fade-in-up" style="animation-delay: 0.2s;">
            <div class="seo-card">
                <div class="seo-icon-wrapper bg-warning bg-opacity-10 text-warning">
                    <i class="bi bi-columns-gap"></i>
                </div>
                <h5 class="seo-title">Collection Curation</h5>
                <div class="seo-stat">{{ $stats['total_collections'] }}</div>
                
                <div class="mb-4">
                    @if($stats['missing_collection_seo'] > 0)
                        <div class="status-pill status-warning">
                            <i class="bi bi-exclamation-triangle-fill"></i> {{ $stats['missing_collection_seo'] }} Missing Metadata
                        </div>
                    @else
                        <div class="status-pill status-success">
                            <i class="bi bi-check-circle-fill"></i> Fully Optimized
                        </div>
                    @endif
                </div>
                
                <div class="mt-auto pt-4 border-top">
                    <a href="{{ route('admin.collections.index') }}" class="btn btn-light rounded-pill w-100 fw-bold border">
                        Optimize Collections <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Chronicles SEO -->
        <div class="col-md-4 fade-in-up" style="animation-delay: 0.3s;">
            <div class="seo-card">
                <div class="seo-icon-wrapper bg-success bg-opacity-10 text-success">
                    <i class="bi bi-journal-text"></i>
                </div>
                <h5 class="seo-title">Chronicles & Stories</h5>
                <div class="seo-stat">{{ $stats['total_posts'] }}</div>
                
                <div class="mb-4">
                    @if($stats['missing_post_seo'] > 0)
                        <div class="status-pill status-warning">
                            <i class="bi bi-exclamation-triangle-fill"></i> {{ $stats['missing_post_seo'] }} Missing Metadata
                        </div>
                    @else
                        <div class="status-pill status-success">
                            <i class="bi bi-check-circle-fill"></i> Fully Optimized
                        </div>
                    @endif
                </div>
                
                <div class="mt-auto pt-4 border-top">
                    <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-light rounded-pill w-100 fw-bold border">
                        Optimize Narratives <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Technical SEO Details -->
    <div class="bg-white rounded-4 shadow-sm border p-4 p-lg-5 fade-in-up" style="animation-delay: 0.4s;">
        <h4 class="fw-bolder mb-4" style="font-family: 'Playfair Display', serif;"><i class="bi bi-diagram-2-fill text-primary me-2"></i> Technical Infrastructure</h4>
        
        <div class="row g-4">
            <div class="col-md-6">
                <div class="feature-block">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-diagram-3"></i>
                        </div>
                        <h5 class="fw-bold m-0">Dynamic Sitemap</h5>
                    </div>
                    <p class="text-secondary small mb-4" style="line-height: 1.6;">
                        Your sitemap is automatically generated and updated in real-time. This XML file is the blueprint that Google uses to discover, crawl, and index all your royal masterpieces and collections.
                    </p>
                    <div class="bg-white p-3 rounded-3 border mb-4 d-flex align-items-center justify-content-between">
                        <code class="text-dark fw-bold">{{ route('sitemap') }}</code>
                        <i class="bi bi-check-circle-fill text-success"></i>
                    </div>
                    <a href="{{ route('sitemap') }}" target="_blank" class="btn btn-dark rounded-pill px-4 fw-bold w-100">
                        View Live Sitemap Index
                    </a>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="feature-block">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                            <i class="bi bi-bar-chart-line-fill"></i>
                        </div>
                        <h5 class="fw-bold m-0">Search Engine Verification</h5>
                    </div>
                    <p class="text-secondary small mb-4" style="line-height: 1.6;">
                        Ensure your storefront is properly claimed on Google Search Console and Bing Webmaster Tools. You can manage your global site verification meta tags and analytics tracking IDs in your Global Settings Studio.
                    </p>
                    <div class="d-flex gap-3 mb-4">
                        <div class="bg-white p-2 rounded border text-center flex-grow-1"><i class="bi bi-google fs-4 text-muted"></i></div>
                        <div class="bg-white p-2 rounded border text-center flex-grow-1"><i class="bi bi-microsoft fs-4 text-muted"></i></div>
                        <div class="bg-white p-2 rounded border text-center flex-grow-1"><i class="bi bi-facebook fs-4 text-muted"></i></div>
                    </div>
                    <a href="{{ route('admin.settings.index') }}" class="btn btn-outline-dark rounded-pill px-4 fw-bold w-100">
                        Manage Global Tracking <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
