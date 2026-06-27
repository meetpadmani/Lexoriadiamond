@extends('admin.layout')

@section('title', 'Brand Aesthetics & Typography')

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
        background: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem;
    }
    .panel-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: #212529;
        margin: 0;
    }

    /* Form Elements */
    .form-control-studio, .form-select-studio {
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

    /* Buttons */
    .btn-premium {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        color: #fff;
        padding: 16px 30px;
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

    /* Color Swatch */
    .color-swatch-picker {
        width: 40px; height: 40px;
        border-radius: 50%;
        cursor: pointer;
        transition: transform 0.2s ease;
        border: 2px solid #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .color-swatch-picker:hover {
        transform: scale(1.1);
    }

    /* Live Preview Box */
    .live-preview-box {
        background: #fdfaf7;
        border: 1px solid #f6ece3;
        border-radius: 24px;
        padding: 3rem;
        position: sticky;
        top: 2rem;
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
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Cormorant+Garamond&family=Cinzel&family=Bodoni+Moda&family=Marcellus&family=Libre+Baskerville&family=Prata&family=Poppins&family=Montserrat&family=Lato&family=Raleway&family=Tenor+Sans&family=Inter&display=swap" rel="stylesheet">
@endsection

@section('content')

    <!-- Premium Page Header -->
    <div class="premium-page-header fade-in-up">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
            <div class="d-flex align-items-center gap-4">
                <div class="bg-dark text-white p-4 rounded-4 d-flex align-items-center justify-content-center shadow-lg">
                    <i class="bi bi-type" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="font-family: 'Playfair Display', serif; letter-spacing: -0.5px;">Brand Aesthetics</h2>
                    <p class="text-secondary mb-0 fs-6">Orchestrate the visual harmony of your storefront with signature typography and tones.</p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2 px-4 py-2 bg-primary bg-opacity-10 rounded-pill">
                <div class="bg-primary rounded-circle animate-pulse" style="width: 8px; height: 8px;"></div>
                <span class="small fw-bold letter-spacing-1 text-primary text-uppercase">Live Preview Active</span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-4 bg-success-subtle text-success fade-in-up" style="animation-delay: 0.1s;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        <!-- Settings Panel -->
        <div class="col-xl-6 col-lg-6 fade-in-up" style="animation-delay: 0.2s;">
            <form action="{{ route('admin.typography.update') }}" method="POST">
                @csrf
                
                <div class="premium-panel">
                    <div class="panel-header">
                        <div class="panel-icon"><i class="bi bi-fonts"></i></div>
                        <h3 class="panel-title">Typography Signatures</h3>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-studio">1. Primary Heading Signature <span class="text-danger">*</span></label>
                        <select name="heading_font_family" class="form-select-studio fw-bold" id="heading_select" style="font-family: '{{ $settings->heading_font_family }}', serif;" required onchange="this.style.fontFamily = this.value + ', serif';">
                            @foreach($headingFonts as $font)
                                <option value="{{ $font }}" style="font-family: '{{ $font }}', serif; font-size: 1.1rem; padding: 5px;" {{ $settings->heading_font_family == $font ? 'selected' : '' }}>{{ $font }}</option>
                            @endforeach
                        </select>
                        <div class="form-text mt-2 text-muted small"><i class="bi bi-info-circle me-1"></i> Used for high-impact cinematic titles and luxury call-outs.</div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-studio">2. Body Narrative Font <span class="text-danger">*</span></label>
                        <select name="body_font_family" class="form-select-studio fw-bold" id="body_select" style="font-family: '{{ $settings->body_font_family }}', sans-serif;" required onchange="this.style.fontFamily = this.value + ', sans-serif';">
                            @foreach($bodyFonts as $font)
                                <option value="{{ $font }}" style="font-family: '{{ $font }}', sans-serif; font-size: 1.1rem; padding: 5px;" {{ $settings->body_font_family == $font ? 'selected' : '' }}>{{ $font }}</option>
                            @endforeach
                        </select>
                        <div class="form-text mt-2 text-muted small"><i class="bi bi-info-circle me-1"></i> Used for descriptive content, product details, and general reading flow.</div>
                    </div>
                </div>

                <div class="premium-panel">
                    <div class="panel-header">
                        <div class="panel-icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-palette-fill"></i></div>
                        <h3 class="panel-title">Atmospheric Tone</h3>
                    </div>

                    <label class="form-label-studio">3. Define Primary Accent Color <span class="text-danger">*</span></label>
                    <div class="p-3 rounded-4 bg-light d-flex align-items-center gap-3 border flex-wrap">
                        <div class="d-flex align-items-center gap-3">
                            <input type="color" name="accent_color" class="form-control form-control-color border-0 p-0 rounded-circle flex-shrink-0" id="accentInput" value="{{ $settings->accent_color }}" style="width: 50px; height: 50px; cursor: pointer; background: transparent; overflow: hidden;">
                            <input type="text" class="form-control border-0 bg-transparent fw-bold fs-5 text-uppercase p-0" id="accentText" value="{{ $settings->accent_color }}" readonly style="letter-spacing: 2px; max-width: 100px;">
                        </div>
                        <div class="ms-md-auto d-flex gap-2 flex-wrap">
                            <div class="color-swatch-picker" style="background: #c7a17a;" onclick="setAccent('#c7a17a')" title="Luxury Gold"></div>
                            <div class="color-swatch-picker" style="background: #111111;" onclick="setAccent('#111111')" title="Midnight Black"></div>
                            <div class="color-swatch-picker" style="background: #0d6efd;" onclick="setAccent('#0d6efd')" title="Sapphire Blue"></div>
                            <div class="color-swatch-picker" style="background: #dc3545;" onclick="setAccent('#dc3545')" title="Ruby Red"></div>
                        </div>
                    </div>
                    <div class="form-text mt-2 text-muted small"><i class="bi bi-info-circle me-1"></i> The signature accent applied to buttons, icons, links, and highlights.</div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-premium fs-5 py-3">
                        <i class="bi bi-stars me-2"></i> Apply Visual Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Live Preview -->
        <div class="col-xl-6 col-lg-6 fade-in-up" style="animation-delay: 0.3s;">
            <div class="live-preview-box">
                <div class="text-center mb-5">
                    <span class="text-uppercase fw-bold letter-spacing-2 opacity-50 small mb-2 d-block" id="preview-subtitle" style="color: {{ $settings->accent_color }};">Exquisite Craftsmanship</span>
                    <h1 id="preview-heading" style="font-family: '{{ $settings->heading_font_family }}', serif; font-size: 3.5rem; line-height: 1.1; margin-bottom: 1rem; color: #111;">The Lexoria Legacy</h1>
                    <p id="preview-body" style="font-family: '{{ $settings->body_font_family }}', sans-serif; font-size: 1.1rem; line-height: 1.8; color: #666; max-width: 400px; margin: 0 auto;">
                        Discover the breathtaking harmony of timeless design and modern elegance. Every piece tells a story of passion, precision, and unparalleled beauty.
                    </p>
                </div>

                <div class="bg-white p-4 rounded-4 shadow-sm border border-white text-center mx-auto" style="max-width: 350px;">
                    <div class="bg-light rounded-3 mb-3 d-flex align-items-center justify-content-center" style="height: 150px;">
                        <i class="bi bi-gem fs-1 opacity-25"></i>
                    </div>
                    <h4 id="preview-card-title" style="font-family: '{{ $settings->heading_font_family }}', serif; font-weight: 700;">Imperial Diamond Ring</h4>
                    <p id="preview-card-price" class="fw-bold mb-3" style="color: {{ $settings->accent_color }}; font-size: 1.25rem;">$12,500</p>
                    <button id="preview-button" class="btn text-white fw-bold py-2 w-100 rounded-pill" style="background-color: {{ $settings->accent_color }};">View Masterpiece</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    function updatePreviews() {
        const h = document.getElementById('heading_select').value;
        const b = document.getElementById('body_select').value;
        const color = document.getElementById('accentInput').value;

        document.getElementById('preview-heading').style.fontFamily = `"${h}", serif`;
        document.getElementById('preview-card-title').style.fontFamily = `"${h}", serif`;
        
        document.getElementById('preview-body').style.fontFamily = `"${b}", sans-serif`;
        
        document.getElementById('preview-subtitle').style.color = color;
        document.getElementById('preview-card-price').style.color = color;
        document.getElementById('preview-button').style.backgroundColor = color;
    }

    document.getElementById('heading_select').addEventListener('change', updatePreviews);
    document.getElementById('body_select').addEventListener('change', updatePreviews);
    document.getElementById('accentInput').addEventListener('input', function () {
        document.getElementById('accentText').value = this.value;
        updatePreviews();
    });

    function setAccent(color) {
        document.getElementById('accentInput').value = color;
        document.getElementById('accentText').value = color.toUpperCase();
        updatePreviews();
    }

    // Initial call
    updatePreviews();
</script>
@endsection