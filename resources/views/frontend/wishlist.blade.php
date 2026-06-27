@include('frontend.navbar')

<style>
    :root {
        --raj-maroon: #0F1F17;
        --raj-maroon-deep: #000000;
        --raj-gold: #333333;
        --raj-gold-dark: #333333;
        --raj-sand: #ffffff;
        --raj-sand-light: #fdfaf7;
        --raj-grey: #8a735a;
        --raj-border: rgba(0, 0, 0, 0.3);
        --font-heading: 'Inter', serif;
        --font-accent: 'Inter', serif;
        --font-body: 'Outfit', sans-serif;
    }

    body {
        background-color: var(--raj-sand);
        background-image:
            radial-gradient(ellipse at top right, rgba(0, 0, 0, 0.12) 0%, transparent 60%),
            radial-gradient(ellipse at bottom left, rgba(90, 25, 25, 0.08) 0%, transparent 50%);
        font-family: var(--font-body);
        color: var(--raj-maroon);
    }

    .wishlist-bg-pattern {
        position: fixed;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%235a1919' stroke-opacity='0.03' stroke-width='1'/%3E%3Ccircle cx='30' cy='30' r='10' fill='none' stroke='%23b58d55' stroke-opacity='0.04' stroke-width='1'/%3E%3C/svg%3E");
        z-index: -1;
        pointer-events: none;
    }

    .wishlist-page {
        max-width: 1400px;
        margin: 0 auto;
        padding: 60px 40px 100px;
    }

    /* ===== ROYAL HEADER ===== */
    .wishlist-royal-header {
        text-align: center;
        margin-bottom: 70px;
    }

    .wishlist-royal-header .sub-text {
        font-family: var(--font-body);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 6px;
        color: var(--raj-gold);
        margin-bottom: 15px;
        display: block;
        font-weight: 500;
    }

    .wishlist-royal-header h1 {
        font-family: var(--font-heading);
        font-size: clamp(2.5rem, 5vw, 3.5rem);
        color: var(--raj-maroon);
        margin: 0 0 20px;
        font-weight: 600;
    }

    .rajwadi-motif {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
        margin-bottom: 15px;
    }

    .rajwadi-motif::before, .rajwadi-motif::after {
        content: '';
        height: 2px;
        width: 100px;
        background: linear-gradient(90deg, transparent, var(--raj-gold), transparent);
    }

    .wishlist-count {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--raj-grey);
    }

    /* ===== WISHLIST GRID ===== */
    .wishlist-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }

    .wishlist-card {
        position: relative;
        background: #fff;
        border: 1px solid var(--raj-border);
        transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        overflow: hidden;
    }

    .wishlist-card::before {
        content: '';
        position: absolute;
        inset: 5px;
        border: 1px dashed rgba(0, 0, 0, 0.15);
        pointer-events: none;
        z-index: 2;
        transition: all 0.5s ease;
    }

    .wishlist-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px rgba(90, 25, 25, 0.15);
        border-color: var(--raj-gold);
    }

    .wishlist-card:hover::before {
        border-color: rgba(0, 0, 0, 0.4);
        inset: 8px;
    }

    .wishlist-card-img {
        position: relative;
        overflow: hidden;
    }

    .wishlist-card-img img {
        width: 100%;
        aspect-ratio: 1/1;
        object-fit: cover;
        transition: transform 1.2s cubic-bezier(0.19, 1, 0.22, 1);
        display: block;
    }

    .wishlist-card:hover img {
        transform: scale(1.08);
    }

    .btn-remove-wishlist {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 32px;
        height: 32px;
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid var(--raj-border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--raj-grey);
        cursor: pointer;
        transition: all 0.3s ease;
        z-index: 3;
        font-size: 1rem;
    }

    .btn-remove-wishlist:hover {
        background: var(--raj-maroon);
        color: var(--raj-gold);
        border-color: var(--raj-maroon);
    }

    .wishlist-card-info {
        padding: 25px 20px;
        text-align: center;
        background: #fff;
        border-top: 1px solid rgba(0, 0, 0, 0.1);
    }

    .wishlist-card-name {
        font-family: var(--font-heading);
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 8px;
        color: var(--raj-maroon);
    }

    .wishlist-card-price {
        color: var(--raj-gold);
        font-weight: 700;
        font-size: 1.1rem;
        margin-bottom: 18px;
    }

    .btn-add-to-bag {
        display: block;
        width: 100%;
        padding: 14px;
        background: var(--raj-maroon);
        color: var(--raj-gold);
        text-align: center;
        text-decoration: none;
        font-family: var(--font-accent);
        font-weight: 700;
        font-size: 0.7rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        cursor: pointer;
        border: 1px solid var(--raj-maroon);
        transition: all 0.3s ease;
    }

    .btn-add-to-bag:hover {
        background: var(--raj-gold);
        color: var(--raj-maroon);
        border-color: var(--raj-gold);
    }

    /* ===== EMPTY STATE ===== */
    .empty-wishlist {
        text-align: center;
        padding: 100px 20px;
    }

    .empty-wishlist-icon {
        font-size: 5rem;
        color: var(--raj-maroon);
        opacity: 0.12;
        margin-bottom: 30px;
        display: block;
    }

    .empty-wishlist h2 {
        font-family: var(--font-heading);
        font-size: 2rem;
        color: var(--raj-maroon);
        margin-bottom: 15px;
    }

    .empty-wishlist p {
        color: var(--raj-grey);
        margin-bottom: 35px;
        line-height: 1.8;
    }

    .btn-explore {
        display: inline-block;
        padding: 18px 50px;
        background: var(--raj-maroon);
        color: var(--raj-gold);
        text-decoration: none;
        font-family: var(--font-accent);
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 3px;
        border: 2px solid var(--raj-gold);
        transition: all 0.4s ease;
    }

    .btn-explore:hover {
        background: var(--raj-gold);
        color: var(--raj-maroon);
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(90, 25, 25, 0.2);
    }

    /* ===== ANIMATIONS ===== */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-in {
        animation: fadeInUp 0.8s cubic-bezier(0.19, 1, 0.22, 1) forwards;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
        .wishlist-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .wishlist-page {
            padding: 40px 20px 80px;
        }
    }

    @media (max-width: 768px) {
        .wishlist-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .wishlist-royal-header h1 {
            font-size: 2rem;
        }

        .wishlist-royal-header .sub-text {
            letter-spacing: 3px;
            font-size: 0.7rem;
        }

        .wishlist-card-info {
            padding: 15px 12px;
        }

        .wishlist-card-name {
            font-size: 0.95rem;
        }

        .wishlist-card-price {
            font-size: 1rem;
        }
    }
