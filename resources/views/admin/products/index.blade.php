@extends('admin.layout')

@section('title', 'Product List')

@section('styles')
<style>
    /* Full width container override */
    .content-body {
        max-width: 100% !important;
        width: 100% !important;
        padding: 30px !important;
        margin: 0 !important;
        background-color: #f8f9fa;
    }

    /* Premium Button Glow */
    .btn-premium {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        transition: all 0.3s ease;
    }
    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
        background: linear-gradient(135deg, #0b5ed7 0%, #094eb3 100%);
    }

    /* Sleek Segmented Control Tabs */
    .segmented-control {
        background: #e9ecef;
        border-radius: 50px;
        padding: 6px;
        display: inline-flex;
        gap: 5px;
    }
    .segmented-control .nav-link {
        border-radius: 50px;
        color: #6c757d;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 10px 24px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .segmented-control .nav-link:hover {
        color: #495057;
        background: rgba(255,255,255,0.5);
    }
    .segmented-control .nav-link.active {
        background: #ffffff;
        color: #0d6efd;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    /* Premium Cards */
    .premium-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    /* Table Enhancements */
    .table-premium th {
        font-size: 0.75rem;
        letter-spacing: 1px;
        color: #adb5bd;
        text-transform: uppercase;
        border-bottom: 2px solid #f8f9fa;
        padding: 1rem;
    }
    .table-premium td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f8f9fa;
    }
    .product-row {
        transition: background-color 0.2s ease;
    }
    .product-row:hover {
        background-color: #fcfdfd !important;
    }

    /* Image Thumbnail */
    .img-thumbnail-premium {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        object-fit: cover;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        border: 1px solid #f1f1f1;
        background: #fff;
    }

    /* Custom Input Group */
    .premium-input-group {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e9ecef;
        background: #fff;
        transition: all 0.2s ease;
    }
    .premium-input-group:focus-within {
        border-color: #0d6efd;
        box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
    }
    .premium-input-group .form-control, .premium-input-group .form-select, .premium-input-group .input-group-text {
        border: none;
        background: transparent;
    }
    .premium-input-group .form-control:focus, .premium-input-group .form-select:focus {
        box-shadow: none;
    }
</style>
@endsection

