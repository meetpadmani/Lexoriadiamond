<!-- Image Gallery Section: Cinematic Image Swiper -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

<section class="social-gallery-section" style="background-color: #fcf8f2; border-top: 1px solid rgba(0, 0, 0, 0.2);">
    <!-- Royal Jali Pattern Overlay -->
    <div class="gallery-bg-pattern"></div>
    
    <div class="gallery-header">
        <span class="section-subtitle">Discover Our Masterpieces</span>
        <h2 class="section-title">The Heritage Collection</h2>
    </div>
    <div class="gallery-container">
        <!-- Swiper -->
        <div class="swiper image-gallery-swiper">
            <div class="swiper-wrapper">
                @php
                    $galleryImages = \App\Models\GalleryImage::where('is_active', true)->orderBy('order')->get();
                @endphp

                @if($galleryImages->count() > 0)
                    @php
                        // Duplicate images to ensure smooth continuous loop
                        $renderImages = collect($galleryImages);
                        while($renderImages->count() < 8 && $renderImages->count() > 0) {
                            $renderImages = $renderImages->merge($galleryImages);
                        }
                    @endphp
                    @foreach($renderImages as $image)
                        @php
                            $imageUrl = str_starts_with($image->image_path, 'http') ? $image->image_path : asset($image->image_path);
                        @endphp
                        <div class="swiper-slide gallery-item">
                            <span class="hashtag">#LexoriaHeritage</span>
                            <div class="image-wrapper">
                                <!-- High Performance Static Image -->
                                <img src="{{ $imageUrl }}" class="gallery-video" alt="Gallery Image" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Fallback: Placeholder Images if none in DB (Optional) -->
                    @for($i = 1; $i <= 5; $i++)
                        <div class="swiper-slide gallery-item">
                            <span class="hashtag">#ComingSoon</span>
                            <div class="image-wrapper">
                                <div class="placeholder-video-box">
                                    <i class="bi bi-image"></i>
                                    <p>Image Loading...</p>
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

<!-- We don't need to redeclare all the CSS since it's identical to home4.blade.php -->
<!-- Just override any specific colors if necessary -->

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
    /* Force linear transition for continuous scroll effect */
    .image-gallery-swiper .swiper-wrapper {
        transition-timing-function: linear !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageSwiper = new Swiper('.image-gallery-swiper', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 1.5,
            loop: true,
            coverflowEffect: {
                rotate: 15,
                stretch: 0,
                depth: 300,
                modifier: 1.2,
                slideShadows: false,
            },
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
                pauseOnMouseEnter: true, // Pause on hover to view image clearly
            },
            speed: 3500, // Slow, continuous slide speed
            breakpoints: {
                480: { slidesPerView: 2 },
                768: { slidesPerView: 2.5 },
                1024: { slidesPerView: 3 },
                1400: { slidesPerView: 3.5 }
            }
        });
    });
</script>

