@extends('admin.layout')

@section('title', isset($product) ? 'Edit Masterpiece' : 'Add New Masterpiece')

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

    /* Premium Form Card */
    .premium-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 40px rgba(0,0,0,0.03);
        overflow: hidden;
    }

    /* Section Styling */
    .section-title {
        font-size: 0.9rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #495057;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .section-title::after {
        content: '';
        flex-grow: 1;
        height: 1px;
        background: linear-gradient(to right, #e9ecef, transparent);
    }
    .section-icon {
        width: 38px; height: 38px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem;
    }

    /* Form Elements */
    .form-control, .form-select, .input-group-text {
        border-radius: 14px;
        padding: 14px 20px;
        border: 1px solid #e9ecef;
        background-color: #f8f9fa;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }
    .form-control:focus, .form-select:focus {
        background-color: #fff;
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }
    .form-label {
        font-weight: 700;
        color: #495057;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }
    
    /* Product Type Radio Cards */
    .type-radio-card {
        position: relative;
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 20px;
        border: 2px solid #e9ecef;
        border-radius: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fff;
        height: 100%;
    }
    .type-radio-card:hover {
        border-color: #0d6efd;
        background: #f8fbff;
        transform: translateY(-2px);
    }
    .form-check-input:checked + .type-radio-card {
        border-color: #0d6efd;
        background: #f0f7ff;
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.1);
    }
    .type-radio-card .icon-wrapper {
        width: 48px; height: 48px;
        border-radius: 50%;
        background: #f8f9fa;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.5rem; color: #6c757d;
        transition: all 0.3s ease;
    }
    .form-check-input:checked + .type-radio-card .icon-wrapper {
        background: #0d6efd;
        color: #fff;
    }

    /* Image Upload Area */
    .main-image-upload {
        border: 2px dashed #dee2e6;
        border-radius: 20px;
        height: 350px;
        position: relative;
        overflow: hidden;
        background: #f8f9fa;
        transition: all 0.3s ease;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
    }
    .main-image-upload:hover {
        border-color: #0d6efd;
        background: #f1f8ff;
    }
    .main-image-upload img {
        width: 100%; height: 100%;
        object-fit: contain;
        position: absolute; top: 0; left: 0;
        z-index: 1;
    }
    .upload-overlay {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(255,255,255,0.8);
        z-index: 2;
        display: flex; flex-direction: column; align-items: center; justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .main-image-upload:hover .upload-overlay {
        opacity: 1;
    }

    /* Gallery Uploads */
    .gallery-upload {
        border: 2px dashed #dee2e6;
        border-radius: 16px;
        height: 120px;
        position: relative;
        overflow: hidden;
        background: #f8f9fa;
        transition: all 0.3s ease;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
    }
    .gallery-upload:hover {
        border-color: #0d6efd;
    }
    .gallery-upload img {
        width: 100%; height: 100%;
        object-fit: cover;
        position: absolute; top: 0; left: 0;
        z-index: 1;
    }

    /* Sticky Bottom Bar */
    .sticky-action-bar {
        position: sticky;
        bottom: 2rem;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(0,0,0,0.05);
        border-radius: 20px;
        padding: 1rem 2rem;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        z-index: 100;
        margin-top: 3rem;
    }

    /* Buttons */
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

    /* Animation */
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
        <div class="d-flex align-items-center gap-4">
            <div class="bg-dark text-white p-4 rounded-4 d-flex align-items-center justify-content-center shadow-lg">
                <i class="bi bi-gem" style="font-size: 2.5rem;"></i>
            </div>
            <div>
                <h2 class="fw-bolder text-dark mb-1" style="font-family: 'Playfair Display', serif; letter-spacing: -0.5px;">{{ isset($product) ? 'Edit Masterpiece' : 'Add New Masterpiece' }}</h2>
                <p class="text-secondary mb-0 fs-6">Configure product details, pricing, visuals, and SEO settings.</p>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-4 border-0 shadow-sm fade-in-up mb-4" style="animation-delay: 0.1s;">
            <div class="d-flex align-items-center gap-2 mb-2 fw-bold"><i class="bi bi-exclamation-triangle-fill"></i> Please fix the following errors:</div>
            <ul class="mb-0 small">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row g-4">
            <!-- Left Column: Main Details -->
            <div class="col-xl-8 fade-in-up" style="animation-delay: 0.2s;">
                <div class="premium-card p-4 p-md-5 mb-4">
                    
                    <!-- Section I: Basic Info -->
                    <div class="section-title">
                        <div class="section-icon bg-primary bg-opacity-10 text-primary"><i class="bi bi-info-circle-fill"></i></div>
                        I. Primary Information
                    </div>
                    
                    <div class="row g-4 mb-5">
                        <div class="col-12">
                            <label class="form-label">Masterpiece Name</label>
                            <input type="text" name="name" class="form-control form-control-lg fw-bold text-dark fs-5" value="{{ old('name', $product->name ?? '') }}" required placeholder="e.g. Royal Jharokha Diamond Necklace">
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">Collection Suite</label>
                            <select name="collection_id" class="form-select" required>
                                <option value="">Select a Collection</option>
                                @foreach($collections as $col)
                                    <option value="{{ $col->id }}" {{ (old('collection_id', $product->collection_id ?? '') == $col->id) ? 'selected' : '' }}>{{ ucwords(strtolower($col->title)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label">SKU (Product Code)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-upc-scan"></i></span>
                                <input type="text" name="sku" class="form-control border-start-0 ps-0" value="{{ old('sku', $product->sku ?? '') }}" placeholder="e.g. LUX-001">
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Craftsmanship Description</label>
                            <textarea name="description" rows="5" class="form-control" placeholder="Detail the inspiration, stones, and craftsmanship...">{{ old('description', $product->description ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- Section II: Material Details -->
                    <div class="section-title">
                        <div class="section-icon bg-warning bg-opacity-10 text-warning"><i class="bi bi-stars"></i></div>
                        II. Material Specifications
                    </div>
                    
                    <div class="row g-4 mb-5">
                        <div class="col-md-4">
                            <label class="form-label">Metal Base</label>
                            <select name="metal_type" class="form-select">
                                <option value="">Select Metal</option>
                                <option value="Gold" {{ old('metal_type', $product->metal_type ?? '') == 'Gold' ? 'selected' : '' }}>Gold</option>
                                <option value="White Gold" {{ old('metal_type', $product->metal_type ?? '') == 'White Gold' ? 'selected' : '' }}>White Gold</option>
                                <option value="Rose Gold" {{ old('metal_type', $product->metal_type ?? '') == 'Rose Gold' ? 'selected' : '' }}>Rose Gold</option>
                                <option value="Platinum" {{ old('metal_type', $product->metal_type ?? '') == 'Platinum' ? 'selected' : '' }}>Platinum</option>
                                <option value="Silver" {{ old('metal_type', $product->metal_type ?? '') == 'Silver' ? 'selected' : '' }}>Silver</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Purity (KT)</label>
                            <input type="text" name="metal_purity" class="form-control" value="{{ old('metal_purity', $product->metal_purity ?? '') }}" placeholder="e.g. 18KT">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Gross Weight (g)</label>
                            <div class="input-group">
                                <input type="number" step="0.01" name="weight" class="form-control border-end-0" value="{{ old('weight', $product->weight ?? '') }}" placeholder="0.00">
                                <span class="input-group-text bg-white border-start-0">g</span>
                            </div>
                        </div>
                    </div>

                    <!-- Section III: Pricing -->
                    <div class="section-title">
                        <div class="section-icon bg-success bg-opacity-10 text-success"><i class="bi bi-tag-fill"></i></div>
                        III. Valuation & Pricing
                    </div>
                    
                    <div class="row g-4 mb-5">
                        <div class="col-md-4">
                            <div class="p-3 bg-success bg-opacity-10 rounded-4 border border-success border-opacity-25 h-100">
                                <label class="form-label text-success">Selling Price ($)</label>
                                <input type="number" name="price" class="form-control form-control-lg border-0 fw-bold text-success fs-4" value="{{ old('price', $product->price ?? '') }}" required placeholder="0.00" style="background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-4 border h-100">
                                <label class="form-label">Original Price (MRP)</label>
                                <input type="number" name="original_price" class="form-control" value="{{ old('original_price', $product->original_price ?? '') }}" placeholder="$ Compare at...">
                                <div class="x-small text-muted mt-2"><i class="bi bi-info-circle"></i> Shown struck-through if higher than selling price.</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-light rounded-4 border h-100">
                                <label class="form-label">Procurement Cost ($)</label>
                                <input type="number" name="cost_price" class="form-control" value="{{ old('cost_price', $product->cost_price ?? '') }}" placeholder="0.00">
                                <div class="x-small text-muted mt-2"><i class="bi bi-info-circle"></i> Hidden from customers. Used for profit reports.</div>
                            </div>
                        </div>
                    </div>

                    <!-- Section IV: Product Type -->
                    <div class="section-title">
                        <div class="section-icon bg-info bg-opacity-10 text-info"><i class="bi bi-box-seam-fill"></i></div>
                        IV. Fulfillment Strategy
                    </div>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <input class="form-check-input d-none" type="radio" name="product_type" id="type_physical" value="physical" {{ old('product_type', $product->product_type ?? 'physical') == 'physical' ? 'checked' : '' }}>
                            <label class="type-radio-card m-0 w-100" for="type_physical">
                                <div class="icon-wrapper"><i class="bi bi-box2-heart"></i></div>
                                <div>
                                    <div class="fw-bold text-dark mb-1">Physical</div>
                                    <div class="x-small text-secondary lh-sm">Requires physical shipping and delivery.</div>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-check-input d-none" type="radio" name="product_type" id="type_digital" value="digital" {{ old('product_type', $product->product_type ?? '') == 'digital' ? 'checked' : '' }}>
                            <label class="type-radio-card m-0 w-100" for="type_digital">
                                <div class="icon-wrapper"><i class="bi bi-cloud-download"></i></div>
                                <div>
                                    <div class="fw-bold text-dark mb-1">Digital</div>
                                    <div class="x-small text-secondary lh-sm">Downloadable asset (PDF, Image).</div>
                                </div>
                            </label>
                        </div>
                        <div class="col-md-4">
                            <input class="form-check-input d-none" type="radio" name="product_type" id="type_both" value="both" {{ old('product_type', $product->product_type ?? '') == 'both' ? 'checked' : '' }}>
                            <label class="type-radio-card m-0 w-100" for="type_both">
                                <div class="icon-wrapper"><i class="bi bi-boxes"></i></div>
                                <div>
                                    <div class="fw-bold text-dark mb-1">Hybrid</div>
                                    <div class="x-small text-secondary lh-sm">Physical shipment + Digital download.</div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div id="digital_file_wrapper" class="p-4 bg-info bg-opacity-10 border border-info border-opacity-25 rounded-4 mb-4" style="display: {{ in_array(old('product_type', $product->product_type ?? 'physical'), ['digital', 'both']) ? 'block' : 'none' }};">
                        <label class="form-label text-info-emphasis"><i class="bi bi-file-earmark-arrow-up-fill me-1"></i> Digital Asset Upload</label>
                        @if(isset($product) && $product->digital_file_path)
                            <div class="mb-3 p-2 bg-white rounded border border-success text-success fw-bold small shadow-sm d-inline-flex align-items-center gap-2">
                                <i class="bi bi-check-circle-fill"></i> Current File: {{ basename($product->digital_file_path) }}
                            </div>
                        @endif
                        <input type="file" name="digital_file" class="form-control border-info">
                        <span class="x-small text-info-emphasis mt-2 d-block">Upload the file customers will receive upon purchase. Max size: 50MB. (.zip, .pdf)</span>
                    </div>

                </div>

                <!-- SEO Section -->
                <div class="premium-card p-4 p-md-5">
                    <div class="section-title">
                        <div class="section-icon bg-dark bg-opacity-10 text-dark"><i class="bi bi-search"></i></div>
                        V. Search Engine Optimization (SEO)
                    </div>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $product->meta_title ?? '') }}" placeholder="Search engine title...">
                            <span class="x-small text-muted mt-1 d-block">Leave blank to use the product name automatically.</span>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">SEO URL Slug</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 x-small text-muted px-2">/product/</span>
                                <input type="text" name="slug" class="form-control border-start-0 ps-0" value="{{ old('slug', $product->slug ?? '') }}" placeholder="url-friendly-slug">
                            </div>
                            <span class="x-small text-muted mt-1 d-block">Auto-generated if left empty.</span>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" rows="3" class="form-control" placeholder="Brief summary for search engine results...">{{ old('meta_description', $product->meta_description ?? '') }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label d-flex justify-content-between align-items-center">
                                <span>Schema Markup (JSON-LD)</span>
                                <span class="badge bg-dark">Advanced</span>
                            </label>
                            <textarea name="schema_markup" rows="4" class="form-control text-monospace x-small bg-dark text-light border-0" style="font-family: monospace;" placeholder='{ "@@context": "https://schema.org/", "@@type": "Product", ... }'>{{ old('schema_markup', $product->schema_markup ?? '') }}</textarea>
                            <span class="x-small text-muted mt-2 d-block"><i class="bi bi-code-slash me-1"></i> Insert raw JSON-LD schema for rich luxury snippets in Google.</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Visuals & Settings -->
            <div class="col-xl-4 fade-in-up" style="animation-delay: 0.3s;">
                <div class="premium-card p-4 mb-4">
                    <div class="section-title mb-3">
                        <div class="section-icon bg-danger bg-opacity-10 text-danger"><i class="bi bi-image-fill"></i></div>
                        Primary Asset
                    </div>
                    
                    @php
                        $mainImg = $product->image ?? '';
                        if($mainImg && !str_starts_with($mainImg, 'http')) $mainImg = asset($mainImg);
                    @endphp
                    
                    <div class="main-image-upload shadow-sm mb-3" onclick="document.getElementById('main-image-input').click()">
                        @if($mainImg)
                            <img src="{{ $mainImg }}" id="main-preview">
                        @else
                            <div class="text-center" id="main-placeholder">
                                <i class="bi bi-cloud-arrow-up display-3 text-secondary mb-3 d-block"></i>
                                <div class="fw-bold text-dark">Upload Primary Image</div>
                                <div class="small text-muted">High-res required</div>
                            </div>
                            <img src="" id="main-preview" style="display:none;">
                        @endif
                        
                        <div class="upload-overlay">
                            <div class="bg-white rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 50px; height: 50px;">
                                <i class="bi bi-pencil-fill text-primary"></i>
                            </div>
                            <div class="fw-bold mt-2 text-dark">Change Image</div>
                        </div>
                    </div>
                    <input type="file" name="image_file" id="main-image-input" class="d-none" onchange="previewMainImage(this)">
                    
                    <div class="mt-3">
                        <label class="form-label x-small">Or provide direct URL</label>
                        <input type="text" name="image" class="form-control" placeholder="https://..." value="{{ old('image', $product->image ?? '') }}">
                    </div>
                </div>

                <div class="premium-card p-4 mb-4">
                    <div class="section-title mb-3">
                        <div class="section-icon bg-secondary bg-opacity-10 text-secondary"><i class="bi bi-images"></i></div>
                        Media Gallery
                    </div>
                    <div class="row g-2">
                        @for($i=2; $i<=6; $i++)
                        @php
                            $galField = 'image' . $i;
                            $galImg = $product->$galField ?? '';
                            if($galImg && !str_starts_with($galImg, 'http')) $galImg = asset($galImg);
                        @endphp
                        <div class="col-6">
                            <div class="gallery-upload mb-2 shadow-sm" onclick="document.getElementById('file-{{ $i }}').click()">
                                @if($galImg)
                                    <img src="{{ $galImg }}" id="preview-{{ $i }}">
                                @else
                                    <div class="text-center text-muted x-small fw-bold">
                                        <i class="bi bi-plus-lg fs-4 d-block mb-1"></i>
                                        Angle {{ $i }}
                                    </div>
                                    <img src="" id="preview-{{ $i }}" style="display:none;">
                                @endif
                            </div>
                            <input type="file" name="image{{ $i }}_file" class="d-none" id="file-{{ $i }}" onchange="previewGalleryImage(this, 'preview-{{ $i }}')">
                            <input type="text" name="image{{ $i }}" class="form-control x-small" placeholder="URL..." value="{{ old('image'.$i, $product->$galField ?? '') }}">
                        </div>
                        @endfor
                    </div>
                </div>

                <div class="premium-card p-4">
                    <div class="section-title mb-3">
                        <div class="section-icon bg-primary bg-opacity-10 text-primary"><i class="bi bi-sliders"></i></div>
                        Store Visibility
                    </div>
                    
                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-4 mb-3 border">
                        <div>
                            <div class="fw-bold text-dark mb-1"><i class="bi bi-eye-fill text-primary me-2"></i> Active Status</div>
                            <div class="x-small text-secondary">Make available on store</div>
                        </div>
                        <div class="form-check form-switch m-0 fs-4">
                            <input class="form-check-input" type="checkbox" name="is_active" {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
                        </div>
                    </div>

                    <div class="d-flex align-items-center justify-content-between p-3 bg-light rounded-4 mb-4 border">
                        <div>
                            <div class="fw-bold text-dark mb-1"><i class="bi bi-star-fill text-warning me-2"></i> Featured</div>
                            <div class="x-small text-secondary">Show on homepage</div>
                        </div>
                        <div class="form-check form-switch m-0 fs-4">
                            <input class="form-check-input" type="checkbox" name="is_featured" {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
                        </div>
                    </div>

                    <div>
                        <label class="form-label">Display Sequence (Order)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="bi bi-sort-numeric-down"></i></span>
                            <input type="number" name="order" class="form-control border-start-0 ps-0" value="{{ old('order', $product->order ?? 0) }}">
                        </div>
                        <div class="x-small text-muted mt-2">Lower numbers appear first.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sticky-action-bar d-flex justify-content-between align-items-center fade-in-up" style="animation-delay: 0.4s;">
            <a href="{{ route('admin.products.index') }}" class="btn btn-light rounded-pill px-4 fw-bold border shadow-sm">
                <i class="bi bi-arrow-left me-2"></i> Cancel & Return
            </a>
            <button type="submit" class="btn btn-premium d-flex align-items-center gap-2">
                <i class="bi bi-check2-circle fs-5"></i> {{ isset($product) ? 'Update Masterpiece' : 'Publish Masterpiece' }}
            </button>
        </div>
    </form>
@endsection

@section('scripts')
<script>
    function previewMainImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                const placeholder = document.getElementById('main-placeholder');
                if(placeholder) placeholder.style.display = 'none';
                
                const preview = document.getElementById('main-preview');
                if(preview) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewGalleryImage(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                const previewElement = document.getElementById(previewId);
                if(previewElement) {
                    const siblingDiv = previewElement.previousElementSibling;
                    if(siblingDiv && siblingDiv.tagName === 'DIV') {
                        siblingDiv.style.display = 'none';
                    }
                    previewElement.src = e.target.result;
                    previewElement.style.display = 'block';
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        function toggleDigitalFile() {
            const checkedRadio = document.querySelector('input[name="product_type"]:checked');
            if(!checkedRadio) return;
            
            const type = checkedRadio.value;
            const wrapper = document.getElementById('digital_file_wrapper');
            
            if (wrapper) {
                if (type === 'digital' || type === 'both') {
                    wrapper.style.display = 'block';
                } else {
                    wrapper.style.display = 'none';
                }
            }
        }

        document.querySelectorAll('input[name="product_type"]').forEach(radio => {
            radio.addEventListener('change', toggleDigitalFile);
        });
        
        // Run on load
        toggleDigitalFile();
    });
</script>
@endsection
