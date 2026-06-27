@extends('admin.layout')

@section('title', 'Global Store Settings')

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

    /* Premium Settings Layout */
    .settings-container {
        display: flex;
        gap: 2rem;
    }
    
    .settings-sidebar {
        flex: 0 0 280px;
    }

    .settings-nav {
        background: #ffffff;
        border-radius: 20px;
        padding: 1rem;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        border: 1px solid rgba(0,0,0,0.03);
        position: sticky;
        top: 2rem;
    }

    .settings-nav .nav-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 20px;
        color: #6c757d;
        border-radius: 12px;
        font-weight: 600;
        margin-bottom: 5px;
        transition: all 0.3s ease;
        border: none;
        text-align: left;
    }
    .settings-nav .nav-link:hover {
        background: #f8f9fa;
        color: #212529;
    }
    .settings-nav .nav-link.active {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        color: #ffffff;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2);
    }
    .settings-nav .nav-link i {
        font-size: 1.25rem;
    }

    .settings-content-area {
        flex: 1;
        min-width: 0;
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
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #f8f9fa;
    }
    .panel-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 0.5rem;
    }

    /* Form Elements */
    .form-control-studio, .form-select-studio {
        display: block;
        width: 100%;
        border-radius: 12px;
        padding: 14px 20px;
        border: 2px solid #f1f3f5;
        background-color: #f8f9fa;
        font-size: 1rem;
        transition: all 0.3s ease;
        color: #495057;
    }
    .form-control-studio:focus, .form-select-studio:focus {
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

    /* Input Group Styling */
    .input-group-studio {
        display: flex;
        width: 100%;
        border: 2px solid #f1f3f5;
        border-radius: 12px;
        overflow: hidden;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
    }
    .input-group-studio:focus-within {
        background-color: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }
    .input-group-studio .form-control-studio {
        border: none;
        background: transparent;
        box-shadow: none;
    }
    .input-group-text-studio {
        background: #f1f3f5;
        color: #6c757d;
        padding: 14px 20px;
        font-weight: 600;
        border: none;
        display: flex;
        align-items: center;
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
    }
    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(13, 110, 253, 0.4);
        background: linear-gradient(135deg, #0b5ed7 0%, #094eb3 100%);
        color: #fff;
    }

    /* Visual Asset Box */
    .visual-asset-box {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 16px;
        border: 2px dashed #dee2e6;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .visual-asset-box:hover {
        border-color: #0d6efd;
        background: #f1f8ff;
    }
    .visual-asset-box img {
        background: #fff;
        border-radius: 12px;
        padding: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        object-fit: contain;
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
                    <i class="bi bi-gear-fill" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="font-family: 'Playfair Display', serif; letter-spacing: -0.5px;">Global Store Settings</h2>
                    <p class="text-secondary mb-0 fs-6">Configure your boutique's core information, branding, and operations.</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-4 bg-success-subtle text-success fade-in-up" style="animation-delay: 0.1s;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="settings-container fade-in-up" style="animation-delay: 0.2s;">
            
            <!-- Sidebar Navigation -->
            <div class="settings-sidebar">
                <div class="settings-nav nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="general-tab" data-bs-toggle="pill" data-bs-target="#general" type="button" role="tab">
                        <i class="bi bi-shop"></i> General Information
                    </button>
                    <button class="nav-link" id="branding-tab" data-bs-toggle="pill" data-bs-target="#branding" type="button" role="tab">
                        <i class="bi bi-palette-fill"></i> Branding Assets
                    </button>
                    <button class="nav-link" id="finance-tab" data-bs-toggle="pill" data-bs-target="#finance" type="button" role="tab">
                        <i class="bi bi-currency-exchange"></i> Finance & Taxation
                    </button>
                    <button class="nav-link" id="email-tab" data-bs-toggle="pill" data-bs-target="#email" type="button" role="tab">
                        <i class="bi bi-envelope-paper-fill"></i> Mail Configuration
                    </button>
                    <button class="nav-link" id="social-tab" data-bs-toggle="pill" data-bs-target="#social" type="button" role="tab">
                        <i class="bi bi-share-fill"></i> Social Ecosystem
                    </button>
                </div>
            </div>

            <!-- Content Area -->
            <div class="settings-content-area">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <!-- General Settings -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                        <div class="premium-panel">
                            <div class="panel-header">
                                <h3 class="panel-title">General Information</h3>
                                <p class="text-muted m-0">Basic contact, location, and operational details for your boutique.</p>
                            </div>
                            
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label-studio">Boutique Name</label>
                                    <input type="text" name="store_name" class="form-control-studio fs-5 fw-bold" value="{{ $settings['store_name'] ?? 'Lexoria Diamond' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-studio">Public Email Address</label>
                                    <input type="email" name="store_email" class="form-control-studio" value="{{ $settings['store_email'] ?? '' }}" placeholder="contact@boutique.com">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-studio">Support Phone Number</label>
                                    <input type="text" name="store_phone" class="form-control-studio" value="{{ $settings['store_phone'] ?? '' }}" placeholder="+91 98765 43210">
                                </div>
                                <div class="col-12">
                                    <label class="form-label-studio">Physical Address</label>
                                    <textarea name="store_address" class="form-control-studio" rows="3" placeholder="Enter the full physical address...">{{ $settings['store_address'] ?? '' }}</textarea>
                                </div>
                                <div class="col-12">
                                    <label class="form-label-studio">Operational Hours</label>
                                    <input type="text" name="store_hours" class="form-control-studio" value="{{ $settings['store_hours'] ?? 'Mon - Sat: 10:00 AM - 08:00 PM' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Branding Settings -->
                    <div class="tab-pane fade" id="branding" role="tabpanel">
                        <div class="premium-panel">
                            <div class="panel-header">
                                <h3 class="panel-title">Branding Assets</h3>
                                <p class="text-muted m-0">Define the visual identity of your storefront.</p>
                            </div>
                            
                            <div class="row g-5">
                                <div class="col-12">
                                    <label class="form-label-studio">Primary Store Logo</label>
                                    <div class="visual-asset-box" onclick="document.getElementById('logoInput').click()">
                                        <img src="{{ asset($settings['logo'] ?? 'img/lexoria-logo.png') }}" id="logo-preview" style="width: 200px; height: 80px;">
                                        <div>
                                            <h6 class="fw-bold mb-1">Upload Master Logo</h6>
                                            <p class="text-muted small m-0">Recommended: PNG with transparent background. 400x120px.</p>
                                        </div>
                                    </div>
                                    <input type="file" name="logo" id="logoInput" class="d-none" accept="image/*" onchange="previewImage(this, 'logo-preview')">
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label-studio">Browser Favicon</label>
                                    <div class="visual-asset-box" onclick="document.getElementById('faviconInput').click()">
                                        <img src="{{ asset($settings['favicon'] ?? 'favicon.ico') }}" id="favicon-preview" style="width: 64px; height: 64px;">
                                        <div>
                                            <h6 class="fw-bold mb-1">Upload Favicon</h6>
                                            <p class="text-muted small m-0">Recommended: ICO/PNG 64x64px.</p>
                                        </div>
                                    </div>
                                    <input type="file" name="favicon" id="faviconInput" class="d-none" accept="image/*" onchange="previewImage(this, 'favicon-preview')">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label-studio">Loader Animation</label>
                                    <div class="visual-asset-box" onclick="document.getElementById('loaderInput').click()">
                                        <img src="{{ asset($settings['loader_img'] ?? 'img/loader.png') }}" id="loader-preview" style="width: 64px; height: 64px;">
                                        <div>
                                            <h6 class="fw-bold mb-1">Upload Loader</h6>
                                            <p class="text-muted small m-0">Displayed during page transitions.</p>
                                        </div>
                                    </div>
                                    <input type="file" name="loader_img" id="loaderInput" class="d-none" accept="image/*" onchange="previewImage(this, 'loader-preview')">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Finance Settings -->
                    <div class="tab-pane fade" id="finance" role="tabpanel">
                        <div class="premium-panel">
                            <div class="panel-header">
                                <h3 class="panel-title">Finance & Taxation</h3>
                                <p class="text-muted m-0">Configure local currency formats and tax percentages.</p>
                            </div>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label-studio">Currency Symbol</label>
                                    <input type="text" name="currency_symbol" class="form-control-studio fs-4 fw-bold" value="{{ $settings['currency_symbol'] ?? '$' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-studio">Currency Code (ISO)</label>
                                    <input type="text" name="currency_code" class="form-control-studio" value="{{ $settings['currency_code'] ?? 'USD' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-studio">Standard GST Rate</label>
                                    <div class="input-group-studio">
                                        <input type="number" step="0.01" name="default_tax" class="form-control-studio" value="{{ $settings['default_tax'] ?? '3' }}">
                                        <span class="input-group-text-studio">%</span>
                                    </div>
                                    <p class="form-text mt-2 text-muted small"><i class="bi bi-info-circle me-1"></i> Standard tax applied to jewelry.</p>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-studio">Tax ID / GSTIN</label>
                                    <input type="text" name="store_gstin" class="form-control-studio" value="{{ $settings['store_gstin'] ?? '' }}" placeholder="Enter GSTIN Number">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Email Settings -->
                    <div class="tab-pane fade" id="email" role="tabpanel">
                        <div class="premium-panel">
                            <div class="panel-header">
                                <h3 class="panel-title">Mail Configuration</h3>
                                <p class="text-muted m-0">SMTP settings for system-generated notifications and receipts.</p>
                            </div>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label-studio">SMTP Host</label>
                                    <input type="text" name="mail_host" class="form-control-studio" value="{{ $settings['mail_host'] ?? '' }}" placeholder="smtp.gmail.com">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-studio">SMTP Port</label>
                                    <input type="text" name="mail_port" class="form-control-studio" value="{{ $settings['mail_port'] ?? '587' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-studio">SMTP Username</label>
                                    <input type="text" name="mail_username" class="form-control-studio" value="{{ $settings['mail_username'] ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-studio">SMTP Password</label>
                                    <input type="password" name="mail_password" class="form-control-studio" value="{{ $settings['mail_password'] ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-studio">Encryption</label>
                                    <select name="mail_encryption" class="form-select-studio">
                                        <option value="tls" {{ ($settings['mail_encryption'] ?? 'tls') == 'tls' ? 'selected' : '' }}>TLS</option>
                                        <option value="ssl" {{ ($settings['mail_encryption'] ?? '') == 'ssl' ? 'selected' : '' }}>SSL</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-studio">Sender Name</label>
                                    <input type="text" name="mail_from_name" class="form-control-studio" value="{{ $settings['mail_from_name'] ?? 'Lexoria Diamond' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Settings -->
                    <div class="tab-pane fade" id="social" role="tabpanel">
                        <div class="premium-panel">
                            <div class="panel-header">
                                <h3 class="panel-title">Social Ecosystem</h3>
                                <p class="text-muted m-0">Connect your storefront to your social media presence.</p>
                            </div>
                            
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label-studio"><i class="bi bi-instagram me-1" style="color: #E1306C;"></i> Instagram URL</label>
                                    <input type="url" name="social_instagram" class="form-control-studio" value="{{ $settings['social_instagram'] ?? '' }}" placeholder="https://instagram.com/...">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-studio"><i class="bi bi-facebook me-1" style="color: #1877F2;"></i> Facebook Page</label>
                                    <input type="url" name="social_facebook" class="form-control-studio" value="{{ $settings['social_facebook'] ?? '' }}" placeholder="https://facebook.com/...">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-studio"><i class="bi bi-whatsapp me-1" style="color: #25D366;"></i> WhatsApp Business</label>
                                    <input type="text" name="social_whatsapp" class="form-control-studio" value="{{ $settings['social_whatsapp'] ?? '' }}" placeholder="Include country code (+91...)">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-studio"><i class="bi bi-pinterest me-1" style="color: #E60023;"></i> Pinterest Profile</label>
                                    <input type="url" name="social_pinterest" class="form-control-studio" value="{{ $settings['social_pinterest'] ?? '' }}" placeholder="https://pinterest.com/...">
                                </div>
                                <div class="col-12">
                                    <label class="form-label-studio"><i class="bi bi-youtube me-1" style="color: #FF0000;"></i> YouTube Channel</label>
                                    <input type="url" name="social_youtube" class="form-control-studio" value="{{ $settings['social_youtube'] ?? '' }}" placeholder="https://youtube.com/...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Save Action -->
                    <div class="d-flex justify-content-end mb-5">
                        <input type="hidden" name="group" id="active-group" value="general">
                        <button type="submit" class="btn btn-premium">
                            <i class="bi bi-shield-check me-2"></i> Save Global Settings
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
<script>
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Update group hidden field based on active tab
    document.querySelectorAll('button[data-bs-toggle="pill"]').forEach(button => {
        button.addEventListener('shown.bs.tab', function (event) {
            const targetId = event.target.getAttribute('data-bs-target').replace('#', '');
            document.getElementById('active-group').value = targetId;
        });
    });
</script>
@endsection
