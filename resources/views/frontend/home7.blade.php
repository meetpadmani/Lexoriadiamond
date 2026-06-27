@if(isset($featuredProducts) && $featuredProducts->count() > 0)
    <section class="rajwadi-mini-gallery py-5"
        style="background: #fdfbf7; position: relative; overflow: hidden; border-top: 3px solid #333333;">

        <!-- Subtle Rajwadi Decor -->
        <div class="raj-mini-pattern"></div>
        <div class="raj-mini-filigree fl-tl"></div>
        <div class="raj-mini-filigree fl-tr"></div>

        <div class="container" style="position: relative; z-index: 10; max-width: 1200px;">
            <br>
            <center>
                <!-- Header: Centered & Compact -->
                <div class="row align-items-center mb-4">
                    <div class="col-md-3 d-none d-md-block">
                        <a href="{{ route('products') }}" class="raj-mini-nav">
                            <i class="bi bi-arrow-left me-1"></i>
                            <span>EXPLORE ALL</span>
                        </a>
                    </div>
                    <div class="col-md-6 text-center">
                        <span class="raj-mini-badge">Heritage Selection</span>
                        <h2 class="raj-mini-title">Signature Masterpieces</h2>
                    </div>
                    <div class="col-md-3 d-none d-md-block"></div>
                </div>
            </center>
            <!-- Compact Grid -->
            <div class="raj-mini-grid">
                @foreach($featuredProducts as $product)
                    @php
                        $cSlug = $product->collection ? $product->collection->slug : 'all';
                        $cTitle = $product->collection ? $product->collection->title : 'Signature Piece';
                    @endphp
                    <div class="raj-mini-col">
                        <div class="raj-mini-card">
                            <a href="{{ route('collections.product', [$cSlug, $product->slug]) }}" class="raj-mini-link">

                                <!-- Arched Jharokha (Reduced Size) -->
                                <div class="raj-mini-frame">
                                    <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset($product->image) }}"
                                        alt="{{ $product->name }}" class="raj-mini-img">

                                    <div class="raj-mini-overlay">
                                        <span>VIEW</span>
                                    </div>

                                    @if($product->original_price && $product->original_price > $product->price)
                                        <div class="raj-mini-tag">SHAHI</div>
                                    @endif
                                </div>

                                <!-- Content (Compact) -->
                                <div class="raj-mini-info text-center">
                                    <span class="raj-mini-cat">{{ $cTitle }}</span>
                                    <h4 class="raj-mini-name">{{ $product->name }}</h4>
                                    <div class="raj-mini-price">
                                        <span class="now">${{ number_format($product->price) }}</span>
                                        @if($product->original_price && $product->original_price > $product->price)
                                            <span class="old">${{ number_format($product->original_price) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </a>

                            <!-- Mini Actions -->
                            <div class="raj-mini-actions">
                                <form action="{{ route('wishlist.add') }}" method="POST" class="ajax-wishlist-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="mini-btn"><i class="bi bi-heart"></i></button>
                                </form>
                                <form action="{{ route('cart.add') }}" method="POST" class="ajax-atc-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="mini-btn"><i class="bi bi-bag-plus"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <br>
    </section>

    <style>
        /* COMPACT RAJWADI THEME */
        .raj-mini-pattern {
            position: absolute;
            inset: 0;
            opacity: 0.03;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%233d0a0a' stroke-width='1'/%3E%3C/svg%3E");
        }

        .raj-mini-filigree {
            position: absolute;
            width: 80px;
            height: 80px;
            opacity: 0.2;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0 0Q50 0 50 50Q0 50 0 0' fill='none' stroke='%23b58d55' stroke-width='1'/%3E%3C/svg%3E");
        }

        .fl-tl {
            top: 10px;
            left: 10px;
        }

        .fl-tr {
            top: 10px;
            right: 10px;
            transform: rotate(90deg);
        }

        /* HEADER */
        .raj-mini-badge {
            font-family: 'Inter', serif;
            color: #333333;
            font-size: 0.65rem;
            letter-spacing: 3px;
            font-weight: 700;
            display: block;
            margin-bottom: 5px;
        }

        .raj-mini-title {
            font-family: 'Inter', serif;
            color: #0F1F17;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .raj-mini-nav {
            text-decoration: none !important;
            color: #0F1F17 !important;
            font-family: 'Inter', serif;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1px;
            border-bottom: 1px solid #333333;
            padding-bottom: 2px;
        }

        /* GRID */
        .raj-mini-grid {
            display: flex !important;
            flex-wrap: wrap !important;
            justify-content: center !important;
            gap: 20px !important;
            padding-top: 20px;
        }

        .raj-mini-col {
            flex: 0 0 calc(25% - 20px);
            min-width: 220px;
            max-width: 260px;
        }

        /* CARD */
        .raj-mini-card {
            background: #fff;
            padding: 12px;
            border: 1px solid rgba(0, 0, 0, 0.15);
            transition: 0.4s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .raj-mini-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(61, 10, 10, 0.08);
            border-color: #333333;
        }

        .raj-mini-link {
            text-decoration: none !important;
            color: inherit !important;
        }

        /* FRAME (SMALLER ASPECT RATIO) */
        .raj-mini-frame {
            position: relative;
            aspect-ratio: 1 / 1.1;
            border-radius: 110px 110px 4px 4px;
            overflow: hidden;
            background: #fdfaf7;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .raj-mini-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: 1s ease;
        }

        .raj-mini-card:hover .raj-mini-img {
            transform: scale(1.08);
        }

        .raj-mini-overlay {
            position: absolute;
            inset: 0;
            background: rgba(61, 10, 10, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: 0.3s;
        }

        .raj-mini-card:hover .raj-mini-overlay {
            opacity: 1;
        }

        .raj-mini-overlay span {
            color: #fff;
            border: 1px solid #333333;
            padding: 6px 18px;
            font-size: 0.65rem;
            letter-spacing: 2px;
        }

        .raj-mini-tag {
            position: absolute;
            top: 15px;
            left: 0;
            background: #0F1F17;
            color: #333333;
            padding: 4px 12px;
            font-size: 0.55rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        /* INFO */
        .raj-mini-info {
            padding-top: 15px;
        }

        .raj-mini-cat {
            font-size: 0.6rem;
            color: #333333;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 700;
            display: block;
            margin-bottom: 4px;
        }

        .raj-mini-name {
            font-family: 'Inter', serif;
            color: #0F1F17;
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 8px;
            line-height: 1.3;
            min-height: 2.6rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .raj-mini-price .now {
            font-weight: 800;
            color: #0F1F17;
            font-size: 1rem;
        }

        .raj-mini-price .old {
            color: #aaa;
            text-decoration: line-through;
            font-size: 0.8rem;
            margin-left: 8px;
        }

        /* ACTIONS */
        .raj-mini-actions {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 15px;
            opacity: 0;
            transition: 0.3s;
        }

        .raj-mini-card:hover .raj-mini-actions {
            opacity: 1;
        }

        .mini-btn {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: #0F1F17;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.2s;
            font-size: 0.9rem;
        }

        .mini-btn:hover {
            background: #0F1F17;
            color: #333333;
        }

        /* RESPONSIVE */
        @media (max-width: 992px) {
            .raj-mini-col {
                flex: 0 0 calc(50% - 20px);
            }
        }

        @media (max-width: 768px) {
            .raj-mini-grid {
                gap: 15px !important;
            }

            .raj-mini-col {
                flex: 0 0 calc(50% - 15px);
                min-width: 150px;
            }

            .raj-mini-actions {
                opacity: 1;
            }
        }
    </style>
@endif

