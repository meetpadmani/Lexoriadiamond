@extends('admin.layout')

@section('title', 'Brand Narrative Design')

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
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .visual-asset-text h6 {
        font-weight: 700;
        color: #212529;
        margin-bottom: 5px;
    }
    .visual-asset-text p {
        font-size: 0.85rem;
        color: #6c757d;
        margin: 0;
    }

    /* Counter Metrics Box */
    .metric-box {
        background: #f8f9fa;
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid #f1f3f5;
    }

    /* Live Preview Pane */
    .preview-pane {
        background: #212529;
        border-radius: 24px;
        overflow: hidden;
        position: sticky;
        top: 2rem;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        color: #fff;
    }
    .preview-header {
        padding: 1.5rem;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .preview-body {
        padding: 2rem;
    }
    .preview-image {
        width: 100%;
        aspect-ratio: 4/3;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 1.5rem;
    }
    .preview-subtitle {
        color: #0d6efd;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 0.5rem;
        display: block;
    }
    .preview-title {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    .preview-content {
        color: rgba(255,255,255,0.7);
        line-height: 1.6;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .preview-stats {
        display: flex;
        gap: 2rem;
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .preview-stat-item h3 {
        color: #fff;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }
    .preview-stat-item span {
        color: rgba(255,255,255,0.5);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .preview-btn {
        display: inline-block;
        padding: 10px 24px;
        border: 1px solid #fff;
        color: #fff;
        border-radius: 30px;
        text-transform: uppercase;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 1px;
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
                    <i class="bi bi-book" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="font-family: 'Playfair Display', serif; letter-spacing: -0.5px;">Brand Narrative Design</h2>
                    <p class="text-secondary mb-0 fs-6">Craft the emotional heritage and storytelling for the storefront.</p>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2 px-4 py-2 bg-success bg-opacity-10 rounded-pill">
                <div class="bg-success rounded-circle" style="width: 8px; height: 8px;"></div>
                <span class="small fw-bold letter-spacing-1 text-success text-uppercase">Live Sync Active</span>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-4 bg-success-subtle text-success fade-in-up" style="animation-delay: 0.1s;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        <!-- Main Form Column -->
        <div class="col-xl-7 col-lg-6 fade-in-up" style="animation-delay: 0.2s;">
            <form action="{{ route('admin.brand-story.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Narrative Framework -->
                <div class="premium-panel">
                    <div class="panel-header">
                        <div class="panel-icon"><i class="bi bi-textarea-t"></i></div>
                        <h3 class="panel-title">Narrative Framework</h3>
                    </div>
                    
                    <div class="row g-4">
                        <div class="col-md-5">
                            <label class="form-label-studio">Pre-title Label <span class="text-danger">*</span></label>
                            <input type="text" name="subtitle" class="form-control-studio" value="{{ $story->subtitle }}" required placeholder="e.g. THE LEGACY">
                        </div>
                        <div class="col-md-7">
                            <label class="form-label-studio">Impactful Story Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control-studio fw-bold" value="{{ $story->title }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label-studio">The Core Narrative (Body) <span class="text-danger">*</span></label>
                            <textarea name="content" class="form-control-studio" rows="6" required style="line-height: 1.8;">{{ $story->content }}</textarea>
                            <div class="form-text mt-2 text-muted small"><i class="bi bi-info-circle me-1"></i> Explain your values, craftsmanship and heritage. Use emotional storytelling.</div>
                        </div>
                    </div>
                </div>

                <!-- Visual Asset -->
                <div class="premium-panel">
                    <div class="panel-header">
                        <div class="panel-icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-image-fill"></i></div>
                        <h3 class="panel-title">Visual Heritage Asset</h3>
                    </div>
                    
                    <div class="visual-asset-box mb-4" onclick="document.getElementById('image_file').click()">
                        <img src="{{ str_starts_with($story->image, 'http') ? $story->image : asset('storage/' . $story->image) }}" 
                             id="asset-preview-thumb" 
                             onerror="this.src='{{ asset($story->image) }}'">
                        <div class="visual-asset-text">
                            <h6>Switch Brand Image</h6>
                            <p id="asset-filename">Recommended: 800x1000px Portrait Format</p>
                        </div>
                    </div>
                    <input type="file" name="image_file" id="image_file" class="d-none" onchange="previewAsset(this)">
                    
                    <div class="mt-3 pt-3 border-top border-light">
                        <label class="form-label-studio text-muted">Or Provide Direct URL Path</label>
                        <input type="text" name="image" class="form-control-studio" value="{{ $story->image }}">
                    </div>
                </div>

                <!-- Counter Metrics -->
                <div class="premium-panel">
                    <div class="panel-header">
                        <div class="panel-icon bg-success bg-opacity-10 text-success"><i class="bi bi-bar-chart-fill"></i></div>
                        <h3 class="panel-title">Heritage Counter Metrics</h3>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="metric-box">
                                <label class="form-label-studio">Primary Metric</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-hash"></i></span>
                                    <input type="text" name="stat_1_num" class="form-control form-control-studio border-start-0 ps-0 fw-bold fs-5" value="{{ $story->stat_1_num }}" placeholder="e.g. 50+">
                                </div>
                                <input type="text" name="stat_1_label" class="form-control form-control-studio bg-white" value="{{ $story->stat_1_label }}" placeholder="e.g. Years of Heritage">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="metric-box">
                                <label class="form-label-studio">Secondary Metric</label>
                                <div class="input-group mb-2">
                                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="bi bi-hash"></i></span>
                                    <input type="text" name="stat_2_num" class="form-control form-control-studio border-start-0 ps-0 fw-bold fs-5" value="{{ $story->stat_2_num }}" placeholder="e.g. 10k">
                                </div>
                                <input type="text" name="stat_2_label" class="form-control form-control-studio bg-white" value="{{ $story->stat_2_label }}" placeholder="e.g. Happy Clients">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Call To Action -->
                <div class="premium-panel bg-light border-0">
                    <div class="panel-header border-bottom-0 pb-0">
                        <div class="panel-icon bg-danger bg-opacity-10 text-danger"><i class="bi bi-link-45deg"></i></div>
                        <h3 class="panel-title">Interactive Trigger</h3>
                    </div>

                    <div class="row g-4 mt-1">
                        <div class="col-md-5">
                            <label class="form-label-studio">Action Button Text</label>
                            <input type="text" name="button_text" class="form-control-studio bg-white border-0 shadow-sm" value="{{ $story->button_text }}">
                        </div>
                        <div class="col-md-7">
                            <label class="form-label-studio">Interaction Destination</label>
                            <div class="input-group shadow-sm border-0">
                                <input type="text" name="button_link" id="button_link_input" class="form-control form-control-studio bg-white border-0" value="{{ $story->button_link }}" placeholder="Collection URL...">
                                <button class="btn btn-white bg-white border-0 dropdown-toggle px-4 text-primary fw-bold" type="button" data-bs-toggle="dropdown">Select</button>
                                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 p-2">
                                    <li><a class="dropdown-item rounded-3 py-2" href="javascript:void(0)" onclick="document.getElementById('button_link_input').value = '{{ route('collections') }}'"><i class="bi bi-collection me-2 text-muted"></i> Browse All Collections</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    @foreach($collections as $col)
                                        <li><a class="dropdown-item rounded-3 py-2" href="javascript:void(0)" onclick="document.getElementById('button_link_input').value = '{{ route('collections.show', $col->slug) }}'"><i class="bi bi-gem me-2 text-primary"></i> {{ $col->title }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5">
                        <button type="submit" class="btn btn-premium fs-5">
                            <i class="bi bi-stars me-2"></i> Synchronize Brand Narrative
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Sidebar Preview -->
        <div class="col-xl-5 col-lg-6 fade-in-up" style="animation-delay: 0.3s;">
            <div class="preview-pane">
                <div class="preview-header">
                    <span class="text-uppercase small fw-bold letter-spacing-2 opacity-50"><i class="bi bi-phone"></i> Live View</span>
                    <i class="bi bi-broadcast text-success animate-pulse"></i>
                </div>
                <div class="preview-body">
                    <img id="prev-image" class="preview-image" src="{{ str_starts_with($story->image, 'http') ? $story->image : asset('storage/' . $story->image) }}" onerror="this.src='{{ asset($story->image) }}'">
                    <span id="prev-subtitle" class="preview-subtitle">{{ $story->subtitle }}</span>
                    <h2 id="prev-title" class="preview-title">{{ $story->title }}</h2>
                    <p id="prev-content" class="preview-content">{{ Str::limit($story->content, 120) }}</p>
                    
                    <div class="preview-stats">
                        <div class="preview-stat-item">
                            <h3 id="prev-stat1-num">{{ $story->stat_1_num }}</h3>
                            <span id="prev-stat1-label">{{ $story->stat_1_label }}</span>
                        </div>
                        <div class="preview-stat-item">
                            <h3 id="prev-stat2-num">{{ $story->stat_2_num }}</h3>
                            <span id="prev-stat2-label">{{ $story->stat_2_label }}</span>
                        </div>
                    </div>

                    <a href="javascript:void(0)" id="prev-btn" class="preview-btn">{{ $story->button_text }}</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Real-time Preview Sync
        function syncPreview() {
            document.getElementById('prev-subtitle').innerText = document.querySelector('input[name="subtitle"]').value;
            document.getElementById('prev-title').innerText = document.querySelector('input[name="title"]').value;
            document.getElementById('prev-content').innerText = document.querySelector('textarea[name="content"]').value;
            document.getElementById('prev-stat1-num').innerText = document.querySelector('input[name="stat_1_num"]').value;
            document.getElementById('prev-stat1-label').innerText = document.querySelector('input[name="stat_1_label"]').value;
            document.getElementById('prev-stat2-num').innerText = document.querySelector('input[name="stat_2_num"]').value;
            document.getElementById('prev-stat2-label').innerText = document.querySelector('input[name="stat_2_label"]').value;
            document.getElementById('prev-btn').innerText = document.querySelector('input[name="button_text"]').value;

            const urlInput = document.querySelector('input[name="image"]').value;
            if(urlInput && urlInput.length > 5 && !document.getElementById('image_file').files.length) {
                document.getElementById('prev-image').src = urlInput;
                document.getElementById('asset-preview-thumb').src = urlInput;
            }
        }

        document.querySelectorAll('input, textarea').forEach(el => {
            el.addEventListener('input', syncPreview);
        });

        // Image Preview Handler
        function previewAsset(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('prev-image').src = e.target.result;
                    document.getElementById('asset-preview-thumb').src = e.target.result;
                    document.getElementById('asset-filename').innerText = input.files[0].name;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection