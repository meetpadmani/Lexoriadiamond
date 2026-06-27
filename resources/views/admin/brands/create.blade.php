@extends('admin.layout')

@section('title', 'Register Brand Partner')

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
        width: 120px;
        height: 120px;
        object-fit: contain;
        background: #fff;
        border-radius: 12px;
        padding: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
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
                    <i class="bi bi-patch-plus-fill" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="font-family: 'Playfair Display', serif; letter-spacing: -0.5px;">Register Brand Partner</h2>
                    <p class="text-secondary mb-0 fs-6">Add a new authorized brand to your storefront.</p>
                </div>
            </div>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-premium d-flex align-items-center gap-2">
                <i class="bi bi-arrow-left"></i> Back to Brand Partners
            </a>
        </div>
    </div>

    <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row justify-content-center">
            <div class="col-lg-8 fade-in-up" style="animation-delay: 0.1s;">
                
                <div class="premium-panel">
                    <div class="panel-header">
                        <div class="panel-icon"><i class="bi bi-building"></i></div>
                        <h3 class="panel-title">Brand Information</h3>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label-studio">Brand Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control-studio fw-bold" placeholder="Enter brand name" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label-studio">Brand Description</label>
                        <textarea name="description" class="form-control-studio" rows="4" placeholder="Briefly describe the brand partner..."></textarea>
                    </div>
                </div>

                <div class="premium-panel fade-in-up" style="animation-delay: 0.2s;">
                    <div class="panel-header">
                        <div class="panel-icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-image-fill"></i></div>
                        <h3 class="panel-title">Brand Identity Asset</h3>
                    </div>
                    
                    <div class="visual-asset-box mb-4" onclick="document.getElementById('logoInput').click()">
                        <img src="https://placehold.co/300x150/f8f9fa/adb5bd?text=No+Logo" id="logoPreview">
                        <div class="visual-asset-text">
                            <h6>Upload Brand Logo</h6>
                            <p id="fileNameDisplay">Recommended size: 300x150px (PNG or SVG preferred)</p>
                        </div>
                    </div>
                    <input type="file" name="logo" id="logoInput" class="d-none" accept="image/*">
                </div>

                <div class="premium-panel bg-light border-0 fade-in-up" style="animation-delay: 0.3s;">
                    <div class="panel-header border-bottom-0 pb-0">
                        <div class="panel-icon bg-success bg-opacity-10 text-success"><i class="bi bi-gear-fill"></i></div>
                        <h3 class="panel-title">Settings</h3>
                    </div>

                    <div class="row g-4 mt-1">
                        <div class="col-md-6">
                            <label class="form-label-studio">Display Order</label>
                            <input type="number" name="order" class="form-control-studio bg-white" value="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label-studio">Active Status</label>
                            <div class="d-flex align-items-center justify-content-between p-3 rounded-3 bg-white border">
                                <div>
                                    <div class="fw-bold"><i class="bi bi-globe me-2 text-primary"></i> Visible on Store</div>
                                </div>
                                <div class="form-check form-switch fs-4 m-0">
                                    <input class="form-check-input" type="checkbox" name="is_active" checked style="cursor: pointer;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 text-end">
                        <button type="submit" class="btn btn-premium px-5 w-100 fs-5">
                            <i class="bi bi-cloud-arrow-up-fill me-2"></i> Register Brand Partner
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </form>

@endsection

@section('scripts')
<script>
    // Image Preview Logic
    document.getElementById('logoInput').addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('logoPreview').src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
            document.getElementById('fileNameDisplay').innerText = this.files[0].name;
            document.getElementById('fileNameDisplay').classList.add('text-primary', 'fw-bold');
        }
    });
</script>
@endsection
