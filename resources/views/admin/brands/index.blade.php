@extends('admin.layout')

@section('title', 'Brand Partners Studio')

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

    /* Premium Buttons */
    .btn-premium {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        color: #fff;
        padding: 14px 28px;
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

    /* Brand Cards */
    .brand-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
    }

    .brand-card-premium {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        display: flex;
        flex-direction: column;
        position: relative;
    }
    .brand-card-premium:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    }

    .brand-logo-wrapper {
        height: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        padding: 2rem;
        border-bottom: 1px solid rgba(0,0,0,0.02);
    }
    .brand-logo {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        transition: transform 0.4s ease;
    }
    .brand-card-premium:hover .brand-logo {
        transform: scale(1.05);
    }

    .brand-content {
        padding: 1.5rem;
        text-align: center;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .brand-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 0.5rem;
    }

    .brand-desc {
        color: #6c757d;
        font-size: 0.9rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 1.5rem;
    }

    .brand-footer {
        margin-top: auto;
        display: flex;
        justify-content: center;
        gap: 10px;
        padding-top: 1rem;
        border-top: 1px solid #f8f9fa;
    }

    .status-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 6px 15px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 800;
        letter-spacing: 1px;
        text-transform: uppercase;
        z-index: 10;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        text-decoration: none;
        transition: all 0.3s ease;
    }
    .status-active { background: #d1e7dd; color: #0f5132; }
    .status-active:hover { background: #badbcc; color: #0f5132; }
    .status-inactive { background: #e2e3e5; color: #41464b; }
    .status-inactive:hover { background: #d3d6d8; color: #41464b; }

    .btn-action-light {
        background: #f8f9fa;
        color: #495057;
        border: none;
        border-radius: 20px;
        padding: 8px 16px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-action-light:hover {
        background: #e9ecef;
        color: #212529;
    }
    .btn-action-danger {
        background: #fff5f5;
        color: #dc3545;
        border: none;
        border-radius: 20px;
        padding: 8px 16px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-action-danger:hover {
        background: #ffe3e3;
        color: #bb2d3b;
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
                    <i class="bi bi-patch-check-fill" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="font-family: 'Playfair Display', serif; letter-spacing: -0.5px;">Brand Partners Studio</h2>
                    <p class="text-secondary mb-0 fs-6">Manage your authorized jewelry brands and collections.</p>
                </div>
            </div>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-premium d-flex align-items-center gap-2">
                <i class="bi bi-plus-lg"></i> Add New Brand
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-4 bg-success-subtle text-success fade-in-up" style="animation-delay: 0.1s;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if($brands->count() > 0)
        <div class="brand-grid fade-in-up" style="animation-delay: 0.2s;">
            @php
                if (!function_exists('getMediaUrl')) {
                    function getMediaUrl($path) {
                        if (!$path) return '';
                        if (str_starts_with($path, 'http')) return $path;
                        if (str_starts_with($path, 'storage/')) return asset($path);
                        return asset('storage/' . $path);
                    }
                }
            @endphp
            @foreach($brands as $brand)
                <div class="brand-card-premium">
                    <a href="{{ route('admin.brands.toggleStatus', $brand->id) }}" 
                       class="status-badge {{ $brand->is_active ? 'status-active' : 'status-inactive' }}" 
                       title="Click to toggle visibility">
                        <i class="bi {{ $brand->is_active ? 'bi-globe' : 'bi-lock-fill' }} me-1"></i>
                        {{ $brand->is_active ? 'Active' : 'Hidden' }}
                    </a>
                    
                    <div class="brand-logo-wrapper">
                        @if($brand->logo)
                            <img src="{{ getMediaUrl($brand->logo) }}" alt="{{ $brand->name }}" class="brand-logo" onerror="this.src='https://placehold.co/400x200/f8f9fa/adb5bd?text={{ urlencode($brand->name) }}'">
                        @else
                            <i class="bi bi-image text-muted opacity-25" style="font-size: 4rem;"></i>
                        @endif
                    </div>
                    
                    <div class="brand-content">
                        <h4 class="brand-name">{{ $brand->name }}</h4>
                        <p class="brand-desc">{{ $brand->description ?? 'No description provided for this brand partner.' }}</p>
                        
                        <div class="brand-footer">
                            <a href="{{ route('admin.brands.edit', $brand->id) }}" class="btn-action-light">
                                <i class="bi bi-pencil-fill me-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to completely remove this brand partner?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-action-danger">
                                    <i class="bi bi-trash3-fill me-1"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="col-12 py-5 text-center fade-in-up" style="animation-delay: 0.2s;">
            <div class="mb-4">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 100px; height: 100px;">
                    <i class="bi bi-patch-check text-secondary" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
            <h4 class="fw-bold text-dark" style="font-family: 'Playfair Display', serif;">No Brand Partners Found</h4>
            <p class="text-secondary mx-auto mb-4" style="max-width: 450px;">Start building your authorized partner list by adding your first brand.</p>
            <a href="{{ route('admin.brands.create') }}" class="btn btn-premium px-5">
                <i class="bi bi-plus-lg me-2"></i> Add First Brand
            </a>
        </div>
    @endif

@endsection
