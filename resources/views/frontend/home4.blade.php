<!-- Social Gallery Section: Dynamic Autoplay Video Swipe Gallery -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<section class="social-gallery-section">
    <!-- Royal Jali Pattern Overlay -->
    <div class="gallery-bg-pattern"></div>

    <div class="gallery-header">
        <span class="section-subtitle">Experience The Art Of Detail</span>
        <h2 class="section-title">Watch And Shop</h2>
    </div>
    <div class="gallery-container">
        <!-- Swiper -->
        <div class="swiper video-gallery-swiper">
            <div class="swiper-wrapper">
                @php
                    $videoOnlyProducts = isset($videoProducts) ? $videoProducts->filter(fn($p) => !empty($p->video_path)) : collect();
                @endphp

                @if($videoOnlyProducts->count() > 0)
                    @foreach($videoOnlyProducts as $product)
                        @php
                            $videoPath = $product->video_path;
                            if (str_starts_with($videoPath, 'http')) {
                                $videoUrl = $videoPath;
                            } elseif (str_starts_with($videoPath, 'storage/')) {
                                $videoUrl = asset($videoPath);
                            } else {
                                $videoUrl = Storage::disk('public')->url($videoPath);
                            }

                            $imageUrl = $product->product_image ? (str_starts_with($product->product_image, 'http') ? $product->product_image : Storage::disk('public')->url($product->product_image)) : null;
                        @endphp
                        <div class="swiper-slide gallery-item">
                            <a href="{{ route('watch-and-shop.detail', $product->slug) }}" class="piece-link-wrapper">
                                <span class="hashtag">#{{ ltrim($product->product_name ?? 'Lexoria', '#') }}</span>
                                <div class="image-wrapper">
                                    <!-- High Performance Autoplay Video -->
                                    <video class="gallery-video" loop muted autoplay playsinline preload="auto">
                                        <source src="{{ $videoUrl }}" type="video/mp4">
                                    </video>

                                    <!-- Image that shows ONLY on pointer/hover -->
                                    @if($imageUrl)
                                        <img src="{{ $imageUrl }}" class="hover-product-image" alt="{{ $product->product_name }}">
                                    @endif

                                    <!-- Refined Royal Play Marker -->
                                    <div class="royal-play-marker">
                                        <div class="play-ripple"></div>
                                        <i class="bi bi-play-fill"></i>
                                    </div>

                                    <div class="hover-overlay">
                                        <span class="overlay-name">{{ $product->product_name }}</span>
                                        <div class="price-box">
                                            @if($product->current_price)
                                                <span class="current-price">${{ number_format($product->current_price, 0) }}</span>
                                            @endif
                                            @if($product->original_price && $product->original_price > $product->current_price)
                                                <span class="original-price">${{ number_format($product->original_price, 0) }}</span>
                                            @endif
                                        </div>
                                        <span class="shop-now">Shop The Look</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                    @endforeach
                @else
                    <!-- Fallback: Placeholder Videos if none in DB (Optional) -->
                    @for($i = 1; $i <= 5; $i++)
                        <div class="swiper-slide gallery-item">
                            <span class="hashtag">#ComingSoon</span>
                            <div class="image-wrapper">
                                <div class="placeholder-video-box">
                                    <i class="bi bi-camera-video"></i>
                                    <p>Video Loading...</p>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endif
            </div>
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
</section>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap');

    .social-gallery-section {
        padding: 80px 0;
        background-color: #fcf9f5;
        position: relative;
        overflow: hidden;
    }

    .gallery-bg-pattern {
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%235a1919' stroke-opacity='0.02' stroke-width='1'/%3E%3C/svg%3E");
        z-index: 0;
    }

    .gallery-header {
        text-align: center;
        margin-bottom: 50px;
        position: relative;
        z-index: 1;
    }

    .gallery-header .section-subtitle {
        font-family: 'Inter', serif;
        font-size: 0.8rem;
        color: #333333;
        text-transform: uppercase;
        letter-spacing: 5px;
        margin-bottom: 12px;
        display: block;
    }

    .gallery-header .section-title {
        font-family: 'Inter', serif;
        font-size: 2.8rem;
        color: #0a1c0f;
        font-weight: 700;
        letter-spacing: 1px;
    }

    .gallery-container {
        width: 100%;
        padding: 0 40px;
        position: relative;
        z-index: 1;
    }

    .video-gallery-swiper {
        width: 100%;
        padding: 20px 0 60px 0 !important;
    }

    .gallery-item {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .piece-link-wrapper {
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .hashtag {
        font-family: 'Inter', serif;
        font-size: 0.65rem;
        font-weight: 700;
        color: #333333;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        margin-bottom: 12px;
        text-align: center;
        opacity: 0.8;
    }

    .image-wrapper {
        position: relative;
        width: 100%;
        aspect-ratio: 4 / 6.2;
        border-radius: 200px 200px 0 0;
        overflow: hidden;
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.3);
        box-shadow: 0 20px 40px rgba(58, 13, 13, 0.06);
        transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    /* Elegant Inner Gold Rim */
    .image-wrapper::after {
        content: '';
        position: absolute;
        inset: 10px;
        border: 1px solid rgba(0, 0, 0, 0.4);
        border-radius: 190px 190px 0 0;
        z-index: 5;
        pointer-events: none;
        transition: all 0.5s ease;
    }

    .gallery-video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 1.2s ease;
    }

    .hover-product-image {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
        opacity: 0;
        transition: opacity 0.6s ease;
    }

    /* Refined Royal Play Marker */
    .royal-play-marker {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 2;
        color: #fff;
        font-size: 1.5rem;
        padding-left: 3px;
        transition: all 0.5s ease;
    }

    .play-ripple {
        position: absolute;
        inset: -8px;
        border: 1px solid rgba(0, 0, 0, 0.3);
        border-radius: 50%;
        animation: marker-ripple 2s infinite;
    }

    @keyframes marker-ripple {
        0% { transform: scale(1); opacity: 0.8; }
        100% { transform: scale(1.4); opacity: 0; }
    }

    .hover-overlay {
        position: absolute;
        inset: 0;
        background: transparent;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-end;
        padding: 40px 20px;
        color: #fff;
        opacity: 0;
        transition: all 0.5s ease;
        text-align: center;
        z-index: 6;
    }

    .overlay-name {
        font-family: 'Inter', serif;
        font-size: 1.2rem;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .price-box { margin-bottom: 20px; }
    .current-price { color: #333333; font-weight: 700; }
    .original-price { font-size: 0.8rem; text-decoration: line-through; opacity: 0.5; margin-left: 8px; }

    .shop-now {
        font-family: 'Inter', serif;
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 2.5px;
        border-bottom: 1px solid #333333;
        padding-bottom: 4px;
        color: #333333;
    }

    /* Hover States */
    .gallery-item:hover .image-wrapper {
        transform: translateY(-8px);
        box-shadow: 0 30px 60px rgba(58, 13, 13, 0.12);
        border-color: #333333;
    }

    .gallery-item:hover .image-wrapper::after {
        inset: 15px;
        border-color: #333333;
    }

    .gallery-item:hover .gallery-video {
        transform: scale(1.05);
    }

    .gallery-item:hover .hover-product-image {
        opacity: 1;
    }

    .gallery-item:hover .royal-play-marker {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0.8);
    }

    .gallery-item:hover .hover-overlay {
        opacity: 1;
    }

    /* Pagination */
    .video-gallery-swiper .swiper-pagination-bullet {
        background: #333333;
        opacity: 0.3;
        width: 10px;
        height: 10px;
        transition: all 0.3s ease;
    }

    .video-gallery-swiper .swiper-pagination-bullet-active {
        opacity: 1;
        background: #0a1c0f;
        transform: scale(1.4);
    }

    @media (max-width: 768px) {
        .social-gallery-section { padding: 50px 0; }
        .gallery-header { margin-bottom: 30px; padding: 0 20px; }
        .gallery-header .section-subtitle { font-size: 0.6rem; letter-spacing: 3px; }
        .gallery-header .section-title { font-size: 2.2rem; }
        .gallery-container { padding: 0 15px; }
        
        .image-wrapper { 
            border-radius: 180px 180px 0 0; 
            aspect-ratio: 4 / 7; /* Taller for mobile */
        }
        .image-wrapper::after { border-radius: 170px 170px 0 0; }
        
        /* Ensure details are visible on mobile since there is no hover */
        .hover-overlay { 
            opacity: 1; 
            background: transparent;
            padding: 30px 15px;
        }
        .overlay-name { font-size: 1rem; }
        .price-box { margin-bottom: 15px; }

        .royal-play-marker {
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
            top: 40%;
        }
    }

    @media (max-width: 480px) {
        .gallery-header .section-title { font-size: 1.8rem; }
        .image-wrapper { border-radius: 150px 150px 0 0; }
        .image-wrapper::after { border-radius: 140px 140px 0 0; }
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const videoSwiper = new Swiper('.video-gallery-swiper', {
            slidesPerView: 1.2,
            centeredSlides: true,
            spaceBetween: 15,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            speed: 1200,
            pagination: {
                el: '.video-gallery-swiper .swiper-pagination',
                clickable: true,
            },
            breakpoints: {
                480: { 
                    slidesPerView: 1.8,
                    centeredSlides: false,
                    spaceBetween: 20
                },
                768: { 
                    slidesPerView: 3.2,
                    centeredSlides: false,
                    spaceBetween: 25 
                },
                1024: { 
                    slidesPerView: 4.2,
                    centeredSlides: false,
                    spaceBetween: 30 
                }
            }
        });
    });
</script>


