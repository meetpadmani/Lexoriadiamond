@extends('admin.layout')

@section('title', 'Video Studio | Watch & Shop Curation')

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

    /* Stats Cards Premium */
    .stat-card-premium {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: 0 8px 20px rgba(0,0,0,0.02);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .stat-card-premium:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.05);
    }
    .icon-bg-glow {
        width: 56px; height: 56px;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem;
    }

    /* Premium Buttons */
    .btn-premium {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        color: #fff;
        padding: 14px 35px;
        border-radius: 30px;
        font-weight: 700;
        letter-spacing: 1px;
        transition: all 0.3s ease;
    }
    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(13, 110, 253, 0.4);
        background: linear-gradient(135deg, #0b5ed7 0%, #094eb3 100%);
        color: #fff;
    }

    /* Studio Grid & Reel Cards */
    .studio-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }
    .reel-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
    }
    .reel-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    }
    .reel-preview-wrapper {
        position: relative;
        aspect-ratio: 9/16;
        background: #000;
        overflow: hidden;
    }
    .reel-static-thumb {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.8;
        transition: opacity 0.5s ease;
        position: absolute;
        top: 0; left: 0;
        z-index: 1;
    }
    .reel-video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0; left: 0;
        z-index: 2;
        opacity: 0;
        transition: opacity 0.5s ease;
    }
    .reel-preview-wrapper:hover .reel-video {
        opacity: 1;
    }
    .reel-preview-wrapper:hover .reel-static-thumb {
        opacity: 0;
    }
    .reel-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 6px 15px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        z-index: 10;
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        backdrop-filter: blur(5px);
    }
    .reel-badge.active { background: rgba(25, 135, 84, 0.9); color: white; }
    .reel-badge.inactive { background: rgba(108, 117, 125, 0.9); color: white; }

    /* Floating Actions */
    .reel-actions-floating {
        position: absolute;
        top: 15px;
        right: 15px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        z-index: 10;
        opacity: 0;
        transform: translateX(20px);
        transition: all 0.3s ease;
    }
    .reel-card:hover .reel-actions-floating {
        opacity: 1;
        transform: translateX(0);
    }
    .floating-btn {
        width: 40px; height: 40px;
        border-radius: 50%;
        background: rgba(255,255,255,0.9);
        color: #495057;
        display: flex; align-items: center; justify-content: center;
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        backdrop-filter: blur(5px);
        transition: all 0.2s ease;
    }
    .floating-btn:hover {
        background: #0d6efd;
        color: white;
        transform: scale(1.1);
    }
    .floating-btn.delete:hover {
        background: #dc3545;
    }

    /* Reel Info Box */
    .reel-info-box {
        padding: 1.5rem;
    }
    .reel-title {
        font-size: 1.1rem;
        font-weight: 800;
        color: #212529;
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .reel-views {
        font-size: 0.8rem;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 5px;
        font-weight: 600;
    }
    .reel-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #f8f9fa;
    }
    .reel-price {
        font-size: 1.1rem;
        font-weight: 800;
        color: #198754;
    }

    /* Form & Modal Styling */
    .modal-content {
        border-radius: 24px;
        border: none;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    .modal-header {
        border-bottom: 1px solid #f8f9fa;
        padding: 1.5rem 2rem;
    }
    .form-control, .form-select, .form-control-studio {
        border-radius: 12px;
        padding: 12px 15px;
        border: 1px solid #e9ecef;
        background-color: #f8f9fa;
        width: 100%;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }
    .form-control:focus, .form-select:focus, .form-control-studio:focus {
        background-color: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        outline: none;
    }
    .form-label-studio {
        font-weight: 700;
        color: #495057;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* Upload Zone */
    .upload-master-zone {
        border: 2px dashed #dee2e6;
        border-radius: 16px;
        padding: 2rem 1rem;
        text-align: center;
        background: #f8f9fa;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .upload-master-zone:hover {
        border-color: #0d6efd;
        background: #f1f8ff;
    }
    .upload-master-zone i {
        font-size: 2rem;
        color: #adb5bd;
        margin-bottom: 10px;
        display: block;
        transition: color 0.3s ease;
    }
    .upload-master-zone:hover i {
        color: #0d6efd;
    }

    .studio-progress {
        height: 6px;
        background: #e9ecef;
        border-radius: 10px;
        margin-top: 15px;
        overflow: hidden;
        display: none;
    }
    .studio-progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #0d6efd, #0dcaf0);
        width: 0%;
        transition: width 0.3s ease;
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
                    <i class="bi bi-camera-reels-fill" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="font-family: 'Playfair Display', serif; letter-spacing: -0.5px;">Video Studio Curation</h2>
                    <p class="text-secondary mb-0 fs-6">Manage cinematic vertical reels for your "Watch & Shop" experience.</p>
                </div>
            </div>
            <button type="button" class="btn btn-premium d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#videoProductModal" onclick="openCreateModal()">
                <i class="bi bi-plus-circle-fill"></i> Generate Boutique Reel
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-4 bg-success-subtle text-success fade-in-up" style="animation-delay: 0.1s;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <!-- Quick Stats -->
    <div class="row g-4 mb-5 fade-in-up" style="animation-delay: 0.2s;">
        <div class="col-md-4">
            <div class="stat-card-premium p-4" style="border-bottom: 4px solid #0d6efd;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-secondary small text-uppercase fw-bold mb-2" style="letter-spacing: 1px;">Total Reels</div>
                        <h2 class="mb-0 fw-bolder text-dark">{{ $videoProducts->count() }}</h2>
                    </div>
                    <div class="icon-bg-glow bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-camera-reels fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card-premium p-4" style="border-bottom: 4px solid #198754;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-secondary small text-uppercase fw-bold mb-2" style="letter-spacing: 1px;">Live Stories</div>
                        <h2 class="mb-0 fw-bolder text-dark">{{ $videoProducts->where('is_active', 1)->count() }}</h2>
                    </div>
                    <div class="icon-bg-glow bg-success bg-opacity-10 text-success">
                        <i class="bi bi-broadcast fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card-premium p-4" style="border-bottom: 4px solid #6f42c1;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-secondary small text-uppercase fw-bold mb-2" style="letter-spacing: 1px;">Total Reach</div>
                        <h2 class="mb-0 fw-bolder text-dark">
                            @php 
                                $totalViews = 0;
                                foreach($videoProducts as $v) {
                                    $num = (int)preg_replace('/[^0-9]/', '', $v->views);
                                    $totalViews += $num;
                                }
                                echo $totalViews > 999 ? round($totalViews/1000, 1) . 'K+' : $totalViews;
                            @endphp
                        </h2>
                    </div>
                    <div class="icon-bg-glow" style="background: rgba(111, 66, 193, 0.1); color: #6f42c1;">
                        <i class="bi bi-eye-fill fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="studio-grid fade-in-up" style="animation-delay: 0.3s;">
        @php
            if (!function_exists('getMediaUrl')) {
                function getMediaUrl($path) {
                    if (!$path) return '';
                    if (str_starts_with($path, 'http')) return $path;
                    if (str_starts_with($path, 'storage/')) return asset($path);
                    return Storage::disk('public')->url($path);
                }
            }
        @endphp
        @forelse($videoProducts as $item)
            <div class="reel-card">
                <div class="reel-preview-wrapper">
                    <video class="reel-video-live" autoplay loop muted playsinline preload="auto" 
                           src="{{ getMediaUrl($item->video_path) }}" style="width: 100%; height: 100%; object-fit: cover;"></video>
                    
                    <div class="reel-badge {{ $item->is_active ? 'active' : 'inactive' }}">
                        <i class="bi {{ $item->is_active ? 'bi-broadcast' : 'bi-pause-circle' }} me-1"></i> {{ $item->is_active ? 'Live' : 'Draft' }}
                    </div>

                    <div class="reel-actions-floating">
                        <a href="javascript:void(0)" class="floating-btn" onclick="openEditModal(this)"
                           data-id="{{ $item->id }}" 
                           data-name="{{ $item->product_name }}"
                           data-description="{{ $item->description }}"
                           data-current_price="{{ $item->current_price }}"
                           data-original_price="{{ $item->original_price }}" 
                           data-metal_type="{{ $item->metal_type }}"
                           data-metal_purity="{{ $item->metal_purity }}"
                           data-weight="{{ $item->weight }}"
                           data-sku="{{ $item->sku }}"
                           data-views="{{ $item->views }}"
                           data-order="{{ $item->order }}" 
                           data-is_active="{{ $item->is_active }}"
                           data-thumb="{{ getMediaUrl($item->product_image) }}"
                           data-image2="{{ getMediaUrl($item->image2) }}"
                           data-image3="{{ getMediaUrl($item->image3) }}"
                           data-image4="{{ getMediaUrl($item->image4) }}"
                           data-image5="{{ getMediaUrl($item->image5) }}"
                           data-image6="{{ getMediaUrl($item->image6) }}"
                           title="Edit Design">
                            <i class="bi bi-pencil-fill"></i>
                        </a>

                        <a href="javascript:void(0)" class="floating-btn delete" 
                           onclick="confirmDelete('{{ route('admin.video-products.destroy', $item->id) }}')"
                           title="Permanently Remove">
                            <i class="bi bi-trash3-fill"></i>
                        </a>
                    </div>
                </div>

                <div class="reel-info-box">
                    <div>
                        <div class="reel-title">{{ $item->product_name ?? 'Lexoria Reel #' . $item->id }}</div>
                        <div class="reel-views">
                            <i class="bi bi-play-circle-fill text-primary"></i> {{ $item->views }} views <span class="mx-1">•</span> Seq: #{{ $item->order }}
                        </div>
                    </div>
                    <div class="reel-meta">
                        <span class="reel-price">
                            @if($item->current_price) 
                                ${{ number_format($item->current_price) }} 
                            @else 
                                <span class="badge bg-light text-secondary border">Not priced</span> 
                            @endif
                        </span>
                        <div class="form-check form-switch m-0 fs-5" title="Toggle Visibility">
                            <input class="form-check-input" type="checkbox" onchange="window.location.href='{{ route('admin.video-products.toggleStatus', $item->id) }}'" {{ $item->is_active ? 'checked' : '' }} style="cursor: pointer;">
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 py-5 text-center fade-in-up">
                <div class="mb-4">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 100px; height: 100px;">
                        <i class="bi bi-camera-reels text-secondary" style="font-size: 3rem; opacity: 0.5;"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark font-playfair">Your Studio is Empty</h4>
                <p class="text-secondary mx-auto mb-4" style="max-width: 450px;">Bring your jewelry to life with cinematic vertical reels. Upload your first masterpiece to begin the 'Watch & Shop' experience.</p>
                <button class="btn btn-premium px-5" onclick="openCreateModal()" data-bs-toggle="modal" data-bs-target="#videoProductModal">
                    Generate First Reel
                </button>
            </div>
        @endforelse
    </div>

@endsection

@section('modals')
    <!-- Create/Edit Modal -->
    <div class="modal fade" id="videoProductModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <div>
                        <h4 class="m-0 fw-bolder text-dark" id="videoProductModalLabel"><i class="bi bi-stars text-primary me-2"></i> Generate Boutique Reel</h4>
                        <p class="m-0 small text-secondary mt-1 fw-bold text-uppercase" style="letter-spacing: 1px;">Cinematic Vertical Content</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 p-lg-5">
                    <form id="videoProductForm" action="{{ route('admin.video-products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="methodField"></div>
                        <input type="hidden" name="chunked_video_path" id="chunked_video_path">

                        <div class="row g-5">
                            <!-- Visual Assets Column -->
                            <div class="col-lg-4">
                                <div class="bg-light p-4 rounded-4 border h-100">
                                    <div class="mb-4">
                                        <label class="form-label-studio"><i class="bi bi-camera-video me-1"></i> Step 1: Cinematic Video <span class="text-danger">*</span></label>
                                        <div id="videoBrowseBtn" class="upload-master-zone bg-white shadow-sm mt-2">
                                            <i class="bi bi-cloud-arrow-up text-primary"></i>
                                            <p class="m-0 fw-bold text-dark mt-2">Select Video File</p>
                                            <div id="videoFileName" class="mt-2 small text-truncate text-primary px-3 fw-bold"></div>
                                            
                                            <div class="studio-progress" id="upload-progress-container">
                                                <div class="studio-progress-bar" id="upload-progress-bar"></div>
                                            </div>
                                        </div>
                                        <div id="upload-status-text" class="mt-3 text-center small fw-bold px-2 py-1 rounded bg-white shadow-sm d-none"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Context Details Column -->
                            <div class="col-lg-8">
                                <div class="row g-4">
                                    <div class="col-12">
                                        <label class="form-label-studio">Product Identity</label>
                                        <input type="text" name="product_name" id="form-name" class="form-control-studio form-control-lg fw-bold" placeholder="e.g. Victorian Diamond Droplets">
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label-studio">Deep Narrative (Description)</label>
                                        <textarea name="description" id="form-description" class="form-control-studio" rows="4" placeholder="Tell the story of this piece..."></textarea>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label-studio">Gallery Additions (Up to 5 images)</label>
                                        <div class="d-flex gap-3 overflow-auto pb-2">
                                            @for($i=2; $i<=6; $i++)
                                                <div class="flex-shrink-0" style="width: 90px;">
                                                    <div class="upload-master-zone bg-light p-2 shadow-sm" onclick="document.getElementById('form-image{{ $i }}').click()" style="height: 90px; border-radius: 12px;">
                                                        <i class="bi bi-plus-lg m-0" style="font-size: 1.2rem; line-height: 70px;"></i>
                                                        <img id="imagePreview{{ $i }}" src="" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px; display: none;">
                                                    </div>
                                                    <input type="file" accept="image/*" name="image{{ $i }}" id="form-image{{ $i }}" class="d-none" onchange="previewMiniThumb(this, {{ $i }})">
                                                </div>
                                            @endfor
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-studio text-success">Premium Value ($)</label>
                                        <input type="number" name="current_price" id="form-current_price" class="form-control-studio fw-bold text-success" placeholder="0.00">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-studio">Market Value (MRP)</label>
                                        <input type="number" name="original_price" id="form-original_price" class="form-control-studio" placeholder="Optional">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-studio">Metal Type</label>
                                        <input type="text" name="metal_type" id="form-metal_type" class="form-control-studio" placeholder="e.g. 18KT Gold">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-studio">Metal Purity</label>
                                        <input type="text" name="metal_purity" id="form-metal_purity" class="form-control-studio" placeholder="e.g. Hallmarked">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-studio">Gross Weight (g)</label>
                                        <input type="text" name="weight" id="form-weight" class="form-control-studio" placeholder="e.g. 12.5">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-studio">Boutique SKU</label>
                                        <input type="text" name="sku" id="form-sku" class="form-control-studio" placeholder="BD-001">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label-studio">Initial Views</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-eye"></i></span>
                                            <input type="text" name="views" id="form-views" class="form-control-studio border-start-0 ps-0" value="0">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label-studio">Studio Sequence Priority</label>
                                        <input type="number" name="order" id="form-order" class="form-control-studio" value="0">
                                    </div>

                                    <div class="col-12 mt-2">
                                        <div class="d-flex align-items-center justify-content-between bg-white p-3 rounded-4 border shadow-sm">
                                            <div>
                                                <div class="fw-bold text-dark mb-1"><i class="bi bi-broadcast text-success me-2"></i> Website Publication</div>
                                                <div class="x-small text-muted">Instantly stream this reel in the 'Watch & Shop' section</div>
                                            </div>
                                            <div class="form-check form-switch fs-4 m-0">
                                                <input class="form-check-input" type="checkbox" name="is_active" id="form-is_active" checked style="cursor: pointer;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end gap-3">
                            <button type="button" class="btn btn-light px-4 border rounded-pill fw-bold" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-premium px-5" id="submitBtn">Synchronize to Studio</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>
    <script>
        let resumable = new Resumable({
            target: "{{ route('admin.upload.video.chunk') }}",
            query: { _token: "{{ csrf_token() }}" },
            fileType: ['mp4', 'mov', 'avi', 'wmv'],
            chunkSize: 1 * 1024 * 1024,
            headers: { 'Accept': 'application/json' },
            testChunks: false,
        });

        const browseBtn = document.getElementById('videoBrowseBtn');
        const fileNameEl = document.getElementById('videoFileName');
        const progressBar = document.getElementById('upload-progress-bar');
        const progressContainer = document.getElementById('upload-progress-container');
        const statusText = document.getElementById('upload-status-text');
        const chunkedInput = document.getElementById('chunked_video_path');
        const submitBtn = document.getElementById('submitBtn');
        const form = document.getElementById('videoProductForm');

        resumable.assignBrowse(browseBtn);

        resumable.on('fileAdded', function (file) {
            fileNameEl.innerText = file.fileName;
            progressContainer.style.display = 'block';
            submitBtn.disabled = true;
            statusText.classList.remove('d-none');
            statusText.innerText = "UPLOADING REEL...";
            statusText.style.color = "#0d6efd";
            browseBtn.style.borderColor = "#0d6efd";
            resumable.upload();
        });

        resumable.on('fileProgress', function (file) {
            let progress = Math.floor(file.progress() * 100);
            progressBar.style.width = progress + '%';
        });

        resumable.on('fileSuccess', function (file, message) {
            let res = JSON.parse(message);
            chunkedInput.value = res.path;
            statusText.innerText = "STAGED FOR STUDIO";
            statusText.style.color = "#198754";
            submitBtn.disabled = false;
            progressBar.style.background = "#198754";
        });

        resumable.on('fileError', function (file, message) {
            statusText.innerText = "UPLOAD FAILED";
            statusText.style.color = "#dc3545";
            submitBtn.disabled = false;
        });



        function previewMiniThumb(input, index) {
            const preview = document.getElementById('imagePreview' + index);
            const parent = preview.parentElement;
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    parent.querySelector('i').style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function openCreateModal() {
            form.reset();
            form.action = "{{ route('admin.video-products.store') }}";
            document.getElementById('videoProductModalLabel').innerHTML = '<i class="bi bi-stars text-primary me-2"></i> Generate Boutique Reel';
            document.getElementById('methodField').innerHTML = "";
            for(let i=2; i<=6; i++) {
                document.getElementById('imagePreview' + i).style.display = 'none';
                document.getElementById('imagePreview' + i).parentElement.querySelector('i').style.display = 'block';
            }
            progressContainer.style.display = 'none';
            statusText.innerText = "";
            statusText.classList.add('d-none');
            fileNameEl.innerText = "";
            chunkedInput.value = "";
            submitBtn.disabled = false;
            submitBtn.innerText = "Synchronize to Studio";
            progressBar.style.width = '0%';
            browseBtn.style.borderColor = '#dee2e6';
        }

        function openEditModal(btn) {
            const d = btn.dataset;
            form.reset();
            form.action = "{{ url('admin/video-products') }}/" + d.id + "/update";
            document.getElementById('videoProductModalLabel').innerHTML = '<i class="bi bi-pencil-fill text-primary me-2"></i> Refine Reel Master';
            document.getElementById('methodField').innerHTML = "";
            submitBtn.innerText = "Update Reel Asset";
            
            document.getElementById('form-name').value = d.name === 'null' ? '' : d.name;
            document.getElementById('form-description').value = d.description === 'null' ? '' : d.description;
            document.getElementById('form-current_price').value = d.current_price === 'null' ? '' : d.current_price;
            document.getElementById('form-original_price').value = d.original_price === 'null' ? '' : d.original_price;
            document.getElementById('form-metal_type').value = d.metal_type === 'null' ? '' : d.metal_type;
            document.getElementById('form-metal_purity').value = d.metal_purity === 'null' ? '' : d.metal_purity;
            document.getElementById('form-weight').value = d.weight === 'null' ? '' : d.weight;
            document.getElementById('form-sku').value = d.sku === 'null' ? '' : d.sku;
            document.getElementById('form-views').value = d.views;
            document.getElementById('form-order').value = d.order;
            document.getElementById('form-is_active').checked = d.is_active == 1;



            for(let i=2; i<=6; i++) {
                const thumb = d['image' + i];
                if(thumb && thumb !== '') {
                    document.getElementById('imagePreview' + i).src = thumb;
                    document.getElementById('imagePreview' + i).style.display = 'block';
                    document.getElementById('imagePreview' + i).parentElement.querySelector('i').style.display = 'none';
                } else {
                    document.getElementById('imagePreview' + i).style.display = 'none';
                    document.getElementById('imagePreview' + i).parentElement.querySelector('i').style.display = 'block';
                }
            }

            progressContainer.style.display = 'none';
            statusText.classList.remove('d-none');
            statusText.innerText = "EXISTING VIDEO RETAINED (CLICK TO REPLACE)";
            statusText.style.color = "#6c757d";
            fileNameEl.innerText = "";
            chunkedInput.value = "";
            submitBtn.disabled = false;
            browseBtn.style.borderColor = '#dee2e6';

            new bootstrap.Modal(document.getElementById('videoProductModal')).show();
        }

        function confirmDelete(url) {
            Swal.fire({
                title: 'Delete from Studio?',
                text: "This cinematic asset will be permanently removed.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, remove it',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const f = document.createElement('form');
                    f.method = 'POST'; f.action = url;
                    const t = document.createElement('input');
                    t.type = 'hidden'; t.name = '_token'; t.value = '{{ csrf_token() }}';
                    f.appendChild(t);
                    document.body.appendChild(f);
                    f.submit();
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function() {
            // Force play on all videos to bypass browser autoplay restrictions if possible
            const videos = document.querySelectorAll('.reel-video-live');
            videos.forEach(video => {
                video.play().catch(e => {
                    console.log("Autoplay prevented by browser: ", e);
                });
            });
        });
    </script>
@endsection