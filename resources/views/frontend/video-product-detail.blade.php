@include('frontend.navbar')

<!-- Google Fonts -->
<link
    href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap"
    rel="stylesheet">

<style>
    :root {
        --premium-gold: #333333;
        --premium-dark: #000000;
        --premium-grey: #8a735a;
        --premium-light: #ffffff;
        --text-main: #3a1515;
        --border-color: rgba(0, 0, 0, 0.3);
    }

    body {
        font-family: 'Outfit', sans-serif;
        color: var(--text-main);
        background-color: var(--premium-light);
        background-image: 
            radial-gradient(ellipse at top right, rgba(0, 0, 0, 0.12) 0%, transparent 60%),
            radial-gradient(ellipse at bottom left, rgba(90, 25, 25, 0.08) 0%, transparent 50%),
            url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%235a1919' stroke-opacity='0.03' stroke-width='1'/%3E%3Ccircle cx='30' cy='30' r='10' fill='none' stroke='%23b58d55' stroke-opacity='0.04' stroke-width='1'/%3E%3C/svg%3E");
    }

    .product-detail-page {
        max-width: 1400px;
        margin: 0 auto;
        padding: 40px 40px 80px;
        position: relative;
    }

    /* ===== BREADCRUMB ===== */
    .breadcrumb-bar {
        padding: 20px 0;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: var(--premium-grey);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .breadcrumb-bar a {
        color: inherit;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .breadcrumb-bar a:hover {
        color: var(--premium-gold);
    }

    .breadcrumb-bar span.separator {
        color: #ddd;
    }

    /* ===== HEADER AREA ===== */
    .product-header-premium {
        text-align: center;
        margin: 40px 0 60px;
    }

    .premium-title {
        font-family: 'Inter', serif;
        font-size: 2.8rem;
        font-weight: 600;
        color: var(--premium-dark);
        margin-bottom: 15px;
        letter-spacing: -0.5px;
    }

    .premium-price {
        margin-bottom: 25px;
    }

    .curr-price {
        font-size: 2rem;
        font-weight: 500;
        color: var(--premium-dark);
    }

    .tax-info {
        display: block;
        font-size: 0.75rem;
        color: var(--premium-grey);
        margin-top: 5px;
    }

    .premium-top-actions {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 20px;
    }

    .top-action-btn {
        background: #fff;
        border: 1px solid var(--premium-gold);
        border-radius: 0; /* Sharp Square */
        padding: 8px 24px;
        font-size: 0.8rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        color: var(--premium-dark);
        text-decoration: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .top-action-btn:hover {
        background: var(--premium-gold);
        color: #fff;
        transform: translateY(-2px);
    }

    .icon-only-btn {
        width: 40px;
        height: 40px;
        padding: 0;
        justify-content: center;
    }

    /* ===== GALLERY GRID ===== */
    .premium-gallery-section {
        margin-bottom: 60px;
    }

    .gallery-grid-layout {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .gallery-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 15px;
    }

    /* ===== RELATED PRODUCTS PREMIUM GRID ===== */
    .related-products-section {
        background-color: var(--premium-light);
        background-image: 
            radial-gradient(circle at center, rgba(0, 0, 0, 0.12) 0%, transparent 70%),
            url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%235a1919' stroke-opacity='0.03' stroke-width='1'/%3E%3Ccircle cx='30' cy='30' r='10' fill='none' stroke='%23b58d55' stroke-opacity='0.05' stroke-width='1'/%3E%3C/svg%3E");
        padding: 80px 40px;
        border-top: 4px double var(--premium-gold);
        box-shadow: inset 0 15px 30px rgba(0, 0, 0, 0.05);
        margin: 80px -40px -80px -40px;
    }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
        margin-top: 50px;
    }

    .related-card {
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        background: #fff;
        border: 1px solid rgba(0, 0, 0, 0.3);
        border-radius: 0;
        overflow: hidden;
        transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        position: relative;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .related-card-img {
        position: relative;
        aspect-ratio: 1/1.1;
        background-color: var(--premium-light);
        overflow: hidden;
    }

    .related-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 1.5s cubic-bezier(0.19, 1, 0.22, 1), opacity 0.8s ease;
    }

    .related-card-img .hover-img {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
    }

    .related-card:hover .main-img {
        opacity: 0;
    }

    .related-card:hover .hover-img {
        opacity: 1;
        transform: scale(1.08);
    }

    .badge-premium {
        position: absolute;
        top: 15px;
        left: 15px;
        z-index: 5;
        font-family: var(--font-ui);
        font-size: 0.6rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        padding: 5px 12px;
        font-weight: 700;
        background: #e3d3c2;
        color: #7a634a;
    }

    .badge-sale {
        top: 45px;
        background: #ff5252;
        color: #fff;
    }

    .related-card-actions {
        position: absolute;
        top: 15px;
        right: 15px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        opacity: 0;
        transform: translateX(40px);
        transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        z-index: 10;
    }

    .related-card:hover .related-card-actions {
        opacity: 1;
        transform: translateX(0);
    }

    .card-action-btn-sm {
        width: 38px;
        height: 38px;
        background: #fff;
        border-radius: 0; /* Sharp Square */
        display: flex;
        align-items: center;
        justify-content: center;
        color: #333;
        border: none;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .card-action-btn-sm:hover {
        background: #000;
        color: #fff;
    }

    .related-card-info {
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        background: #fff;
        border-top: 1px solid #f2f2f2;
    }

    .product-meta {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: #c7a17a;
        margin-bottom: 5px;
    }

    .related-card-info h4 {
        font-family: 'Inter', serif;
        font-size: 1.1rem;
        font-weight: 500;
        margin: 0;
        color: #1a1a1a;
    }

    .related-card-price {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 5px;
    }

    .related-card-price span {
        font-weight: 700;
        font-size: 1.1rem;
    }

    .old-price {
        color: #aaa;
        text-decoration: line-through;
        font-size: 0.8rem;
        font-weight: 400;
    }

    .btn-card-atc {
        background: #641e1e;
        color: #fff;
        border: none;
        padding: 10px;
        border-radius: 0; /* Sharp Square */
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-top: 10px;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.4s ease;
        text-align: center;
    }

    .related-card:hover .btn-card-atc {
        opacity: 1;
        transform: translateY(0);
    }

    .related-card:hover {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
        border-color: var(--premium-gold);
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.3);
        border-radius: 0;
        background: #fff;
        padding: 6px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        transition: all 0.5s ease;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0;
        transition: transform 1.2s cubic-bezier(0.19, 1, 0.22, 1);
    }

    .gallery-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        border-color: var(--premium-gold);
    }

    .gallery-item:hover img {
        transform: scale(1.05);
    }

    .gallery-mixed-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 15px;
    }

    .gallery-sub-grid {
        display: grid;
        grid-template-columns: repeat(2, 2fr);
        grid-template-rows: repeat(2, 2fr);
        gap: 15px;
    }

    .view-all-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.7);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--premium-dark);
        gap: 10px;
    }

    /* ===== QUICK SPECS ===== */
    .quick-specs-bar {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 30px;
        padding: 30px 0;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 40px;
    }

    .spec-dot {
        width: 8px;
        height: 8px;
        background: var(--premium-gold);
        border-radius: 0; /* Sharp Square */
    }

    .spec-item-inline {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.9rem;
        color: var(--premium-dark);
    }

    /* ===== DELIVERY & OFFERS ===== */
    .delivery-offers-section {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 40px;
        margin-bottom: 60px;
    }

    .section-title-sm {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .pincode-checker {
        display: flex;
        gap: 15px;
        margin-bottom: 20px;
    }

    .pincode-input-wrap {
        flex: 1;
        position: relative;
    }

    .pincode-input-wrap i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--premium-grey);
    }

    .pincode-input-wrap input {
        width: 100%;
        padding: 12px 15px 12px 45px;
        border: 1px solid var(--border-color);
        border-radius: 0;
        font-family: inherit;
        outline: none;
    }

    .check-btn {
        padding: 12px 30px;
        background: var(--premium-gold);
        color: var(--premium-dark);
        border: none;
        border-radius: 0;
        font-weight: 600;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.8rem;
    }

    .exchange-banner {
        background: rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
        border-radius: 0;
        padding: 25px;
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
    }

    .exchange-icon {
        width: 60px;
        height: 60px;
        background: #fff;
        border-radius: 0; /* Sharp Square */
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: var(--premium-gold);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .exchange-text h4 {
        font-size: 1rem;
        margin-bottom: 5px;
    }

    .exchange-text p {
        font-size: 0.85rem;
        color: var(--premium-grey);
        margin: 0;
    }

    .offer-card {
        border: 1px dashed var(--premium-gold);
        border-radius: 0;
        padding: 15px;
        display: flex;
        gap: 15px;
        align-items: center;
    }

    .offer-icon {
        color: var(--premium-gold);
        font-size: 1.2rem;
    }

    .offer-details p {
        margin: 0;
        font-size: 0.85rem;
        line-height: 1.4;
    }

    /* ===== DETAILS ACCORDION ===== */
    .details-tabs-section {
        margin-bottom: 80px;
    }

    .accordion-item-premium {
        border-bottom: 1px solid var(--border-color);
    }

    .accordion-header-premium {
        padding: 25px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        font-weight: 600;
        font-size: 1.1rem;
        color: var(--premium-dark);
        border-bottom: 1px dashed var(--premium-gold);
    }

    .accordion-header-premium i {
        transition: transform 0.3s ease;
    }

    .accordion-item-premium.active .accordion-header-premium i {
        transform: rotate(180deg);
    }

    .accordion-content-premium {
        display: none;
        padding-bottom: 30px;
    }

    .accordion-item-premium.active .accordion-content-premium {
        display: block;
    }

    .specs-table {
        width: 100%;
        border-collapse: collapse;
    }

    .specs-table td {
        padding: 15px 20px;
        border: 1px solid var(--border-color);
        font-size: 0.9rem;
    }

    .specs-table .label {
        background: var(--premium-light);
        font-weight: 600;
        width: 30%;
    }

    .spec-grid-premium {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .spec-block {
        border: 1px solid var(--border-color);
        border-radius: 0;
        padding: 15px;
    }

    .spec-block .label {
        display: block;
        font-size: 0.75rem;
        color: var(--premium-grey);
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .spec-block .value {
        font-weight: 600;
        color: var(--premium-dark);
    }

    /* Add To Cart Form Button specific fix */
    .btn-card-atc {
        background: var(--premium-gold);
        color: #fff;
        border: none;
        padding: 15px;
        border-radius: 30px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-top: 20px;
        cursor: pointer;
        transition: all 0.4s ease;
        text-align: center;
        width: 100%;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .btn-card-atc:hover {
        background: var(--premium-dark);
        transform: translateY(-2px);
    }

    /* ===== DETAILS SPLIT LAYOUT ===== */
    .details-layout-split {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: flex-start;
        margin-top: 40px;
    }

    .details-image-part {
        position: sticky;
        top: 100px;
        background: #fff;
        padding: 15px;
        border: 1px solid var(--border-color);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .details-image-part img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.5s ease;
    }

    .details-image-part:hover img {
        transform: scale(1.02);
    }

    @media (max-width: 991px) {
        .details-layout-split {
            grid-template-columns: 1fr;
        }
        .details-image-part {
            position: static;
            margin-bottom: 30px;
        }
    }

    /* ===== TRUST SECTIONS ===== */
    .trust-banners-vertical {
        display: flex;
        flex-direction: column;
        gap: 40px;
        margin-bottom: 80px;
    }

    .trust-banner-wide {
        background: var(--premium-light);
        border-radius: 0;
        padding: 40px;
        text-align: center;
        border: 1px solid var(--border-color);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
        .product-detail-page {
            padding: 20px;
        }

        .delivery-offers-section {
            grid-template-columns: 1fr;
        }

        .spec-grid-premium {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .product-detail-page {
            padding: 20px 15px 60px;
        }

        .breadcrumb-bar {
            padding: 10px 0;
            font-size: 0.6rem;
            letter-spacing: 1px;
            white-space: nowrap;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .product-header-premium {
            margin: 20px 0 40px;
        }

        .premium-title {
            font-size: 1.8rem;
            margin-bottom: 10px;
            line-height: 1.2;
        }

        .curr-price {
            font-size: 1.6rem;
        }

        .premium-top-actions {
            gap: 10px;
            flex-wrap: wrap;
        }

        .top-action-btn {
            padding: 6px 15px;
            font-size: 0.75rem;
        }

        .gallery-row,
        .gallery-mixed-row {
            grid-template-columns: 1fr;
            gap: 10px;
            margin-bottom: 10px;
        }

        .gallery-sub-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }

        .quick-specs-bar {
            flex-wrap: wrap;
            gap: 15px;
            padding: 20px 0;
        }

        .spec-item-inline {
            font-size: 0.8rem;
        }

        .spec-dot { display: none; }

        .sticky-atc-bar {
            padding: 10px;
        }

        .sticky-bar-container {
            padding: 5px 5px 5px 15px;
            border-radius: 0; /* Sharp Square */
        }

        .sticky-val { font-size: 1.1rem; }
        .sticky-selector { display: none; }

        /* Related Grid Mobile Fix */
        .related-products-section {
            padding: 50px 15px;
            margin: 50px -15px -60px -15px;
        }

        .related-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 30px;
        }

        .related-card-info {
            padding: 12px;
        }

        .related-card-info h4 {
            font-size: 1rem;
        }

        .btn-card-atc {
            padding: 10px;
            font-size: 0.7rem;
            opacity: 1; /* Always visible on mobile for better UX */
            transform: translateY(0);
        }
    }

    /* ===== GALLERY MODAL REFINED ===== */
    .gallery-modal {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 40px;
    }

    .gallery-modal.active {
        display: flex;
    }

    .modal-container {
        background: #fff;
        width: 100%;
        max-width: 1100px;
        height: 85vh;
        position: relative;
        border-radius: 0;
        display: flex;
        flex-direction: column;
        padding: 40px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        border: 2px solid var(--premium-gold);
    }

    .modal-close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #f5f5f5;
        color: #333;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 0; /* Sharp Square */
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: all 0.3s ease;
    }

    .modal-close-btn:hover {
        background: var(--premium-dark);
        color: #fff;
    }

    .main-gallery-display {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .main-gallery-display img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        transition: opacity 0.3s ease;
    }

    .gallery-thumbnails-row {
        display: flex;
        gap: 12px;
        justify-content: center;
        overflow-x: auto;
        padding: 10px 0;
        scroll-behavior: smooth;
    }

    .thumb-btn {
        width: 80px;
        height: 80px;
        border: 2px solid transparent;
        border-radius: 0;
        overflow: hidden;
        cursor: pointer;
        padding: 0;
        background: #f9f9f9;
        transition: all 0.2s ease;
        flex-shrink: 0;
        position: relative;
    }

    .thumb-btn img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .thumb-btn.active {
        border-color: var(--premium-dark);
        box-shadow: 0 0 0 1px var(--premium-dark);
    }

    @media (max-width: 768px) {
        .modal-container {
            height: 90vh;
            width: 95%;
            padding: 20px 15px;
            border-radius: 0; /* Sharp Square for Rajwadi look */
        }

        .main-gallery-display {
            margin-bottom: 20px;
        }

        .gallery-thumbnails-row {
            gap: 8px;
            padding: 5px 0;
        }

        .thumb-btn {
            width: 60px;
            height: 60px;
            border-radius: 0; /* Sharp Square */
        }

        .modal-close-btn {
            top: 10px;
            right: 10px;
            width: 40px;
            height: 40px;
            font-size: 1.2rem;
            background: var(--premium-gold);
            color: #fff;
        }
    }

    /* ===== STICKY ADD TO CART BAR ===== */
    .sticky-atc-bar {
        position: fixed;
        bottom: -100px;
        left: 0;
        width: 100%;
        background: #fff;
        box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.05);
        z-index: 998;
        padding: 15px 40px;
        display: flex;
        justify-content: center;
        transition: bottom 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .sticky-atc-bar.active {
        bottom: 0;
    }

    .sticky-bar-container {
        width: 100%;
        max-width: 1000px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fff;
        border-radius: 0;
        padding: 5px 5px 5px 30px;
        border: 1px solid var(--border-color);
    }

    .sticky-price-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .sticky-val {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--premium-dark);
    }

    .sticky-sep {
        width: 1px;
        height: 20px;
        background: #ddd;
    }

    .sticky-selector {
        background: var(--premium-light);
        border-radius: 0;
        padding: 10px 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.85rem;
        color: var(--premium-grey);
    }

    .sticky-selector select {
        background: none;
        border: none;
        outline: none;
        font-weight: 600;
        color: var(--premium-dark);
        cursor: pointer;
    }

    .btn-sticky-atc {
        background: #641e1e;
        color: #fff;
        border: none;
        padding: 12px 40px;
        border-radius: 0;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.85rem;
    }

    .btn-sticky-atc:hover {
        background: var(--premium-dark);
    }

    .btn-sticky-buy {
        background: var(--premium-gold);
        color: var(--premium-dark);
        border: none;
        padding: 12px 40px;
        border-radius: 0;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-block;
    }

    .btn-sticky-buy:hover {
        background: #96703f;
    }

    /* Welcome Banner on Sticky */
    .sticky-promo-banner {
        position: absolute;
        top: -50px;
        left: 50%;
        transform: translateX(-50%);
        background: #fff;
        border: 1px solid #d4af37;
        padding: 8px 25px;
        border-radius: 50px;
        font-size: 0.8rem;
        display: flex;
        align-items: center;
        gap: 10px;
        white-space: nowrap;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .promo-tag {
        background: #c7a17a;
        color: #fff;
        padding: 2px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
    }
</style>

<main class="product-detail-page">
    <!-- Breadcrumb -->
    <div class="breadcrumb-bar">
        <a href="/">Home</a>
        <span class="separator">/</span>
        <a href="/">Watch & Shop</a>
        <span class="separator">/</span>
        <span style="color: var(--premium-dark)">{{ $product->product_name }}</span>
    </div>

    <!-- Header Area -->
    <div class="product-header-premium">
        <div
            style="color: var(--premium-gold); text-transform: uppercase; font-size: 0.8rem; letter-spacing: 2px; margin-bottom: 10px;">
            Cinematic Reel
        </div>
        <h1 class="premium-title">{{ $product->product_name }}</h1>
        <div class="premium-price">
            <span class="curr-price">${{ number_format($product->current_price) }}</span>
            <span class="tax-info">(Price Inclusive of all taxes)</span>
        </div>

        <div class="premium-top-actions">
            <button class="top-action-btn">
                <i class="bi bi-geo-alt"></i> Try at Home
            </button>
            <div style="display: flex; gap: 10px;">
                <form action="{{ route('wishlist.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="v_{{ $product->id }}">
                    <button type="submit" class="top-action-btn icon-only-btn">
                        <i class="bi bi-heart"></i>
                    </button>
                </form>
                <button class="top-action-btn icon-only-btn">
                    <i class="bi bi-share"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="premium-gallery-section">
        @php
            if (!function_exists('getMediaUrl')) {
                function getMediaUrl($path) {
                    if (!$path) return '';
                    if (str_starts_with($path, 'http')) return $path;
                    if (str_starts_with($path, 'storage/')) return asset($path);
                    return asset('storage/' . $path);
                }
            }

            $images = [];
            if ($product->product_image) $images[] = getMediaUrl($product->product_image);
            if ($product->image2) $images[] = getMediaUrl($product->image2);
            if ($product->image3) $images[] = getMediaUrl($product->image3);
            if ($product->image4) $images[] = getMediaUrl($product->image4);
            if ($product->image5) $images[] = getMediaUrl($product->image5);
            if ($product->image6) $images[] = getMediaUrl($product->image6);

            $count = count($images);
        @endphp

        <!-- Row 1: Two Large Side-by-Side -->
        @if($count > 0)
        <div class="gallery-row">
            <div class="gallery-item" style="aspect-ratio: 1/1;">
                <img src="{{ $images[0] }}" alt="{{ $product->product_name }} 1">
            </div>
            @if($count > 1)
                <div class="gallery-item" style="aspect-ratio: 1/1;">
                    <img src="{{ $images[1] }}" alt="{{ $product->product_name }} 2">
                </div>
            @endif
        </div>
        @endif

        <!-- Row 2: One Large & Sub-grid -->
        @if($count > 2)
            <div class="gallery-mixed-row">
                <div class="gallery-item" style="aspect-ratio: 1/1;">
                    <img src="{{ $images[2] }}" alt="{{ $product->product_name }} 3">
                </div>

                <div class="gallery-sub-grid">
                    @if($count > 3)
                        <div class="gallery-item" style="aspect-ratio: 1/1;">
                            <img src="{{ $images[3] }}" alt="{{ $product->product_name }} 4">
                        </div>
                    @endif
                    @if($count > 4)
                        <div class="gallery-item" style="aspect-ratio: 1/1;">
                            <img src="{{ $images[4] }}" alt="{{ $product->product_name }} 5">
                        </div>
                    @endif
                    @if($count > 5)
                        <div class="gallery-item" style="aspect-ratio: 1/1;">
                            <img src="{{ $images[5] }}" alt="{{ $product->product_name }} 6">
                        </div>
                    @endif
                    <!-- View All Placeholder -->
                    <div class="gallery-item"
                        style="aspect-ratio: 1/1; background: #fff; border: 1px solid var(--border-color);">
                        <div class="view-all-overlay" onclick="openFullGallery()">
                            <i class="bi bi-grid-3x3-gap" style="font-size: 1.5rem; color: var(--premium-gold);"></i>
                            <span>VIEW ALL</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Quick Specs Bar -->
    <div class="quick-specs-bar">
        @if($product->metal_type && $product->metal_purity)
            <div class="spec-item-inline">
                <div class="spec-dot"></div>
                <span>{{ $product->metal_purity }} {{ $product->metal_type }}</span>
            </div>
        @endif
        @if($product->weight)
            <div class="spec-item-inline">
                <div class="spec-dot"></div>
                <span>{{ $product->weight }}</span>
            </div>
        @endif
    </div>

    <!-- Delivery & Offers -->
    <div class="delivery-offers-section">
        <div>
            <h3 class="section-title-sm">Delivery Details</h3>
            <div class="pincode-checker">
                <div class="pincode-input-wrap">
                    <i class="bi bi-geo-alt"></i>
                    <input type="text" placeholder="Enter Pincode">
                </div>
                <button class="check-btn">CHECK</button>
            </div>

            <div class="exchange-banner">
                <div class="exchange-icon">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
                <div class="exchange-text">
                    <h4>Best Exchange Value</h4>
                    <p>Exchange your old gold at current market rates within our store.</p>
                </div>
                <button class="check-btn" style="background: var(--premium-dark); margin-left: auto;">Check Value</button>
            </div>

            <h3 class="section-title-sm">Offers</h3>
            <div class="offer-card">
                <div class="offer-icon"><i class="bi bi-tag-fill"></i></div>
                <div class="offer-details">
                    <p><strong>Flat $500 OFF</strong> on your first order with LEXORIA DIAMONDS.</p>
                    <p style="color: var(--premium-gold); font-weight: 600; cursor: pointer;">USE CODE: BDFIRST</p>
                </div>
            </div>
        </div>

        <div>
            <div style="background: var(--premium-light); padding: 30px; border-radius: 12px; height: 100%;">
                <h3 class="section-title-sm" style="margin-bottom: 25px;">Summary</h3>
                <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                    <span>Subtotal</span>
                    <span style="font-weight: 600;">${{ number_format($product->current_price) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 30px; color: #27ae60;">
                    <span>Shipping</span>
                    <span>FREE</span>
                </div>
                <hr style="border: none; border-top: 1px solid #ddd; margin-bottom: 20px;">
                <div style="display: flex; justify-content: space-between; margin-bottom: 40px;">
                    <span style="font-weight: 700; font-size: 1.2rem;">Total</span>
                    <span
                        style="font-weight: 700; font-size: 1.2rem; color: var(--premium-dark);">${{ number_format($product->current_price) }}</span>
                </div>
                <form action="{{ route('cart.add') }}" method="POST" class="ajax-atc-form">
                    @csrf
                    <input type="hidden" name="product_id" value="v_{{ $product->id }}">
                    <button type="submit" class="btn-premium" style="width: 100%; padding: 20px; font-size: 1rem;">ADD TO CART</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Details Accordion -->
    <div class="details-tabs-section">
        <h2 style="font-family: 'Inter', serif; text-align: center; margin-bottom: 40px; font-size: 2rem;">Jewellery Details</h2>

        <div class="details-layout-split">
            <!-- Image Part -->
            <div class="details-image-part">
                <img src="{{ getMediaUrl($product->product_image) }}" alt="{{ $product->product_name }} Detail">
            </div>

            <!-- Accordion Part -->
            <div class="details-accordion-part">
                <div class="accordion-item-premium active">
                    <div class="accordion-header-premium" onclick="toggleAccordion(this)">
                        <span>Product Details</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="accordion-content-premium">
                        <div class="spec-grid-premium">
                            @if($product->metal_purity)
                                <div class="spec-block">
                                    <span class="label">Karatage</span>

                                    <span class="value">{{ $product->metal_purity }}</span>
                                </div>
                            @endif
                            @if($product->metal_type)
                                <div class="spec-block">
                                    <span class="label">Metal Color</span>
                                    <span class="value">{{ $product->metal_type }}</span>
                                </div>
                            @endif
                            @if($product->weight)
                                <div class="spec-block">
                                    <span class="label">Gross Weight</span>
                                    <span class="value">{{ $product->weight }}g</span>
                                </div>
                            @endif
                            <div class="spec-block">
                                <span class="label">Metal</span>
                                <span class="value">{{ $product->metal_type }}</span>
                            </div>
                            @if($product->sku)
                                <div class="spec-block">
                                    <span class="label">Product ID</span>
                                    <span class="value">{{ $product->sku }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="accordion-item-premium">
                    <div class="accordion-header-premium" onclick="toggleAccordion(this)">
                        <span>Description</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="accordion-content-premium">
                        <p style="line-height: 1.8; color: var(--premium-grey);">{{ $product->description }}</p>
                    </div>
                </div>

                <div class="accordion-item-premium">
                    <div class="accordion-header-premium" onclick="toggleAccordion(this)">
                        <span>Price Breakup</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="accordion-content-premium">
                        <table class="specs-table">
                            <tr>
                                <td class="label">Component</td>
                                <td class="label">Rate</td>
                                <td class="label">Weight</td>
                                <td class="label">Value</td>
                            </tr>
                            <tr>
                                <td>{{ $product->metal_type }} {{ $product->metal_purity }}</td>
                                <td>$5,850</td>
                                <td>{{ $product->weight }}</td>
                                <td>${{ number_format((float)($product->current_price ?? 0) * 0.8) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">Making Charges</td>
                                <td>${{ number_format((float)($product->current_price ?? 0) * 0.15) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3">GST (3%)</td>
                                <td>${{ number_format((float)($product->current_price ?? 0) * 0.05) }}</td>
                            </tr>
                            <tr style="font-weight: 700; background: var(--premium-light);">
                                <td colspan="3">Total Price</td>
                                <td>${{ number_format($product->current_price ?? 0) }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trust Sections -->
    <div class="trust-banners-vertical">
        <div class="trust-banner-wide">
            <h2 style="font-family: 'Inter', serif; margin-bottom: 20px;">Why People Like This Product</h2>
            <p style="color: var(--premium-grey); max-width: 800px; margin: 0 auto 30px;">Our customers love the exquisite craftsmanship and the timeless design of our diamond collection. Each piece is crafted with precision to tell your unique story.</p>
            <div style="display: flex; justify-content: center; gap: 50px; margin-top: 40px;">
                <div>
                    <div style="font-size: 2.5rem; font-weight: 700; color: var(--premium-gold);">98%</div>
                    <div style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Craftsmanship</div>
                </div>
                <div>
                    <div style="font-size: 2.5rem; font-weight: 700; color: var(--premium-gold);">98%</div>
                    <div style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px;">Premium Finish</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Full Gallery Modal -->
    <div id="fullGalleryModal" class="gallery-modal">
        <div class="modal-container">
            <button class="modal-close-btn" onclick="closeFullGallery()">
                <i class="bi bi-x"></i>
            </button>
            <div class="main-gallery-display">
                <img id="mainGalleryImg"
                    src="{{ $count > 0 ? $images[0] : '' }}"
                    alt="{{ $product->product_name }} Main View">
            </div>
            <div class="gallery-thumbnails-row">
                @foreach($images as $img)
                    <button class="thumb-btn {{ $loop->first ? 'active' : '' }}" data-src="{{ $img }}"
                        onclick="switchGalleryImg(this)">
                        <img src="{{ $img }}" alt="Thumbnail {{ $loop->iteration }}">
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Sticky Bottom Bar -->
    <div id="stickyAtcBar" class="sticky-atc-bar">
        <div class="sticky-bar-container">
            <div class="sticky-price-info">
                <span class="sticky-val">${{ number_format($product->current_price) }}</span>
                <div class="sticky-sep"></div>
                <div class="sticky-selector">
                    <i class="bi bi-tag"></i>
                    <span>Weight: <strong>{{ $product->weight }}</strong></span>
                </div>
            </div>

            <div class="sticky-promo-banner">
                <span class="promo-tag">New</span>
                <span>Welcome back! Continue your wedding journey with us.</span>
                <i class="bi bi-arrow-right"></i>
            </div>

            <div style="display: flex; gap: 15px; align-items: center;">
                <form action="{{ route('cart.add') }}" method="POST" style="margin: 0;">
                    @csrf
                    <input type="hidden" name="product_id" value="v_{{ $product->id }}">
                    <input type="hidden" name="buy_now" value="1">
                    <button type="submit" class="btn-sticky-buy">Buy Now</button>
                </form>
                <form action="{{ route('cart.add') }}" method="POST" class="ajax-atc-form" style="margin: 0;">
                    @csrf
                    <input type="hidden" name="product_id" value="v_{{ $product->id }}">
                    <button type="submit" class="btn-sticky-atc">Add to Cart</button>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    function toggleAccordion(header) {
        const item = header.parentElement;
        const isActive = item.classList.contains('active');

        // Close all others
        document.querySelectorAll('.accordion-item-premium').forEach(i => {
            i.classList.remove('active');
        });

        if (!isActive) {
            item.classList.add('active');
        }
    }

    function switchGalleryImg(btn) {
        const mainImg = document.getElementById('mainGalleryImg');
        const imgSrc = btn.getAttribute('data-src');

        // Disable other thumbs active state
        document.querySelectorAll('.thumb-btn').forEach(t => t.classList.remove('active'));
        btn.classList.add('active');

        // Fade out/in effect
        mainImg.style.opacity = '0';
        setTimeout(() => {
            mainImg.src = imgSrc;
            mainImg.style.opacity = '1';
        }, 200);
    }

    function openFullGallery() {
        document.getElementById('fullGalleryModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeFullGallery() {
        document.getElementById('fullGalleryModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Sticky Bar Scroll Logic
    window.addEventListener('scroll', function () {
        const stickyBar = document.getElementById('stickyAtcBar');
        const triggerPos = 600; // Show after scrolling down 600px

        if (window.scrollY > triggerPos) {
            stickyBar.classList.add('active');
        } else {
            stickyBar.classList.remove('active');
        }
    });
</script>

@include('frontend.footer')

