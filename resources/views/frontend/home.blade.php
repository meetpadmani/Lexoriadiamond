@if(isset($posters) && $posters->count() > 0)
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        .poster-slider-section {
            padding: 20px 0; /* Reduced padding */
            background-color: #ffffff;
            position: relative;
            overflow: hidden;
        }

        .poster-swiper {
            width: 100%;
            max-width: 100%; /* Allow edge bleeding */
            margin: 0 auto;
            padding: 0; 
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        .poster-swiper .swiper-slide {
            height: auto; 
            border-radius: 12px; /* Slightly more rounded */
            overflow: hidden;
            position: relative;
            transition: transform 0.8s cubic-bezier(0.165, 0.84, 0.44, 1), opacity 0.8s;
            opacity: 0.5; /* Dim adjacent slides */
            transform: scale(0.9); /* Slightly shrink adjacent slides */
        }

        .poster-swiper .swiper-slide-active {
            z-index: 10;
            opacity: 1; /* Full opacity for active */
            transform: scale(1); /* Full size for active */
        }

        .poster-slide-img {
            width: 100%;
            height: auto;
            object-fit: contain;
            display: block;
        }

        /* Diamond Pagination */
        .poster-swiper .swiper-pagination {
            bottom: -40px !important;
            position: absolute;
        }

        .poster-swiper .swiper-pagination-bullet {
            width: 10px;
            height: 10px;
            background: transparent;
            border: 1px solid #333333;
            opacity: 0.5;
            transform: rotate(45deg);
            border-radius: 0;
            margin: 0 8px !important;
            transition: all 0.3s ease;
        }

        .poster-swiper .swiper-pagination-bullet-active {
            background: #333333;
            opacity: 1;
            transform: rotate(45deg) scale(1.2);
        }

        @media (max-width: 768px) {
            .poster-slider-section {
                padding: 15px 0;
            }
        }
    </style>

    <section class="poster-slider-section">
        <div class="swiper poster-swiper">
            <div class="swiper-wrapper">
                @php
                    $displayPosters = $posters;
                    // If there are less than 4 posters, duplicate them so Swiper has enough slides for smooth infinite looping with fractional views
                    if($posters->count() > 0 && $posters->count() < 4) {
                        $displayPosters = $posters->concat($posters)->concat($posters);
                    }
                @endphp
                @foreach($displayPosters as $poster)
                    <div class="swiper-slide">
                        @if($poster->link)
                            <a href="{{ $poster->link }}">
                                <picture>
                                    @if($poster->mobile_image)
                                        <source media="(max-width: 768px)" srcset="{{ asset($poster->mobile_image) }}">
                                    @endif
                                    <img src="{{ asset($poster->image) }}" alt="{{ $poster->title }}" class="poster-slide-img">
                                </picture>
                            </a>
                        @else
                            <picture>
                                @if($poster->mobile_image)
                                    <source media="(max-width: 768px)" srcset="{{ asset($poster->mobile_image) }}">
                                @endif
                                <img src="{{ asset($poster->image) }}" alt="{{ $poster->title }}" class="poster-slide-img">
                            </picture>
                        @endif
                    </div>
                @endforeach
            </div>
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const swiper = new Swiper('.poster-swiper', {
                slidesPerView: 1.1, // Show parts of next/prev on mobile
                spaceBetween: 15,
                centeredSlides: true,
                loop: true,
                loopedSlides: 4, // Force extra clones for fractional slides
                watchSlidesProgress: true, // Fix visibility calculation
                speed: 800,
                autoplay: {
                    delay: 2400,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.poster-swiper .swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 1.2,
                        spaceBetween: 20
                    },
                    1200: {
                        slidesPerView: 1.4, // Show more of the side slides on desktop
                        spaceBetween: 30
                    }
                }
            });
        });
    </script>
@endif

