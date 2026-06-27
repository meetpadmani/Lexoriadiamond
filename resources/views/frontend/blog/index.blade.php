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

    .chronicles-hero {
        padding: 100px 0 60px 0;
        text-align: center;
        background: white;
        border-bottom: 1px solid #eee;
        margin-bottom: 60px;
    }

    .chronicles-hero h1 {
        font-family: 'Inter', serif;
        font-size: 3.5rem;
        font-weight: 900;
        color: var(--rajwadi-maroon);
        letter-spacing: 5px;
        text-transform: uppercase;
        margin-bottom: 15px;
    }

    .chronicles-hero p {
        font-family: 'Inter', serif;
        font-style: italic;
        color: var(--rajwadi-gold);
        font-size: 1.2rem;
    }

    .blog-grid-container {
        max-width: 1300px;
        margin: 0 auto 100px auto;
        padding: 0 20px;
    }

    .category-filter {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 60px;
        flex-wrap: wrap;
    }

    .cat-pill {
        padding: 10px 30px;
        border: 1px solid #ddd;
        color: #666;
        text-decoration: none;
        font-family: 'Inter', serif;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 1px;
        transition: all 0.3s;
        background: white;
    }

    .cat-pill:hover, .cat-pill.active {
        background: var(--rajwadi-maroon);
        color: white;
        border-color: var(--rajwadi-maroon);
        transform: translateY(-3px);
    }

    .chronicle-card {
        background: white;
        border: 1px solid #f0f0f0;
        margin-bottom: 40px;
        transition: transform 0.4s;
        position: relative;
    }

    .chronicle-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(90, 25, 25, 0.08);
    }

    .chronicle-img-box {
        height: 280px;
        width: 100%;
        overflow: hidden;
        position: relative;
    }

    .chronicle-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s;
    }

    .chronicle-card:hover .chronicle-img-box img {
        transform: scale(1.1);
    }

    .chronicle-category-tag {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(255, 255, 255, 0.9);
        padding: 5px 15px;
        font-size: 0.6rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--rajwadi-maroon);
        z-index: 10;
    }

    .chronicle-body {
        padding: 35px;
    }

    .chronicle-date {
        font-size: 0.75rem;
        color: #999;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
        display: block;
    }

    .chronicle-title {
        font-family: 'Inter', serif;
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: var(--rajwadi-dark);
        line-height: 1.4;
    }

    .chronicle-excerpt {
        font-size: 0.95rem;
        color: #666;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .btn-read-more {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-family: 'Inter', serif;
        font-size: 0.75rem;
        font-weight: 900;
        color: var(--rajwadi-maroon);
        text-decoration: none;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: gap 0.3s;
    }

    .btn-read-more:hover {
        gap: 15px;
    }

    @media (max-width: 768px) {
        .chronicles-hero h1 { font-size: 2.5rem; }
    }
</style>

<section class="chronicles-hero">
    <div class="container">
        <h1>Royal Chronicles</h1>
        <p>A legacy of brilliance, told through timeless chapters</p>
    </div>
</section>

<div class="blog-grid-container">
    @if(isset($categories))
    <div class="category-filter">
        <a href="{{ route('blog.index') }}" class="cat-pill {{ !isset($category) ? 'active' : '' }}">All Chronicles</a>
        @foreach($categories as $cat)
            <a href="{{ route('blog.category', $cat->slug) }}" class="cat-pill {{ (isset($category) && $category->id == $cat->id) ? 'active' : '' }}">
                {{ $cat->name }}
            </a>
        @endforeach
    </div>
    @endif

    <div class="row">
        @if($posts->count() > 0)
            @foreach($posts as $post)
            <div class="col-lg-4 col-md-6">
                <article class="chronicle-card">
                    <div class="chronicle-img-box">
                        <span class="chronicle-category-tag">{{ $post->category->name }}</span>
                        <img src="{{ asset($post->featured_image ?? 'assets/images/placeholder.jpg') }}" alt="{{ $post->title }}">
                    </div>
                    <div class="chronicle-body">
                        <span class="chronicle-date">{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                        <h2 class="chronicle-title">{{ $post->title }}</h2>
                        <p class="chronicle-excerpt">
                            {{ Str::limit(strip_tags($post->summary ?? $post->content), 120) }}
                        </p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn-read-more">
                            Explore Chapter <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </article>
            </div>
            @endforeach
        @else
            <div class="col-12 text-center py-5">
                <h3 class="text-muted italic">No chronicles have been recorded in this category yet.</h3>
            </div>
        @endif
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $posts->links() }}
    </div>
</div>

@include('frontend.footer')

