@if(isset($collectionsWithFeatured) && $collectionsWithFeatured->count() > 0)
    <section class="cinematic-lookbook">
        <!-- Sidebar Navigation -->
        <div class="lookbook-sidebar">
            <h2 class="lookbook-title">The Royal Edit</h2>
            <p class="lookbook-desc">Explore our masterpieces curated by categories. Swipe to discover the brilliance of Lexoria.</p>
            <div class="category-tabs">
                @foreach($collectionsWithFeatured as $index => $collection)
                    <button class="category-tab {{ $index === 0 ? 'active' : '' }}" onclick="switchLookbookCategory('cat-{{ $collection->id }}', this)">
                        {{ $collection->title }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Dynamic Category Displays -->
        <div class="lookbook-display">
            @foreach($collectionsWithFeatured as $index => $collection)
                <div class="category-slide {{ $index === 0 ? 'active' : '' }}" id="cat-{{ $collection->id }}">
                    <!-- Category Hero Background -->
                    <div class="category-hero-bg">
                        <img src="{{ str_starts_with($collection->image, 'http') ? $collection->image : asset($collection->image) }}" alt="{{ $collection->title }}">
                        <div class="bg-overlay"></div>
                    </div>
                    
                    <!-- Horizontal Featured Products Scroller -->
                    <div class="featured-products-scroller">
                        @forelse($collection->products as $product)
                            <a href="{{ route('collections.product', ['collectionSlug' => $collection->slug, 'productSlug' => $product->slug]) }}" class="lookbook-product-card">
                                <div class="product-img-wrapper">
                                    <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset($product->image) }}" alt="{{ $product->name }}">
                                    @if($product->image2)
                                        <img src="{{ str_starts_with($product->image2, 'http') ? $product->image2 : asset($product->image2) }}" class="hover-img" alt="{{ $product->name }}">
                                    @endif
                                    <div class="glass-btn">View Details</div>
                                </div>
                                <div class="product-info">
                                    <h3>{{ $product->name }}</h3>
                                    <p class="price">${{ number_format($product->price) }}</p>
                                </div>
                            </a>
                        @empty
                            <div style="display: flex; align-items: center; height: 100%; color: rgba(255,255,255,0.6); font-family: 'Inter', sans-serif;">
                                <p class="no-products">Masterpieces coming soon in this collection.</p>
                            </div>
                        @endforelse
                        
                        <!-- View All Card -->
                        <a href="{{ route('collections.show', $collection->slug) }}" class="view-all-card">
                            <span>Explore All<br>{{ $collection->title }}</span>
                            <div class="arrow">→</div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap');

        .cinematic-lookbook {
            display: flex;
            width: 100%;
            height: 100vh;
            min-height: 700px;
            background: #0a0a0f;
            position: relative;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
            border-top: 1px solid rgba(201, 169, 110, 0.2);
            border-bottom: 1px solid rgba(201, 169, 110, 0.2);
        }
        
        .lookbook-sidebar {
            width: 30%;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: rgba(10, 10, 15, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            z-index: 10;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .lookbook-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            color: #C9A96E;
            font-weight: 400;
            margin-bottom: 20px;
            line-height: 1.1;
        }

        .lookbook-desc {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 50px;
            max-width: 90%;
        }

        .category-tabs {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .category-tab {
            background: transparent;
            border: none;
            color: rgba(255, 255, 255, 0.65);
            text-align: left;
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            padding: 10px 0;
            cursor: pointer;
            transition: all 0.4s ease;
            position: relative;
            display: inline-flex;
            align-items: center;
            width: fit-content;
        }

        .category-tab::before {
            content: '';
            width: 0;
            height: 2px;
            background: #C9A96E;
            margin-right: 0;
            transition: all 0.4s ease;
        }

        .category-tab:hover {
            color: rgba(255, 255, 255, 0.8);
            transform: translateX(10px);
        }

        .category-tab.active {
            color: #ffffff;
            transform: translateX(20px);
        }

        .category-tab.active::before {
            width: 30px;
            margin-right: 15px;
        }

        .lookbook-display {
            width: 70%;
            height: 100%;
            position: relative;
        }

        .category-slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.8s ease, visibility 0.8s ease;
            display: flex;
            align-items: center;
            padding-left: 50px;
        }

        .category-slide.active {
            opacity: 1;
            visibility: visible;
            z-index: 5;
        }

        .category-hero-bg {
            position: absolute;
            inset: 0;
            z-index: -1;
        }

        .category-hero-bg img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scale(1.1);
            transition: transform 10s ease;
        }

        .category-slide.active .category-hero-bg img {
            transform: scale(1);
        }

        .bg-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, #0a0a0f 0%, rgba(10,10,15,0.4) 100%);
        }

        .featured-products-scroller {
            display: flex;
            gap: 30px;
            overflow-x: auto;
            padding: 40px 40px 40px 0;
            scroll-snap-type: x mandatory;
            scrollbar-width: none; /* Firefox */
            width: 100%;
        }

        .featured-products-scroller::-webkit-scrollbar {
            display: none;
        }

        .lookbook-product-card {
            flex: 0 0 320px;
            scroll-snap-align: start;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            transform: translateY(30px);
            opacity: 0;
            transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            background: linear-gradient(145deg, rgba(20, 25, 22, 0.85) 0%, rgba(10, 15, 12, 0.95) 100%);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(201, 169, 110, 0.3);
            border-radius: 8px;
            padding: 15px;
        }
        
        .lookbook-product-card:hover {
            border-color: rgba(201, 169, 110, 0.6);
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
            transform: translateY(-5px);
        }

        .category-slide.active .lookbook-product-card {
            transform: translateY(0);
            opacity: 1;
        }

        /* Staggered animations */
        .category-slide.active .lookbook-product-card:nth-child(1) { transition-delay: 0.2s; }
        .category-slide.active .lookbook-product-card:nth-child(2) { transition-delay: 0.3s; }
        .category-slide.active .lookbook-product-card:nth-child(3) { transition-delay: 0.4s; }
        .category-slide.active .lookbook-product-card:nth-child(4) { transition-delay: 0.5s; }
        .category-slide.active .lookbook-product-card:nth-child(5) { transition-delay: 0.6s; }

        .product-img-wrapper {
            width: 100%;
            height: 360px;
            border-radius: 4px;
            overflow: hidden;
            position: relative;
            background: #ffffff;
            border-bottom: 2px solid #C9A96E;
        }

        .product-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease, opacity 0.6s ease;
        }

        .product-img-wrapper .hover-img {
            position: absolute;
            inset: 0;
            opacity: 0;
        }

        .lookbook-product-card:hover .product-img-wrapper img:not(.hover-img) {
            opacity: 0;
        }

        .lookbook-product-card:hover .product-img-wrapper .hover-img {
            opacity: 1;
            transform: scale(1.05);
        }

        .glass-btn {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: rgba(201, 169, 110, 0.9);
            color: #0a0a0f;
            padding: 10px 25px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            opacity: 0;
            transition: all 0.4s ease;
            white-space: nowrap;
        }

        .lookbook-product-card:hover .glass-btn {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }

        .product-info {
            text-align: center;
            padding: 20px 10px 10px 10px;
        }

        .product-info h3 {
            color: #ffffff;
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            font-style: italic;
            letter-spacing: 1px;
            font-weight: 400;
            margin: 0 0 8px 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-info .price {
            color: #C9A96E;
            font-size: 1.1rem;
            margin: 0;
            letter-spacing: 1.5px;
            font-family: 'Inter', sans-serif;
        }

        .view-all-card {
            flex: 0 0 320px;
            height: 470px;
            scroll-snap-align: start;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: rgba(15, 31, 23, 0.4);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(201, 169, 110, 0.2);
            border-radius: 8px;
            transition: all 0.4s ease;
            transform: translateY(30px);
            opacity: 0;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .category-slide.active .view-all-card {
            transform: translateY(0);
            opacity: 1;
            transition-delay: 0.7s;
        }

        .view-all-card:hover {
            background: rgba(201, 169, 110, 0.1);
            border-color: rgba(201, 169, 110, 0.5);
        }

        .view-all-card span {
            color: #ffffff;
            font-family: 'Playfair Display', serif;
            font-size: 1.4rem;
            text-align: center;
            line-height: 1.4;
            margin-bottom: 20px;
        }

        .view-all-card .arrow {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #C9A96E;
            color: #0a0a0f;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            transition: transform 0.4s ease;
        }

        .view-all-card:hover .arrow {
            transform: translateX(10px);
        }

        /* Mobile Responsive */
        @media (max-width: 992px) {
            .cinematic-lookbook {
                flex-direction: column;
                height: auto;
                min-height: 100vh;
            }

            .lookbook-sidebar {
                width: 100%;
                padding: 40px 20px;
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            }

            .lookbook-title {
                font-size: 2.8rem;
            }

            .category-tabs {
                flex-direction: row;
                overflow-x: auto;
                padding-bottom: 15px;
                gap: 25px;
                scrollbar-width: none;
            }

            .category-tabs::-webkit-scrollbar { display: none; }

            .category-tab {
                font-size: 1.4rem;
                white-space: nowrap;
            }

            .category-tab.active {
                transform: translateX(0);
            }

            .category-tab.active::before {
                display: none;
            }
            
            .category-tab::after {
                content: '';
                position: absolute;
                bottom: 0; left: 0;
                width: 0;
                height: 2px;
                background: #C9A96E;
                transition: width 0.3s;
            }

            .category-tab.active::after {
                width: 100%;
            }

            .lookbook-display {
                width: 100%;
                height: 600px;
            }

            .category-slide {
                padding-left: 20px;
            }
            
            .bg-overlay {
                background: linear-gradient(0deg, #0a0a0f 0%, rgba(10,10,15,0.7) 100%);
            }

            .featured-products-scroller {
                padding: 40px 20px 40px 0;
            }

            .lookbook-product-card {
                flex: 0 0 240px;
            }

            .product-img-wrapper {
                height: 300px;
            }

            .view-all-card {
                flex: 0 0 240px;
                height: 300px;
            }
        }
    </style>

    <script>
        function switchLookbookCategory(targetId, btnElement) {
            // Remove active from all tabs
            document.querySelectorAll('.category-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            // Add active to clicked tab
            btnElement.classList.add('active');

            // Remove active from all slides
            document.querySelectorAll('.category-slide').forEach(slide => {
                slide.classList.remove('active');
            });
            // Add active to target slide
            document.getElementById(targetId).classList.add('active');
        }
    </script>
@endif