</style>

<div class="wishlist-bg-pattern"></div>

<div class="wishlist-page">
    <header class="wishlist-royal-header animate-in">
        <span class="sub-text">Personal Treasury</span>
        <h1>Your Favorites</h1>
        <div class="rajwadi-motif">
            <svg width="30" height="30" viewBox="0 0 100 100" fill="none">
                <path d="M50 10 L60 40 L90 50 L60 60 L50 90 L40 60 L10 50 L40 40 Z" fill="#333333"/>
            </svg>
        </div>
        <p class="wishlist-count" id="wishlistCountStr">{{ count($wishlistItems) }} Pieces Saved for your special moments</p>
    </header>

    <div id="wishlistContainer">
        @if(count($wishlistItems) > 0)
            <div class="wishlist-grid">
                @foreach($wishlistItems as $id => $product)
                    <div class="wishlist-card animate-in" data-id="{{ $id }}" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                        <div class="wishlist-card-img">
                            <button type="button" class="btn-remove-wishlist ajax-wishlist-remove" data-id="{{ $id }}"
                                title="Remove from Favorites">
                                <i class="bi bi-x"></i>
                            </button>
                            <img src="{{ str_starts_with($product['image'], 'http') ? $product['image'] : asset($product['image']) }}"
                                alt="{{ $product['name'] }}">
                        </div>
                        <div class="wishlist-card-info">
                            <div class="wishlist-card-name">{{ $product['name'] }}</div>
                            <div class="wishlist-card-price">${{ number_format($product['price']) }}</div>

                            <form action="{{ route('cart.add') }}" method="POST" class="ajax-atc-form">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $id }}">
                                <button type="submit" class="btn-add-to-bag">Add to Bag</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-wishlist">
                <i class="bi bi-heart empty-wishlist-icon"></i>
                <h2>Your Treasury Awaits</h2>
                <p>Your wishlist is waiting for its first spark of brilliance.</p>
                <a href="{{ route('collections') }}" class="btn-explore">Explore Masterpieces</a>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.body.addEventListener('click', function (e) {
            if (e.target.closest('.ajax-wishlist-remove')) {
                const btn = e.target.closest('.ajax-wishlist-remove');
                const id = btn.dataset.id;
                const card = btn.closest('.wishlist-card');

                const formData = new FormData();
                formData.append('id', id);
                formData.append('_token', '{{ csrf_token() }}');

                fetch('{{ route("wishlist.remove") }}', {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            card.style.opacity = '0';
                            card.style.transform = 'scale(0.9)';
                            card.style.transition = 'all 0.5s ease';

                            setTimeout(() => {
                                card.remove();
                                const countStr = document.getElementById('wishlistCountStr');
                                if (countStr) countStr.textContent = `${data.count} Pieces Saved for your special moments`;

                                if (data.count === 0) {
                                    document.getElementById('wishlistContainer').innerHTML = `
                                    <div class="empty-wishlist">
                                        <i class="bi bi-heart empty-wishlist-icon"></i>
                                        <h2>Your Treasury Awaits</h2>
                                        <p>Your wishlist is waiting for its first spark of brilliance.</p>
                                        <a href="{{ route('collections') }}" class="btn-explore">Explore Masterpieces</a>
                                    </div>
                                `;
                                }

                                if (typeof showNotification === 'function') {
                                    showNotification(data.message);
                                }
                            }, 500);
                        }
                    });
            }
        });
    });
</script>

@include('frontend.footer')

