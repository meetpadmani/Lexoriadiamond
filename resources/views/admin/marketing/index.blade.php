@extends('admin.layout')

@section('title', 'Marketing Ads')

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

    /* Premium Panels */
    .premium-panel {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        padding: 2.5rem;
        margin-bottom: 2rem;
    }
    .panel-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f8f9fa;
    }
    .panel-icon {
        width: 40px; height: 40px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem;
    }
    .panel-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #212529;
        margin: 0;
    }

    /* Form Elements */
    .form-control-studio {
        display: block;
        width: 100%;
        border-radius: 12px;
        padding: 14px 20px;
        border: 2px solid #f1f3f5;
        background-color: #f8f9fa;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        color: #495057;
    }
    .form-control-studio:focus {
        background-color: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        outline: none;
    }
    .form-label-studio {
        font-weight: 800;
        color: #495057;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 0.75rem;
        display: block;
    }

    /* Buttons */
    .btn-premium {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        color: #fff;
        padding: 16px 36px;
        border-radius: 30px;
        font-weight: 700;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        width: 100%;
    }
    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(13, 110, 253, 0.4);
        background: linear-gradient(135deg, #0b5ed7 0%, #094eb3 100%);
        color: #fff;
    }

    /* Partner Badge */
    .partner-badge {
        display: inline-flex;
        align-items: center;
        gap: 15px;
        background: #f8f9fa;
        padding: 15px 25px;
        border-radius: 20px;
        border: 1px solid #f1f3f5;
        margin-bottom: 2rem;
    }

    /* Marketing Tabs Customization */
    .marketing-tabs {
        border-bottom: 2px solid #f1f3f5;
        margin-bottom: 2.5rem;
        padding-bottom: 0.5rem;
        gap: 1rem;
    }
    .marketing-tabs .nav-link {
        border: none;
        background: transparent;
        color: #6c757d;
        font-weight: 700;
        font-size: 1.1rem;
        padding: 12px 24px;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    .marketing-tabs .nav-link:hover {
        background: #f8f9fa;
        color: #212529;
    }
    .marketing-tabs .nav-link.active {
        background: #212529;
        color: #ffffff !important;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
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
                    <i class="bi bi-megaphone-fill" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="font-family: 'Playfair Display', serif; letter-spacing: -0.5px;">Marketing Ads</h2>
                    <p class="text-secondary mb-0 fs-6">Connect your storefront to powerful ad networks and analytics platforms.</p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2 px-4 py-2 bg-success bg-opacity-10 rounded-pill">
                <div class="bg-success rounded-circle animate-pulse" style="width: 8px; height: 8px;"></div>
                <span class="small fw-bold letter-spacing-1 text-success text-uppercase">Tracking Active</span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-4 bg-success-subtle text-success fade-in-up" style="animation-delay: 0.1s;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="premium-panel fade-in-up" style="animation-delay: 0.2s; padding: 3rem;">
        <!-- Simple Top Tabs -->
        <ul class="nav nav-tabs marketing-tabs border-bottom-0" id="marketingTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="meta-tab" data-bs-toggle="tab" data-bs-target="#meta-content" type="button" role="tab" aria-controls="meta-content" aria-selected="true">
                    <i class="bi bi-meta me-2"></i> Meta Ads
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="google-tab" data-bs-toggle="tab" data-bs-target="#google-content" type="button" role="tab" aria-controls="google-content" aria-selected="false">
                    <i class="bi bi-google me-2"></i> Google Ads
                </button>
            </li>
        </ul>

        <form action="{{ route('admin.marketing.update') }}" method="POST">
            @csrf
            
            <div class="tab-content pt-3 mb-5" id="marketingTabContent">
                
                <!-- Meta Ads Form -->
                <div class="tab-pane fade show active" id="meta-content" role="tabpanel" aria-labelledby="meta-tab">
                    <h4 class="fw-bolder mb-4 text-dark" style="font-family: 'Playfair Display', serif;">Meta Business Suite Configuration</h4>
                    
                    <div class="mb-4">
                        <label class="form-label-studio">Meta Pixel ID</label>
                        <input type="text" name="meta_pixel_id" class="form-control-studio" 
                               value="{{ old('meta_pixel_id', $settings->meta_pixel_id) }}" 
                               placeholder="e.g. 123456789012345">
                        <div class="form-text mt-2 text-muted small">
                            Used for standard web events like PageView and Purchase.
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-studio">Meta Conversions API Token</label>
                        <textarea name="meta_access_token" class="form-control-studio" rows="3" 
                                  placeholder="EAAL... (System User Access Token)">{{ old('meta_access_token', $settings->meta_access_token) }}</textarea>
                        <div class="form-text mt-2 text-muted small">
                            Essential for Server-Side Event Setup. Highly accurate tracking.
                        </div>
                    </div>

                    <h5 class="fw-bold mt-5 mb-4 border-bottom pb-2" style="color: #495057;">Event Tracking Configuration</h5>
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-check form-switch p-3 border rounded-3 bg-white">
                                <input class="form-check-input ms-0 me-3" type="checkbox" role="switch" id="event_page_view" name="meta_event_page_view" {{ old('meta_event_page_view', $settings->meta_event_page_view) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="event_page_view">Page View</label>
                                <div class="small text-muted ms-5">Track all page visits</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch p-3 border rounded-3 bg-white">
                                <input class="form-check-input ms-0 me-3" type="checkbox" role="switch" id="event_view_content" name="meta_event_view_content" {{ old('meta_event_view_content', $settings->meta_event_view_content) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="event_view_content">View Content</label>
                                <div class="small text-muted ms-5">Track product views</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch p-3 border rounded-3 bg-white">
                                <input class="form-check-input ms-0 me-3" type="checkbox" role="switch" id="event_add_to_cart" name="meta_event_add_to_cart" {{ old('meta_event_add_to_cart', $settings->meta_event_add_to_cart) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="event_add_to_cart">Add To Cart</label>
                                <div class="small text-muted ms-5">Track cart additions</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch p-3 border rounded-3 bg-white">
                                <input class="form-check-input ms-0 me-3" type="checkbox" role="switch" id="event_initiate_checkout" name="meta_event_initiate_checkout" {{ old('meta_event_initiate_checkout', $settings->meta_event_initiate_checkout) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="event_initiate_checkout">Initiate Checkout</label>
                                <div class="small text-muted ms-5">Track checkout starts</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-switch p-3 border rounded-3 bg-white">
                                <input class="form-check-input ms-0 me-3" type="checkbox" role="switch" id="event_purchase" name="meta_event_purchase" {{ old('meta_event_purchase', $settings->meta_event_purchase) ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold" for="event_purchase">Purchase</label>
                                <div class="small text-muted ms-5">Track completed orders</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Google Ads Form -->
                <div class="tab-pane fade" id="google-content" role="tabpanel" aria-labelledby="google-tab">
                    <h4 class="fw-bolder mb-4 text-dark" style="font-family: 'Playfair Display', serif;">Google Advertising Configuration</h4>
                    
                    <div class="mb-4">
                        <label class="form-label-studio">Google Ads Conversion ID</label>
                        <input type="text" name="google_ads_id" class="form-control-studio" 
                               value="{{ old('google_ads_id', $settings->google_ads_id) }}" 
                               placeholder="AW-1234567890">
                        <div class="form-text mt-2 text-muted small">
                            Used to track conversions from Google Search, Display, and Shopping campaigns.
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label-studio">Google Ads Full Pixel Code</label>
                        <textarea name="google_ads_script" class="form-control-studio" rows="5" 
                                  placeholder="<!-- Global site tag (gtag.js) - Google Ads: AW-1234567890 -->&#10;<script async src='https://www.googletagmanager.com/gtag/js?id=AW-1234567890'></script>&#10;<script>&#10;  window.dataLayer = window.dataLayer || [];&#10;  function gtag(){dataLayer.push(arguments);}&#10;  gtag('js', new Date());&#10;  gtag('config', 'AW-1234567890');&#10;</script>">{{ old('google_ads_script', $settings->google_ads_script) }}</textarea>
                        <div class="form-text mt-2 text-muted small">
                            Paste the complete Global site tag (gtag.js) script here if you want to manually inject the full tracking code into your website header.
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="d-flex justify-content-between align-items-center border-top pt-4 mt-4">
                <div class="text-secondary small">
                    <i class="bi bi-shield-check text-success me-1"></i> Changes take effect immediately across all storefronts.
                </div>
                <button type="submit" class="btn btn-premium px-5" style="width: auto;">
                    <i class="bi bi-save me-2"></i> Save Settings
                </button>
            </div>
        </form>
    </div>

@endsection