@section('content')
    <!-- Header Section -->
    <div class="mb-5 d-flex justify-content-between align-items-center animate-fade-in">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-white p-3 rounded-4 shadow-sm border border-light">
                <i class="bi bi-box-seam text-primary fs-4"></i>
            </div>
            <div>
                <h3 class="mb-1 fw-bold text-dark letter-spacing-tight">Product Inventory</h3>
                <p class="text-secondary small mb-0">Manage and organize your entire jewelry collection effortlessly.</p>
            </div>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-premium d-flex align-items-center gap-2 py-3 px-4 rounded-pill">
            <i class="bi bi-plus-lg"></i> 
            <span>Add New Product</span>
        </a>
    </div>

    <!-- Navigation Tabs -->
    <div class="d-flex mb-4 animate-fade-in" style="animation-delay: 0.1s;">
        <ul class="nav nav-pills segmented-control" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" data-type="all" onclick="setProductTypeFilter('all', this)">
                    <i class="bi bi-grid-fill"></i> All Products
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-type="physical" onclick="setProductTypeFilter('physical', this)">
                    <i class="bi bi-box-seam-fill"></i> Physical Products
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-type="digital" onclick="setProductTypeFilter('digital', this)">
                    <i class="bi bi-cloud-arrow-down-fill"></i> Digital Products
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-type="both" onclick="setProductTypeFilter('both', this)">
                    <i class="bi bi-layers-fill"></i> Physical + Digital
                </button>
            </li>
        </ul>
    </div>

    <!-- Filter Card -->
    <div class="card premium-card mb-4 animate-fade-in" style="animation-delay: 0.2s;">
        <div class="card-body p-4">
            <div class="d-flex align-items-center gap-2 mb-4">
                <i class="bi bi-funnel text-primary fs-5"></i>
                <span class="fw-bold text-dark fs-6">Advanced Filters</span>
            </div>
            
            <div class="row g-3">
                <div class="col-md-4 col-lg-2">
                    <div class="premium-input-group d-flex align-items-center px-2">
                        <i class="bi bi-collection text-muted ms-2"></i>
                        <select id="filterCollection" class="form-select py-2 text-secondary" onchange="filterProducts()">
                            <option value="">All Collections</option>
                            @foreach($collections as $col)
                                <option value="{{ $col->id }}">{{ $col->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="col-md-4 col-lg-2">
                    <div class="premium-input-group d-flex align-items-center px-2">
                        <i class="bi bi-activity text-muted ms-2"></i>
                        <select id="filterStatus" class="form-select py-2 text-secondary" onchange="filterProducts()">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-4 col-lg-2">
                    <div class="premium-input-group d-flex align-items-center px-2">
                        <i class="bi bi-gem text-muted ms-2"></i>
                        <select id="filterMetal" class="form-select py-2 text-secondary" onchange="filterProducts()">
                            <option value="">All Metals</option>
                            <option value="Gold">Gold</option>
                            <option value="White Gold">White Gold</option>
                            <option value="Platinum">Platinum</option>
                            <option value="Silver">Silver</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3">
                    <div class="premium-input-group d-flex align-items-center">
                        <span class="input-group-text text-muted bg-light border-end"><i class="bi bi-currency-dollar"></i></span>
                        <input type="number" id="filterPriceMin" class="form-control py-2" placeholder="Min" onkeyup="filterProducts()">
                        <span class="input-group-text text-muted bg-transparent border-0">—</span>
                        <input type="number" id="filterPriceMax" class="form-control py-2" placeholder="Max" onkeyup="filterProducts()">
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="premium-input-group d-flex align-items-center px-2 bg-light">
                        <i class="bi bi-search text-primary ms-2"></i>
                        <input type="text" id="filterSearch" class="form-control py-2 bg-light" placeholder="Search by product name..." onkeyup="filterProducts()">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Card -->
    <div class="card premium-card overflow-hidden animate-fade-in mb-5" style="animation-delay: 0.3s;">
        <div class="table-responsive">
            <table class="table table-premium mb-0" id="productsTable">
                <thead class="bg-white">
                    <tr>
                        <th class="ps-4 d-none d-md-table-cell" width="100">ID</th>
                        <th>Product Details</th>
                        <th class="d-none d-lg-table-cell">Category</th>
                        <th class="d-none d-lg-table-cell">Type</th>
                        <th class="d-none d-lg-table-cell">Status</th>
                        <th>Price</th>
                        <th class="d-none d-xl-table-cell">Specifications</th>
                        <th class="pe-4 text-end" width="150">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($products as $product)
                        <tr class="product-row" 
                            data-collection="{{ $product->collection_id ?? '' }}"
                            data-status="{{ $product->is_active ? 'active' : 'inactive' }}" 
                            data-type="{{ $product->product_type ?? 'physical' }}"
                            data-name="{{ strtolower($product->name ?? '') }}"
                            data-price="{{ $product->price ?? 0 }}"
                            data-metal="{{ strtolower($product->metal_type ?? '') }}"
                            data-purity="{{ strtolower($product->metal_purity ?? '') }}">
                            
                            <td class="ps-4 d-none d-md-table-cell">
                                <span class="badge bg-light text-secondary border rounded-pill font-monospace">#{{ sprintf('%04d', $product->id) }}</span>
                            </td>
                            
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="flex-shrink-0">
                                        <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset($product->image) }}" 
                                             alt="{{ $product->name }}" 
                                             class="img-thumbnail-premium"
                                             onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                                    </div>
                                    <div>
                                        @if($product->collection && $product->slug)
                                            <a href="{{ route('collections.product', ['collectionSlug' => $product->collection->slug, 'productSlug' => $product->slug]) }}" target="_blank" class="fw-bold text-dark fs-6 mb-1 text-decoration-none d-inline-flex align-items-center gap-1" style="transition: color 0.2s;" onmouseover="this.classList.replace('text-dark', 'text-primary')" onmouseout="this.classList.replace('text-primary', 'text-dark')">
                                                {{ $product->name }}
                                                <i class="bi bi-box-arrow-up-right ms-1 text-muted" style="font-size: 0.7rem; opacity: 0.6;"></i>
                                            </a>
                                        @else
                                            <div class="fw-bold text-dark fs-6 mb-1">{{ $product->name }}</div>
                                        @endif
                                        <div class="d-lg-none x-small text-muted mb-1">{{ $product->collection->title ?? 'Boutique' }}</div>
                                        @if($product->is_featured)
                                            <span class="badge bg-warning-subtle text-warning x-small border border-warning-subtle py-1 px-2 rounded-pill">
                                                <i class="bi bi-star-fill me-1"></i> Featured
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            
                            <td class="d-none d-lg-table-cell">
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-500">
                                    <i class="bi bi-tag me-1 text-muted"></i> {{ $product->collection->title ?? 'Boutique' }}
                                </span>
                            </td>
                            
                            <td class="d-none d-lg-table-cell">
                                <span class="badge px-3 py-2 rounded-pill border fw-500 {{ $product->product_type === 'digital' ? 'bg-primary-subtle text-primary border-primary-subtle' : ($product->product_type === 'both' ? 'bg-info-subtle text-info border-info-subtle' : 'bg-secondary-subtle text-secondary border-secondary-subtle') }}">
                                    @if($product->product_type === 'digital')
                                        <i class="bi bi-cloud-arrow-down-fill me-1"></i>
                                    @elseif($product->product_type === 'both')
                                        <i class="bi bi-layers-fill me-1"></i>
                                    @else
                                        <i class="bi bi-box-seam-fill me-1"></i>
                                    @endif
                                    {{ ucfirst($product->product_type ?? 'Physical') }}
                                </span>
                            </td>
                            
                            <td class="d-none d-lg-table-cell">
                                <form action="{{ route('admin.products.toggleStatus', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="border-0 bg-transparent p-0 transition-hover" title="Click to toggle">
                                        <span class="badge px-3 py-2 rounded-pill border fw-500 {{ $product->is_active ? 'bg-success-subtle text-success border-success-subtle' : 'bg-danger-subtle text-danger border-danger-subtle' }}">
                                            <i class="bi {{ $product->is_active ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }} me-1"></i>
                                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </button>
                                </form>
                            </td>
                            
                            <td>
                                <div class="fw-bolder text-dark fs-5 mb-1">${{ number_format($product->price) }}</div>
                                @if($product->original_price && $product->original_price > $product->price)
                                    <div class="text-muted text-decoration-line-through small">${{ number_format($product->original_price) }}</div>
                                @endif
                            </td>
                            
                            <td class="d-none d-xl-table-cell">
                                @if($product->metal_type)
                                    <div class="small text-secondary mb-1">
                                        <i class="bi bi-gem text-muted me-1"></i> {{ $product->metal_type }} {{ $product->metal_purity ? '('.$product->metal_purity.')' : '' }}
                                    </div>
                                @endif
                                @if($product->weight)
                                    <div class="small text-secondary">
                                        <i class="bi bi-speedometer2 text-muted me-1"></i> {{ $product->weight }}g
                                    </div>
                                @endif
                                @if(!$product->metal_type && !$product->weight)
                                    <span class="text-muted small fst-italic">Standard item</span>
                                @endif
                            </td>
                            
                            <td class="pe-4 text-end">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-light btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" title="Edit Product">
                                        <i class="bi bi-pencil-square text-primary"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you absolutely sure you want to delete this product? This action cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-light btn-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;" title="Delete Product">
                                            <i class="bi bi-trash3 text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="bi bi-box-seam text-secondary fs-1"></i>
                                    </div>
                                    <h5 class="fw-bold text-dark mb-1">No Products Found</h5>
                                    <p class="text-muted mb-4">You haven't added any products yet, or none match your filters.</p>
                                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary rounded-pill px-4 py-2">
                                        <i class="bi bi-plus-lg me-1"></i> Add First Product
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('modals')
    <!-- Premium Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 24px; overflow: hidden;">
                
                <!-- Premium Modal Header -->
                <div class="modal-header bg-light border-0 py-4 px-5">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                            <i class="bi bi-gem fs-4"></i>
                        </div>
                        <div>
                            <h4 class="modal-title fw-bolder text-dark m-0" id="productModalLabel" style="font-family: 'Playfair Display', serif;">Add New Masterpiece</h4>
                            <p class="m-0 small text-secondary mt-1 fw-bold text-uppercase" style="letter-spacing: 1px;">Product Catalog Definition</p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body p-4 p-lg-5" style="background: #fdfaf7;">
                    <form id="productForm" action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="methodField"></div>

                        <div class="row g-5">
                            <!-- Left: Basic Config -->
                            <div class="col-lg-7">
                                
                                <div class="bg-white p-4 p-lg-5 rounded-4 shadow-sm border mb-4">
                                    <h5 class="fw-bold mb-4 text-dark border-bottom pb-3"><i class="bi bi-info-square text-primary me-2"></i> 1. Basic Information</h5>
                                    
                                    <div class="row g-4">
                                        <div class="col-md-8">
                                            <label class="form-label fw-bold text-uppercase small text-secondary mb-2" style="letter-spacing: 0.5px;">Product Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" id="form-name" class="form-control form-control-lg border-2 rounded-3" style="font-size: 1.1rem; padding: 12px 15px;" required placeholder="e.g. Imperial Diamond Ring" >
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold text-uppercase small text-secondary mb-2" style="letter-spacing: 0.5px;">SKU / Code</label>
                                            <input type="text" name="sku" id="form-sku" class="form-control form-control-lg border-2 rounded-3" style="font-size: 1.1rem; padding: 12px 15px;" placeholder="SKU-XXX" >
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-uppercase small text-secondary mb-2" style="letter-spacing: 0.5px;">Select Collection <span class="text-danger">*</span></label>
                                            <select name="collection_id" id="form-collection" class="form-select form-select-lg border-2 rounded-3" style="font-size: 1rem; padding: 12px 15px;" required >
                                                <option value="">Choose a Collection...</option>
                                                @foreach($collections as $col)
                                                    <option value="{{ $col->id }}">{{ $col->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bold text-uppercase small text-secondary mb-2" style="letter-spacing: 0.5px;">Description</label>
                                            <textarea name="description" id="form-description" rows="5" class="form-control border-2 rounded-3" style="font-size: 1rem; padding: 15px; line-height: 1.6;" placeholder="Describe the craftsmanship and details of this piece..." ></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white p-4 p-lg-5 rounded-4 shadow-sm border mb-4">
                                    <h5 class="fw-bold mb-4 text-dark border-bottom pb-3"><i class="bi bi-tags text-success me-2"></i> 2. Pricing & Materials</h5>
                                    
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-uppercase small text-secondary mb-2" style="letter-spacing: 0.5px;">Selling Price ($) <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-lg border-2 rounded-3 overflow-hidden">
                                                <span class="input-group-text bg-light border-0 text-muted px-3"><i class="bi bi-currency-dollar"></i></span>
                                                <input type="number" name="price" id="form-price" class="form-control border-0 bg-light fw-bolder text-dark" style="font-size: 1.25rem;" required placeholder="0.00" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold text-uppercase small text-secondary mb-2" style="letter-spacing: 0.5px;">Compare Price ($)</label>
                                            <div class="input-group input-group-lg border-2 rounded-3 overflow-hidden">
                                                <span class="input-group-text bg-light border-0 text-muted px-3"><i class="bi bi-currency-dollar"></i></span>
                                                <input type="number" name="original_price" id="form-original-price" class="form-control border-0 bg-light text-decoration-line-through text-muted" style="font-size: 1.1rem;" placeholder="0.00" >
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold text-uppercase small text-secondary mb-2" style="letter-spacing: 0.5px;">Metal Base</label>
                                            <select name="metal_type" id="form-metal-type" class="form-select border-2 rounded-3" style="padding: 10px 15px;" >
                                                <option value="">N/A</option>
                                                <option value="Gold">Gold</option>
                                                <option value="White Gold">White Gold</option>
                                                <option value="Platinum">Platinum</option>
                                                <option value="Silver">Silver</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold text-uppercase small text-secondary mb-2" style="letter-spacing: 0.5px;">Purity</label>
                                            <input type="text" name="metal_purity" id="form-metal-purity" class="form-control border-2 rounded-3" style="padding: 10px 15px;" placeholder="e.g. 18KT" >
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label fw-bold text-uppercase small text-secondary mb-2" style="letter-spacing: 0.5px;">Gross Weight (g)</label>
                                            <input type="number" name="weight" id="form-weight" step="0.01" class="form-control border-2 rounded-3" style="padding: 10px 15px;" placeholder="0.00" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Right: Visual Gallery & Settings -->
                            <div class="col-lg-5">
                                
                                <div class="bg-white p-4 rounded-4 shadow-sm border mb-4">
                                    <h5 class="fw-bold mb-4 text-dark border-bottom pb-3"><i class="bi bi-images text-warning me-2"></i> 3. Visual Gallery</h5>
                                    
                                    <label class="form-label fw-bold text-uppercase small text-secondary mb-2" style="letter-spacing: 0.5px;">Master Image <span class="text-danger">*</span></label>
                                    <div class="p-3 bg-light rounded-4 border-2 border-dashed mb-4" style="border-color: #dee2e6;">
                                        <div class="d-flex flex-column align-items-center text-center gap-3">
                                            <div class="rounded-3 overflow-hidden shadow-sm" style="width: 140px; height: 140px; background: #fff;">
                                                <img src="" id="img-preview-main" class="w-100 h-100 object-fit-cover" onerror="this.src='https://placehold.co/140x140?text=Master+Asset'">
                                            </div>
                                            <div class="w-100">
                                                <button type="button" class="btn btn-outline-primary btn-sm w-100 rounded-pill mb-2 fw-bold" onclick="document.getElementById('form-image-file').click()"><i class="bi bi-upload me-1"></i> Upload Master Image</button>
                                                <input type="file" name="image_file" id="form-image-file" class="d-none" onchange="previewFile(this, 'img-preview-main')">
                                                <input type="text" name="image" id="form-image" class="form-control form-control-sm border-0 bg-white rounded-3 shadow-sm" placeholder="Or paste direct URL here...">
                                            </div>
                                        </div>
                                    </div>

                                    <label class="form-label fw-bold text-uppercase small text-secondary mb-2 mt-2" style="letter-spacing: 0.5px;">Additional Gallery Views</label>
                                    <div class="row g-3">
                                        @for($i=2; $i<=6; $i++)
                                        <div class="col-4">
                                            <div class="p-2 bg-light rounded-4 border text-center h-100 d-flex flex-column justify-content-between position-relative" style="cursor: pointer;" onclick="document.getElementById('file-{{ $i }}').click()">
                                                <div class="rounded-3 overflow-hidden shadow-sm mb-2 mx-auto" style="width: 60px; height: 60px; background: #fff;">
                                                    <img src="" id="img-preview-{{ $i }}" class="w-100 h-100 object-fit-cover" onerror="this.src='https://placehold.co/60x60?text={{ $i }}'">
                                                </div>
                                                <div class="small fw-bold text-primary" style="font-size: 0.7rem;"><i class="bi bi-plus-circle"></i> Slot {{ $i }}</div>
                                                <input type="file" name="image{{ $i }}_file" class="d-none" id="file-{{ $i }}" onchange="previewFile(this, 'img-preview-{{ $i }}')">
                                            </div>
                                            <input type="hidden" name="image{{ $i }}" id="form-image{{ $i }}">
                                        </div>
                                        @endfor
                                    </div>
                                    <div class="form-text mt-3 text-muted small"><i class="bi bi-info-circle me-1"></i> Click on a slot to upload additional angles.</div>
                                </div>

                                <div class="bg-dark p-4 rounded-4 shadow-lg text-white">
                                    <h5 class="fw-bold mb-4 text-white border-bottom border-secondary pb-3"><i class="bi bi-gear-fill text-danger me-2"></i> 4. Settings & Visibility</h5>
                                    
                                    <div class="mb-4">
                                        <label class="form-label text-uppercase small mb-2 text-white-50 fw-bold" style="letter-spacing: 0.5px;">Display Sequence Priority</label>
                                        <input type="number" name="order" id="form-order" class="form-control bg-transparent text-white border-secondary rounded-3" style="padding: 10px 15px;" value="0">
                                    </div>
                                    
                                    <div class="d-flex align-items-center justify-content-between p-3 rounded-3 mb-3" style="background: rgba(255,255,255,0.05);">
                                        <div>
                                            <div class="fw-bold"><i class="bi bi-globe me-2 text-primary"></i> Active Status</div>
                                            <div class="small text-white-50">Visible in public store</div>
                                        </div>
                                        <div class="form-check form-switch fs-4 m-0">
                                            <input class="form-check-input" type="checkbox" name="is_active" id="form-is-active" checked style="cursor: pointer;">
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between p-3 rounded-3" style="background: rgba(255,255,255,0.05);">
                                        <div>
                                            <div class="fw-bold"><i class="bi bi-star-fill me-2 text-warning"></i> Featured Product</div>
                                            <div class="small text-white-50">Pin to homepage collections</div>
                                        </div>
                                        <div class="form-check form-switch fs-4 m-0">
                                            <input class="form-check-input" type="checkbox" name="is_featured" id="form-is-featured" style="cursor: pointer;">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="mt-5 pt-4 border-top d-flex justify-content-end gap-3">
                            <button type="button" class="btn btn-light px-5 py-3 border rounded-pill fw-bold" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary px-5 py-3 rounded-pill fw-bold shadow-lg" id="submitBtn" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); border: none;">
                                <i class="bi bi-cloud-arrow-up-fill me-2"></i> Save Masterpiece
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    let currentTypeFilter = 'all';

    function setProductTypeFilter(type, buttonElement) {
        currentTypeFilter = type;
        
        // Update active class on tabs
        document.querySelectorAll('#productTabs .nav-link').forEach(btn => {
            btn.classList.remove('active');
            btn.classList.add('text-secondary');
        });
        buttonElement.classList.add('active');
        buttonElement.classList.remove('text-secondary');

        filterProducts();
    }

    function filterProducts() {
        const col = $('#filterCollection').val();
        const status = $('#filterStatus').val();
        const search = $('#filterSearch').val().toLowerCase();
        const metal = $('#filterMetal').val().toLowerCase();
        const minPrice = parseFloat($('#filterPriceMin').val()) || 0;
        const maxPrice = parseFloat($('#filterPriceMax').val()) || Infinity;
        
        $('.product-row').each(function() {
            try {
                const $row = $(this);
                const rCol = $row.attr('data-collection') || "";
                const rStatus = $row.attr('data-status') || "";
                const rType = String($row.attr('data-type') || "physical").toLowerCase();
                const rName = String($row.attr('data-name') || "").toLowerCase();
                const rMetal = String($row.attr('data-metal') || "").toLowerCase();
                const rPrice = parseFloat($row.attr('data-price')) || 0;
                
                let showCols = !col || rCol == col;
                let showStatus = !status || rStatus == status;
                let showSearch = !search || rName.includes(search);
                let showMetal = !metal || rMetal.includes(metal);
                let showPrice = rPrice >= minPrice && rPrice <= maxPrice;
                
                let showType = false;
                if (currentTypeFilter === 'all') {
                    showType = true;
                } else if (currentTypeFilter === 'physical') {
                    showType = (rType === 'physical' || rType === 'both');
                } else if (currentTypeFilter === 'digital') {
                    showType = (rType === 'digital' || rType === 'both');
                } else if (currentTypeFilter === 'both') {
                    showType = (rType === 'both');
                }
                
                if (showCols && showStatus && showSearch && showMetal && showPrice && showType) {
                    $row.show();
                } else {
                    $row.hide();
                }
            } catch (e) {
                console.error("Filter error on row:", e);
            }
        });
    }
</script>
@endsection