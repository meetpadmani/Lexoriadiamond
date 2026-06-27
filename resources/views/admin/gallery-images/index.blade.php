@extends('admin.layout')

@section('title', 'Heritage Image Gallery')

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

    /* Gallery Grid */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }
    .gallery-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
    }
    .gallery-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    }
    .gallery-preview-wrapper {
        position: relative;
        aspect-ratio: 1/1;
        background: #f8f9fa;
        overflow: hidden;
    }
    .gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .gallery-card:hover .gallery-img {
        transform: scale(1.05);
    }

    .gallery-badge {
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
    .gallery-badge.active { background: rgba(25, 135, 84, 0.9); color: white; }
    .gallery-badge.inactive { background: rgba(108, 117, 125, 0.9); color: white; }

    /* Floating Actions */
    .gallery-actions-floating {
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
    .gallery-card:hover .gallery-actions-floating {
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
        border: none;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        backdrop-filter: blur(5px);
        transition: all 0.2s ease;
        padding: 0;
    }
    .floating-btn:hover {
        background: #0d6efd;
        color: white;
        transform: scale(1.1);
    }
    .floating-btn.delete:hover {
        background: #dc3545;
        color: white;
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
    .form-control-studio {
        border-radius: 12px;
        padding: 12px 15px;
        border: 1px solid #e9ecef;
        background-color: #f8f9fa;
        width: 100%;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }
    .form-control-studio:focus {
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
                    <i class="bi bi-images" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="font-family: 'Playfair Display', serif; letter-spacing: -0.5px;">Heritage Image Gallery</h2>
                    <p class="text-secondary mb-0 fs-6">Manage high-resolution assets for your visual gallery.</p>
                </div>
            </div>
            <button type="button" class="btn btn-premium d-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#galleryImageModal">
                <i class="bi bi-plus-circle-fill"></i> Upload Masterpiece
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
        <div class="col-md-6">
            <div class="stat-card-premium p-4" style="border-bottom: 4px solid #0d6efd;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-secondary small text-uppercase fw-bold mb-2" style="letter-spacing: 1px;">Total Assets</div>
                        <h2 class="mb-0 fw-bolder text-dark">{{ $galleryImages->count() }}</h2>
                    </div>
                    <div class="icon-bg-glow bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-images fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stat-card-premium p-4" style="border-bottom: 4px solid #198754;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <div class="text-secondary small text-uppercase fw-bold mb-2" style="letter-spacing: 1px;">Live in Gallery</div>
                        <h2 class="mb-0 fw-bolder text-dark">{{ $galleryImages->where('is_active', 1)->count() }}</h2>
                    </div>
                    <div class="icon-bg-glow bg-success bg-opacity-10 text-success">
                        <i class="bi bi-globe fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="gallery-grid fade-in-up" style="animation-delay: 0.3s;">
        @forelse($galleryImages as $item)
            <div class="gallery-card">
                <div class="gallery-preview-wrapper">
                    <img src="{{ asset('storage/' . $item->image_path) }}" class="gallery-img" alt="Gallery Image"
                         onerror="this.src='{{ asset($item->image_path) }}'">
                    
                    <div class="gallery-badge {{ $item->is_active ? 'active' : 'inactive' }}">
                        <i class="bi {{ $item->is_active ? 'bi-eye-fill' : 'bi-eye-slash-fill' }} me-1"></i> {{ $item->is_active ? 'Live' : 'Hidden' }}
                    </div>

                    <div class="gallery-actions-floating">
                        <form action="{{ route('admin.gallery-images.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Permanently delete this image?');" class="d-inline">
                            @csrf
                            <button type="submit" class="floating-btn delete" title="Permanently Remove">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="p-4 bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small fw-bold text-uppercase letter-spacing-1">Sequence</span>
                        <div class="fw-bolder text-dark fs-5">#{{ $item->order }}</div>
                    </div>
                    <div class="form-check form-switch m-0 fs-4" title="Visibility Status">
                        <input class="form-check-input" type="checkbox" {{ $item->is_active ? 'checked' : '' }} disabled>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 py-5 text-center fade-in-up">
                <div class="mb-4">
                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 100px; height: 100px;">
                        <i class="bi bi-images text-secondary" style="font-size: 3rem; opacity: 0.5;"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark font-playfair">Your Gallery is Empty</h4>
                <p class="text-secondary mx-auto mb-4" style="max-width: 450px;">Upload breathtaking images to feature in the 'Heritage Collection' section of your store.</p>
                <button class="btn btn-premium px-5" data-bs-toggle="modal" data-bs-target="#galleryImageModal">
                    Upload First Asset
                </button>
            </div>
        @endforelse
    </div>

@endsection

@section('modals')
    <!-- Create Modal -->
    <div class="modal fade" id="galleryImageModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <div>
                        <h4 class="m-0 fw-bolder text-dark"><i class="bi bi-stars text-primary me-2"></i> Upload Masterpiece</h4>
                        <p class="m-0 small text-secondary mt-1 fw-bold text-uppercase" style="letter-spacing: 1px;">Static Visual Asset</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4 p-lg-5">
                    <form action="{{ route('admin.gallery-images.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row g-4">
                            <div class="col-md-7">
                                <label class="form-label-studio"><i class="bi bi-image me-1"></i> Visual Asset <span class="text-danger">*</span></label>
                                <div class="upload-master-zone position-relative overflow-hidden" onclick="document.getElementById('form-image').click()" style="padding: 2rem;">
                                    <div id="image-placeholder" class="py-5">
                                        <i class="bi bi-cloud-arrow-up text-primary" style="font-size: 3rem;"></i>
                                        <p class="m-0 fw-bold text-dark mt-3">Select Image File</p>
                                        <p class="m-0 mt-1 small text-muted">JPEG, PNG, WEBP (Max 10MB)</p>
                                    </div>
                                    <img id="imagePreview" src="" style="width: 100%; aspect-ratio: 1/1; object-fit: cover; border-radius: 12px; display: none;">
                                </div>
                                <input type="file" name="image_file" id="form-image" class="d-none" accept="image/jpeg,image/png,image/jpg,image/webp" required onchange="previewThumbnail(this)">
                            </div>
                            
                            <div class="col-md-5">
                                <div class="bg-light p-4 rounded-4 border h-100">
                                    <div class="mb-4">
                                        <label class="form-label-studio">Display Sequence Priority</label>
                                        <input type="number" name="order" class="form-control-studio fw-bold" value="0">
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between bg-white p-3 rounded-4 border shadow-sm">
                                        <div>
                                            <div class="fw-bold text-dark mb-1"><i class="bi bi-globe text-success me-2"></i> Public Store</div>
                                            <div class="x-small text-muted">Live in Heritage Gallery</div>
                                        </div>
                                        <div class="form-check form-switch fs-4 m-0">
                                            <input class="form-check-input" type="checkbox" name="is_active" id="form-is_active" checked style="cursor: pointer;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-end gap-3">
                            <button type="button" class="btn btn-light px-4 border rounded-pill fw-bold" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-premium px-5">Publish to Gallery</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function previewThumbnail(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                    document.getElementById('image-placeholder').style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
