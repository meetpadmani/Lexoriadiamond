@extends('admin.layout')

@section('title', 'Blog Chronicles')

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

    /* Blog Grid */
    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
    }

    .blog-card-premium {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.03);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        display: flex;
        flex-direction: column;
    }
    .blog-card-premium:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
    }

    .blog-img-wrapper {
        position: relative;
        aspect-ratio: 16/10;
        overflow: hidden;
        background: #f8f9fa;
    }
    .blog-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .blog-card-premium:hover .blog-img {
        transform: scale(1.05);
    }

    .blog-badge {
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
        background: rgba(255, 255, 255, 0.95);
        color: #212529;
    }

    .blog-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    
    .blog-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.25rem;
        font-weight: 700;
        color: #212529;
        margin-bottom: 1rem;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .blog-footer {
        margin-top: auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #f8f9fa;
    }

    .status-pill {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .status-published { background: #d1e7dd; color: #0f5132; }
    .status-draft { background: #fff3cd; color: #664d03; }

    .dropdown-menu {
        border-radius: 16px;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        padding: 10px;
    }
    .dropdown-item {
        border-radius: 10px;
        padding: 8px 15px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: #0d6efd;
    }
    .dropdown-item.text-danger:hover {
        background-color: #fef2f2;
        color: #dc3545;
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
                    <i class="bi bi-journal-text" style="font-size: 2.5rem;"></i>
                </div>
                <div>
                    <h2 class="fw-bolder text-dark mb-1" style="font-family: 'Playfair Display', serif; letter-spacing: -0.5px;">Blog Chronicles</h2>
                    <p class="text-secondary mb-0 fs-6">Manage and publish your royal digital narratives.</p>
                </div>
            </div>
            <div class="d-flex gap-3 flex-wrap">
                <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-outline-premium d-flex align-items-center gap-2">
                    <i class="bi bi-folder2-open"></i> Categories
                </a>
                <a href="{{ route('admin.blog-posts.create') }}" class="btn btn-premium d-flex align-items-center gap-2">
                    <i class="bi bi-feather"></i> Write New Chapter
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4 rounded-4 bg-success-subtle text-success fade-in-up" style="animation-delay: 0.1s;">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    @if($posts->count() > 0)
        <div class="blog-grid fade-in-up" style="animation-delay: 0.2s;">
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
            @foreach($posts as $post)
                <div class="blog-card-premium">
                    <div class="blog-img-wrapper">
                        <span class="blog-badge">{{ $post->category->name ?? 'Uncategorized' }}</span>
                        <img src="{{ $post->featured_image ? getMediaUrl($post->featured_image) : 'https://placehold.co/800x500/f8f9fa/adb5bd?text=No+Cover+Image' }}" 
                             class="blog-img" 
                             onerror="this.src='https://placehold.co/800x500/f8f9fa/adb5bd?text=Image+Error'">
                    </div>
                    <div class="blog-content">
                        <h4 class="blog-title">{{ $post->title }}</h4>
                        
                        <div class="blog-footer">
                            <span class="status-pill {{ $post->is_published ? 'status-published' : 'status-draft' }}">
                                <i class="bi {{ $post->is_published ? 'bi-globe' : 'bi-lock-fill' }} me-1"></i> 
                                {{ $post->is_published ? 'Published' : 'Draft' }}
                            </span>
                            
                            <div class="dropdown">
                                <button class="btn btn-light rounded-circle shadow-sm border" type="button" data-bs-toggle="dropdown" style="width: 36px; height: 36px; padding: 0;">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-lg">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.blog-posts.edit', $post->id) }}">
                                            <i class="bi bi-pencil-fill me-2 text-primary"></i> Edit Chapter
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.blog-posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this chronicle forever?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-trash3-fill me-2"></i> Delete Forever
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5 fade-in-up" style="animation-delay: 0.3s;">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="col-12 py-5 text-center fade-in-up" style="animation-delay: 0.2s;">
            <div class="mb-4">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 100px; height: 100px;">
                    <i class="bi bi-journal-x text-secondary" style="font-size: 3rem; opacity: 0.5;"></i>
                </div>
            </div>
            <h4 class="fw-bold text-dark font-playfair">No Chapters Written Yet</h4>
            <p class="text-secondary mx-auto mb-4" style="max-width: 450px;">Start building your brand's digital narrative by creating your first blog post.</p>
            <a href="{{ route('admin.blog-posts.create') }}" class="btn btn-premium px-5">
                <i class="bi bi-feather me-2"></i> Start Writing
            </a>
        </div>
    @endif

@endsection
