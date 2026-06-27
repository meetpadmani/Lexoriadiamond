@include('frontend.navbar')

<!-- Premium Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&family=Playfair+Display:wght@400;700;900&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --rajwadi-maroon: #000000;
        --rajwadi-gold: #333333;
        --rajwadi-cream: #fdf9f5;
        --rajwadi-dark: #000000;
    }

    body {
        background-color: var(--rajwadi-cream);
        font-family: 'Inter', sans-serif;
    }

    .chronicle-detail-container {
        max-width: 900px;
        margin: 120px auto;
        padding: 0 20px;
    }

    .detail-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .detail-category {
        font-family: 'Inter', serif;
        font-size: 0.8rem;
        font-weight: 800;
        color: var(--rajwadi-gold);
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 15px;
        display: block;
    }

    .detail-title {
        font-family: 'Inter', serif;
        font-size: 3.5rem;
        font-weight: 900;
        color: var(--rajwadi-maroon);
        margin-bottom: 25px;
        line-height: 1.2;
    }

    .detail-meta {
        font-size: 0.85rem;
        color: #888;
        display: flex;
        justify-content: center;
        gap: 30px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .featured-visual {
        width: 100%;
        height: 500px;
        object-fit: cover;
        margin-bottom: 60px;
        box-shadow: 0 30px 60px rgba(90, 25, 25, 0.1);
    }

    .chronicle-content {
        font-size: 1.15rem;
        line-height: 1.8;
        color: #333;
        margin-bottom: 60px;
    }

    .chronicle-content p {
        margin-bottom: 30px;
    }

    .chronicle-content h2, .chronicle-content h3 {
        font-family: 'Inter', serif;
        color: var(--rajwadi-maroon);
        margin: 50px 0 25px 0;
    }

    .tags-section {
        border-top: 1px solid #eee;
        padding-top: 40px;
        margin-bottom: 80px;
    }

    .tag-link {
        display: inline-block;
        padding: 5px 15px;
        background: white;
        border: 1px solid #ddd;
        color: #666;
        text-decoration: none;
        font-size: 0.8rem;
        margin-right: 10px;
        transition: all 0.3s;
    }

    .tag-link:hover {
        background: var(--rajwadi-gold);
        color: white;
        border-color: var(--rajwadi-gold);
    }

    .related-section {
        background: white;
        padding: 80px 0;
        margin-bottom: -100px;
    }

    .section-header-lux {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-header-lux h3 {
        font-family: 'Inter', serif;
        font-size: 1.8rem;
        color: var(--rajwadi-maroon);
        letter-spacing: 3px;
    }

    @media (max-width: 768px) {
        .detail-title { font-size: 2.2rem; }
        .featured-visual { height: 300px; }
    }
</style>

<article class="chronicle-detail-container">
    <header class="detail-header">
        <span class="detail-category">{{ $post->category->name }}</span>
        <h1 class="detail-title">{{ $post->title }}</h1>
        <div class="detail-meta">
            <span>By Lexoria Diamond Heritage</span>
            <span>•</span>
            <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
        </div>
    </header>

    @if($post->featured_image)
        <img src="{{ asset($post->featured_image) }}" class="featured-visual" alt="{{ $post->title }}">
    @endif

    <div class="chronicle-content">
        {!! $post->content !!}
    </div>

    @if($post->tags->count() > 0)
    <div class="tags-section">
        <span class="text-muted small text-uppercase fw-bold me-3">Chapter Keywords:</span>
        @foreach($post->tags as $tag)
            <a href="#" class="tag-link">#{{ $tag->name }}</a>
        @endforeach
    </div>
    @endif
</article>

@if($relatedPosts->count() > 0)
<section class="related-section">
    <div class="container">
        <div class="section-header-lux">
            <h3>Continuing the Legacy</h3>
            <p class="text-muted">Explore related chapters from our digital chronicles</p>
        </div>
        <div class="row">
            @foreach($relatedPosts as $related)
            <div class="col-md-4">
                <div class="text-center">
                    <a href="{{ route('blog.show', $related->slug) }}" style="text-decoration: none;">
                        <img src="{{ asset($related->featured_image ?? 'assets/images/placeholder.jpg') }}" 
                             style="width: 100%; height: 200px; object-fit: cover; margin-bottom: 20px;">
                        <h4 style="font-family: 'Inter', serif; font-size: 1.2rem; color: var(--rajwadi-dark);">{{ $related->title }}</h4>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<div style="height: 100px;"></div>

@include('frontend.footer')

