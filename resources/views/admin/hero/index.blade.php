@extends('admin.layout')

@section('title', 'Hero Showcase Configuration')

@section('styles')
<style>
    /* Premium Page Header */
    .premium-page-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 5px 25px rgba(0,0,0,0.02);
        margin-bottom: 2rem;
        border: 1px solid rgba(0,0,0,0.03);
    }

    /* Premium Form Card */
    .premium-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 40px rgba(0,0,0,0.03);
        overflow: hidden;
    }

    /* Form Elements */
    .form-control, .form-select, .input-group-text {
        border-radius: 12px;
        padding: 14px 18px;
        border: 1px solid #e9ecef;
        background-color: #f8f9fa;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        background-color: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }
    .input-group-text {
        color: #adb5bd;
    }

    /* Section Styling */
    .section-title {
        font-size: 0.85rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #495057;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    /* Upload Zone */
    .upload-zone {
        border: 2px dashed #dee2e6;
        border-radius: 20px;
        padding: 2.5rem 2rem;
        text-align: center;
        background: #f8f9fa;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .upload-zone:hover {
        border-color: #0d6efd;
        background: #f1f8ff;
    }
    .upload-zone i {
        font-size: 3rem;
        color: #adb5bd;
        margin-bottom: 15px;
        display: block;
        transition: color 0.3s ease;
    }
    .upload-zone:hover i {
        color: #0d6efd;
    }

    /* CTA Card */
    .cta-card {
        background: #ffffff;
        border: 1px solid #e9ecef;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        transition: all 0.3s ease;
    }
    .cta-card:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.04);
        border-color: #dee2e6;
        transform: translateY(-3px);
    }

    /* Buttons */
    .btn-premium {
        background: linear-gradient(135deg, #000000 0%, #333333 100%);
        border: none;
        box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        color: #fff;
        padding: 16px 45px;
        border-radius: 30px;
        font-weight: 700;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }
    .btn-premium:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.3);
        background: linear-gradient(135deg, #111111 0%, #444444 100%);
        color: #fff;
    }

    /* Hero Preview Widget */
    .hero-preview-wrapper {
        border-radius: 24px;
        overflow: hidden;
        position: relative;
        background: #000;
        aspect-ratio: 9/16;
        box-shadow: 0 20px 50px rgba(0,0,0,0.15);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 2rem;
        color: white;
    }
    .hero-preview-wrapper::before {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 50%, rgba(0,0,0,0.4) 100%);
        z-index: 1;
    }
    .preview-content {
        position: relative;
        z-index: 2;
        text-align: center;
    }
    .preview-title {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 10px;
        line-height: 1.2;
    }
    .preview-subtitle {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 20px;
    }
    .preview-btn {
        background: white;
        color: black;
        border: none;
        padding: 12px 24px;
        border-radius: 30px;
        font-weight: 600;
        font-size: 0.8rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin: 5px;
    }
    .preview-btn-outline {
        background: transparent;
        color: white;
        border: 1px solid white;
    }
    .preview-badge {
        position: absolute;
        top: 20px; right: 20px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        padding: 8px 15px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: bold;
        z-index: 3;
        color: white;
        border: 1px solid rgba(255,255,255,0.3);
    }
    #preview-video {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        object-fit: cover;
        z-index: 0;
        opacity: 0.6;
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

    <!-- Header Area -->
    <div class="premium-page-header fade-in-up">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-4">
                <div class="bg-dark text-white p-4 rounded-4 d-flex align-items-center justify-content-center shadow-sm">
                    <i class="bi bi-stars" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="letter-spacing: -0.5px; font-family: 'Playfair Display', serif;">Hero Experience Manager</h2>
                    <p class="text-secondary mb-0 fs-6">Design the ultimate first impression with cinematic video and compelling typography.</p>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-4 bg-success-subtle text-success fade-in-up" style="animation-delay: 0.1s;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        <!-- Configuration Form -->
        <div class="col-xl-8 col-lg-7 fade-in-up" style="animation-delay: 0.2s;">
            <div class="card premium-card border-0">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Typography Section -->
                        <div class="mb-5">
                            <div class="section-title">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                    <i class="bi bi-type"></i>
                                </div>
                                Narrative & Typography
                            </div>
                            <div class="row g-4">
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark small text-uppercase">Cinematic Primary Title</label>
                                    <input type="text" name="title" id="input-title" class="form-control form-control-lg fw-bold"
                                        value="{{ $hero->title }}" required placeholder="e.g. Elegance Redefined">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-bold text-dark small text-uppercase">Secondary Narrative (Subtitle)</label>
                                    <textarea name="subtitle" id="input-subtitle" class="form-control" rows="3"
                                        required placeholder="A brief description...">{{ $hero->subtitle }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Media Section -->
                        <div class="mb-5">
                            <div class="section-title">
                                <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                    <i class="bi bi-camera-video"></i>
                                </div>
                                Atmospheric Media
                            </div>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark small text-uppercase mb-2 d-block">Option A: Cinematic Video Upload</label>
                                    <div id="videoBrowseBtn" class="upload-zone shadow-sm">
                                        <i class="bi bi-cloud-arrow-up"></i>
                                        <div class="fw-bold text-dark mt-3 fs-5">Click to choose video</div>
                                        <div class="small text-secondary mt-2">Vertical MP4 recommended</div>
                                        <div id="videoFileName" class="file-name text-primary mt-3"></div>
                                    </div>
                                    <input type="hidden" name="chunked_video_path" id="chunked_video_path">

                                    <div id="upload-status" class="mt-3 p-3 rounded-4 text-center d-none" style="background: #f8f9fa; border: 1px solid #e9ecef;">
                                        <div class="spinner-border spinner-border-sm text-primary me-2 d-none" id="upload-spinner" role="status"></div>
                                        <span class="status-text fw-bold"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold text-dark small text-uppercase mb-2 d-block">Option B: Asset Path or URL</label>
                                    <div class="p-4 bg-light rounded-4 h-100 d-flex flex-column justify-content-center" style="border: 1px solid #e9ecef;">
                                        <div class="input-group mb-4 shadow-sm">
                                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-link-45deg fs-5"></i></span>
                                            <input type="text" name="video_url" id="input-video-url" class="form-control border-start-0 ps-0"
                                                value="{{ $hero->video_url }}" placeholder="videos/hero.mp4 or https://...">
                                        </div>
                                        
                                        <div class="p-4 bg-white rounded-4 border shadow-sm">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <div class="fw-bold text-dark small text-uppercase"><i class="bi bi-eye text-primary me-2"></i> Storefront Visibility</div>
                                                <div class="form-check form-switch m-0 fs-4">
                                                    <input class="form-check-input" type="checkbox" name="is_active" id="input-is-active" {{ $hero->is_active ? 'checked' : '' }}>
                                                </div>
                                            </div>
                                            <div class="text-secondary" style="font-size: 0.8rem;">Toggle to show or hide the hero section on your live storefront.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Calls to Action -->
                        <div class="mb-5">
                            <div class="section-title">
                                <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                    <i class="bi bi-cursor"></i>
                                </div>
                                Interactive Triggers
                            </div>
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="cta-card position-relative overflow-hidden">
                                        <div class="position-absolute top-0 start-0 w-100" style="height: 4px; background: #212529;"></div>
                                        <div class="d-flex align-items-center gap-2 mb-4">
                                            <div class="badge-num bg-dark text-white shadow-sm">1</div>
                                            <span class="fw-bold text-dark small text-uppercase">Primary Action</span>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold small text-secondary">Button Label</label>
                                            <input type="text" name="button_1_text" id="input-btn1" class="form-control shadow-sm"
                                                value="{{ $hero->button_1_text }}" placeholder="e.g. Shop Collection">
                                        </div>
                                        <div>
                                            <label class="form-label fw-semibold small text-secondary">Destination URL</label>
                                            <input type="text" name="button_1_link" class="form-control shadow-sm"
                                                value="{{ $hero->button_1_link }}" placeholder="/shop">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="cta-card position-relative overflow-hidden">
                                        <div class="position-absolute top-0 start-0 w-100" style="height: 4px; background: #f8f9fa;"></div>
                                        <div class="d-flex align-items-center gap-2 mb-4">
                                            <div class="badge-num bg-light text-dark border shadow-sm">2</div>
                                            <span class="fw-bold text-dark small text-uppercase">Secondary Action</span>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label fw-semibold small text-secondary">Button Label</label>
                                            <input type="text" name="button_2_text" id="input-btn2" class="form-control shadow-sm"
                                                value="{{ $hero->button_2_text }}" placeholder="e.g. Discover More">
                                        </div>
                                        <div>
                                            <label class="form-label fw-semibold small text-secondary">Destination URL</label>
                                            <input type="text" name="button_2_link" class="form-control shadow-sm"
                                                value="{{ $hero->button_2_link }}" placeholder="/about">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-5" style="opacity: 0.1;">

                        <div class="text-end pb-2">
                            <button type="submit" class="btn btn-premium d-inline-flex align-items-center justify-content-center gap-2 w-100 py-3" id="submitBtn">
                                <i class="bi bi-magic fs-5"></i> Publish Cinematic Experience
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Live Preview Widget -->
        <div class="col-xl-4 col-lg-5 fade-in-up" style="animation-delay: 0.4s;">
            <div class="sticky-top" style="top: 2rem;">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6 class="fw-bold text-uppercase mb-0 text-secondary" style="letter-spacing: 1px;"><i class="bi bi-phone"></i> Live Mobile Preview</h6>
                </div>
                
                <div class="hero-preview-wrapper shadow-lg">
                    <div class="preview-badge" id="preview-badge">
                        <i class="bi bi-circle-fill text-success me-1" style="font-size: 0.5rem;"></i> Active
                    </div>
                    
                    @if($hero->video_url)
                        <video id="preview-video" autoplay loop muted playsinline>
                            <source src="{{ asset($hero->video_url) }}" type="video/mp4">
                        </video>
                    @else
                        <div id="preview-video" style="background: linear-gradient(45deg, #2c3e50, #3498db);"></div>
                    @endif

                    <div class="preview-content">
                        <h2 class="preview-title" id="preview-title">{{ $hero->title ?: 'Elegance Redefined' }}</h2>
                        <p class="preview-subtitle" id="preview-subtitle">{{ $hero->subtitle ?: 'Discover the beauty of our new collection.' }}</p>
                        <div class="d-flex flex-column gap-2 align-items-center">
                            <button class="preview-btn" id="preview-btn1-display" style="{{ !$hero->button_1_text ? 'display: none;' : '' }}">{{ $hero->button_1_text }}</button>
                            <button class="preview-btn preview-btn-outline" id="preview-btn2-display" style="{{ !$hero->button_2_text ? 'display: none;' : '' }}">{{ $hero->button_2_text }}</button>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3 text-secondary small">
                    <i class="bi bi-info-circle"></i> Preview updates automatically as you type.
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
    <script>
        // Real-time Preview Logic
        document.getElementById('input-title').addEventListener('input', function(e) {
            document.getElementById('preview-title').innerText = e.target.value || 'Elegance Redefined';
        });
        
        document.getElementById('input-subtitle').addEventListener('input', function(e) {
            document.getElementById('preview-subtitle').innerText = e.target.value || 'Discover the beauty of our new collection.';
        });

        document.getElementById('input-btn1').addEventListener('input', function(e) {
            const btn = document.getElementById('preview-btn1-display');
            btn.innerText = e.target.value;
            btn.style.display = e.target.value ? 'inline-block' : 'none';
        });

        document.getElementById('input-btn2').addEventListener('input', function(e) {
            const btn = document.getElementById('preview-btn2-display');
            btn.innerText = e.target.value;
            btn.style.display = e.target.value ? 'inline-block' : 'none';
        });

        document.getElementById('input-is-active').addEventListener('change', function(e) {
            const badge = document.getElementById('preview-badge');
            if (e.target.checked) {
                badge.innerHTML = '<i class="bi bi-circle-fill text-success me-1" style="font-size: 0.5rem;"></i> Active';
            } else {
                badge.innerHTML = '<i class="bi bi-circle-fill text-danger me-1" style="font-size: 0.5rem;"></i> Hidden';
            }
        });

        // Upload Logic
        let resumable = new Resumable({
            target: "{{ route('admin.upload.video.chunk') }}",
            query: { _token: "{{ csrf_token() }}" },
            fileType: ['mp4', 'mov', 'ogg', 'webm'],
            chunkSize: 2 * 1024 * 1024,
            headers: { 'Accept': 'application/json' },
            testChunks: false,
            throttleProgressCallbacks: 1,
        });

        const browseBtn = document.getElementById('videoBrowseBtn');
        const videoFileNameEl = document.getElementById('videoFileName');
        const statusEl = document.getElementById('upload-status');
        const statusTextEl = statusEl.querySelector('.status-text');
        const spinnerEl = document.getElementById('upload-spinner');
        const chunkedPathInput = document.getElementById('chunked_video_path');
        const submitBtn = document.getElementById('submitBtn');

        resumable.assignBrowse(browseBtn);

        function setStatus(text, color, showSpinner = false) {
            statusEl.classList.remove('d-none');
            statusTextEl.innerText = text;
            statusTextEl.style.color = color || '#666';
            if (showSpinner) {
                spinnerEl.classList.remove('d-none');
            } else {
                spinnerEl.classList.add('d-none');
            }
        }

        resumable.on('fileAdded', function (file) {
            videoFileNameEl.innerText = file.fileName;
            browseBtn.style.borderColor = '#0d6efd';
            submitBtn.disabled = true;
            chunkedPathInput.value = "";
            setStatus('🚀 Starting upload...', '#0d6efd', true);
            resumable.upload();
        });

        resumable.on('fileProgress', function (file) {
            let progress = Math.floor(file.progress() * 100);
            setStatus(`📤 Uploading cinematic asset... ${progress}%`, '#0d6efd', true);
        });

        resumable.on('fileSuccess', function (file, message) {
            try {
                const response = JSON.parse(message);
                if (response.path) {
                    chunkedPathInput.value = response.path;
                    setStatus('✅ Cinematic asset ready!', '#198754', false);
                    submitBtn.disabled = false;
                }
            } catch (e) {
                console.error('Parse error:', e, message);
                setStatus('❌ Upload error. Try again.', '#dc3545', false);
            }
        });

        resumable.on('fileError', function (file, message) {
            console.error('Upload error:', message);
            setStatus('❌ Upload failed. Please check file size.', '#dc3545', false);
            submitBtn.disabled = false;
        });
    </script>
@endsection