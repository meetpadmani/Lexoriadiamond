<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $settings['store_name'] ?? 'Lexoria Diamonds' }} | Exquisite Handcrafted Jewelry</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset($settings['favicon'] ?? 'favicon.ico') }}">

    <!-- Dynamic Google Fonts -->
    @if(isset($typography) && $typography->heading_font_url)
        <link href="{{ $typography->heading_font_url }}" rel="stylesheet">
    @else
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&display=swap"
            rel="stylesheet">
    @endif

    @if(isset($typography) && $typography->body_font_url)
        <link href="{{ $typography->body_font_url }}" rel="stylesheet">
    @else
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600&display=swap"
            rel="stylesheet">
    @endif

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --brand-gold: #333333;
            --brand-dark: #000000;
            --brand-grey: #888888;
            --brand-light: #ffffff;
            --heading-font: '{{ $typography->heading_font_family ?? 'Inter' }}', serif;
            --body-font: '{{ $typography->body_font_family ?? 'Inter' }}', sans-serif;
            --navbar-height: 100px;
            --transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            overflow-x: hidden;
            width: 100%;
        }

        body {
            font-family: var(--body-font);
            background: var(--brand-light);
            color: var(--brand-dark);
        }

        /* ===== TOP UTILITY BAR ===== */
        .top-bar {
            background: #0F1F17; /* Luxury dark green */
            padding: 12px 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 0.75rem;
            color: #FFFFFF;
            letter-spacing: 2px;
            text-transform: uppercase;
            position: relative;
        }

        .top-bar::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 5%;
            right: 5%;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.3), transparent);
        }



        .top-bar a {
            text-decoration: none;
            color: #FFFFFF;
            margin-right: 25px;
            transition: var(--transition);
        }

        .top-bar a:hover {
            color: var(--brand-gold);
        }

        /* ===== MAIN HEADER ===== */
        .main-header-container {
            position: sticky;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background: #ffffff; /* Ivory Sandstone */
            border-bottom: 1px dashed rgba(0, 0, 0, 0.4);
            box-shadow: 0 5px 25px rgba(90, 25, 25, 0.1);
            transition: var(--transition);
        }

        /* Text colors - Always solid/dark */
        .main-header-container .nav-link,
        .main-header-container .action-icon,
        .main-header-container .search-trigger,
        .main-header-container .mobile-menu-toggle {
            color: var(--brand-dark);
        }

        .header-main {
            padding: 0 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: var(--navbar-height);
            max-width: 1600px;
            margin: 0 auto;
        }

        /* Left: Navigation Links */
        .nav-left {
            flex: 1;
            display: flex;
            gap: 30px;
        }

        .nav-link {
            text-decoration: none;
            color: var(--brand-dark);
            font-size: 0.85rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            position: relative;
            padding: 10px 0;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--brand-gold);
            transition: var(--transition);
        }

        .nav-link:hover {
            color: var(--brand-gold);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Unique Mega Menu: 'Aura' Design -> Rajwadi Palace Dropdown */
        .mega-menu {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: #111111; /* Deep Elegant Dark */
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.5);
            padding: 60px 80px;
            opacity: 0;
            visibility: hidden;
            transform: scaleY(0.98) translateY(10px);
            transform-origin: top;
            transition: all 0.4s cubic-bezier(0.2, 0.8, 0.2, 1);
            z-index: 1000;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            gap: 60px;
            border-bottom: 3px solid #C9A96E; /* Premium Gold */
        }

        .nav-item:hover .mega-menu {
            opacity: 1;
            visibility: visible;
            transform: scaleY(1) translateY(0);
        }

        /* Category Tiles */
        .mega-nav-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 50px;
            flex: 2.5;
        }

        .category-group h4 {
            font-family: 'Playfair Display', serif;
            font-size: 0.95rem;
            color: #C9A96E; /* Gold */
            margin-bottom: 25px;
            letter-spacing: 3px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(201, 169, 110, 0.2);
            padding-bottom: 10px;
        }

        .category-tile {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 12px 15px;
            border-radius: 0 8px 8px 0;
            transition: var(--transition);
            text-decoration: none;
            margin-bottom: 8px;
            background: transparent;
            position: relative;
            border-left: 2px solid transparent;
        }

        .category-tile:hover {
            background: linear-gradient(90deg, rgba(201, 169, 110, 0.08) 0%, transparent 100%);
            border-left: 2px solid #C9A96E;
            transform: translateX(5px);
        }

        .tile-icon {
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(201, 169, 110, 0.5); /* Dim gold */
            font-size: 1.3rem;
            transition: var(--transition);
        }

        .category-tile:hover .tile-icon {
            color: #C9A96E; /* Bright gold */
            transform: scale(1.1);
        }

        .tile-text span {
            display: block;
            color: #cccccc;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            font-size: 0.95rem;
            letter-spacing: 0.5px;
            transition: var(--transition);
        }

        .category-tile:hover .tile-text span {
            color: #ffffff;
        }

        .tile-text small {
            font-size: 0.75rem;
            color: rgba(255, 255, 255, 0.4);
            font-family: 'Inter', sans-serif;
            letter-spacing: 0.5px;
            margin-top: 4px;
            display: block;
        }

        /* High-End Visual Showcase */
        .mega-showcase {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .showcase-card {
            position: relative;
            height: 100%;
            min-height: 320px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.8);
            border: 1px solid rgba(201, 169, 110, 0.15);
            group: showcase;
        }

        .showcase-card::after {
            content: '';
            position: absolute;
            inset: 15px;
            border: 1px solid rgba(201, 169, 110, 0.3);
            border-radius: 8px;
            pointer-events: none;
            transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            z-index: 2;
        }

        .showcase-card:hover::after {
            inset: 20px;
            border-color: rgba(201, 169, 110, 0.8);
            background: rgba(201, 169, 110, 0.05);
        }

        .showcase-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 2s cubic-bezier(0.2, 0.8, 0.2, 1);
        }

        .showcase-card:hover img {
            transform: scale(1.08);
        }

        .showcase-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, #050505 0%, rgba(5, 5, 5, 0.4) 50%, transparent 100%);
            padding: 40px 30px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
            text-align: center;
            color: #fff;
            z-index: 3;
        }

        .showcase-label {
            font-size: 0.65rem;
            font-family: 'Inter', sans-serif;
            text-transform: uppercase;
            letter-spacing: 4px;
            color: #C9A96E;
            margin-bottom: 12px;
            opacity: 0.9;
        }

        .showcase-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 500;
            margin-bottom: 25px;
            line-height: 1.2;
            color: #ffffff;
            letter-spacing: 1px;
        }

        .btn-mini {
            display: inline-block;
            padding: 10px 24px;
            background: transparent;
            border: 1px solid #C9A96E;
            color: #C9A96E;
            text-decoration: none;
            font-size: 0.7rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.4s ease;
            border-radius: 0;
        }

        .btn-mini:hover {
            background: #C9A96E;
            color: #000000;
            box-shadow: 0 0 20px rgba(201, 169, 110, 0.3);
        }

        /* Center: Logo pop-out effect */
        .header-logo {
            flex: 0 0 auto;
            position: relative;
            z-index: 1001;
            margin-top: 5px; /* Reduced pull */
        }

        .logo-pop-container {
            background:transparent;
            border-top: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 0;
        }

        .header-logo img {
            max-height: 70px;
            width: auto;
            object-fit: contain;
            transition: var(--transition);
        }

        /* Right: Search & Actions */
        .header-right {
            flex: 1;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 25px;
        }

        .search-trigger {
            cursor: pointer;
            font-size: 1.2rem;
            color: var(--brand-dark);
            transition: var(--transition);
        }

        .search-trigger:hover {
            color: var(--brand-gold);
        }

        .header-actions {
            display: flex;
            gap: 20px;
            align-items: center;
        }

        .action-icon {
            text-decoration: none;
            color: var(--brand-dark);
            font-size: 1.3rem;
            position: relative;
            transition: var(--transition);
        }

        .action-icon:hover {
            color: var(--brand-gold);
            transform: translateY(-2px);
        }

        .badge-count {
            position: absolute;
            top: -5px;
            right: -8px;
            background: var(--brand-gold);
            color: #fff;
            font-size: 0.6rem;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        /* User Dropdown */
        .user-dropdown-parent:hover .user-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .user-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            width: 250px;
            background: #fff;
            border: 1px solid var(--brand-gold);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 20px;
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: var(--transition);
            z-index: 1001;
            text-align: left;
        }

        .user-info-brief {
            margin-bottom: 15px;
        }

        .user-info-brief strong {
            display: block;
            font-family: 'Inter', serif;
            color: var(--brand-dark);
            font-size: 1.1rem;
        }

        .user-info-brief span {
            font-size: 0.75rem;
            color: var(--brand-grey);
        }

        .dropdown-divider {
            height: 1px;
            background: rgba(0, 0, 0, 0.2);
            margin: 10px 0;
        }

        .dropdown-link {
            display: flex;
            gap: 10px;
            text-decoration: none;
            color: var(--brand-dark);
            font-size: 0.85rem;
            transition: var(--transition);
            border: none;
            background: none;
            width: 100%;
            cursor: pointer;
        }

        .dropdown-link:hover {
            color: var(--brand-gold);
            transform: translateX(5px);
        }

        .logout-btn {
            color: #000000;
            font-weight: 600;
        }

        /* ===== MOBILE NAV ===== */
        .mobile-menu-toggle {
            display: none;
            font-size: 1.8rem;
            cursor: pointer;
        }

        @media (max-width: 1100px) {

            .nav-left,
            .top-bar,
            .secondary-nav {
                display: none;
            }

            .mobile-menu-toggle {
                display: block;
                order: 1;
            }

            .header-logo {
                order: 2;
                padding: 0;
            }

            .header-right {
                order: 3;
                gap: 15px;
            }

            .header-main {
                padding: 0 15px;
                height: 70px;
                gap: 10px;
            }

            .header-logo img {
                max-height: 45px;
            }

            .action-icon i {
                font-size: 1.15rem;
            }

            .search-trigger {
                font-size: 1.1rem;
            }
        }

        .header-logo img.mobile-logo {
            display: none;
        }

        /* Rich Mobile Menu Styles */
        .mobile-menu-overlay {
            position: fixed;
            inset: 0;
            background: #ffffff; /* Sandstone base */
            background-image: 
                radial-gradient(circle at top right, rgba(0, 0, 0, 0.1) 0%, transparent 40%),
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 0L60 30L30 60L0 30Z' fill='none' stroke='%235a1919' stroke-opacity='0.03' stroke-width='1'/%3E%3C/svg%3E");
            z-index: 10001;
            transform: translateX(-100%);
            transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
            display: flex;
            flex-direction: column;
        }

        .mobile-menu-overlay.active {
            transform: translateX(0);
        }

        .mobile-menu-header {
            padding: 15px 20px; /* Reduced from 25px */
            display: flex;
            align-items: center;
            background: #fff;
            border-bottom: 3px solid #333333;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .mobile-menu-close {
            font-size: 1.8rem;
            cursor: pointer;
            color: #000000;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
        }

        .mobile-logo-small {
            display: none;
        }

        .mobile-menu-body {
            flex: 1;
            overflow-y: auto;
            padding: 20px 25px 40px 25px; /* Reduced top padding from 40px */
        }

        .mobile-primary-nav {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 50px;
        }

        .mobile-nav-link {
            font-family: 'Inter', serif;
            font-size: 1.6rem;
            text-decoration: none;
            color: #0F1F17;
            font-weight: 700;
            padding: 15px 0; /* Increased touch target */
            border-bottom: 1px solid rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
            min-height: 44px; /* Minimum tap target size */
        }

        .mobile-nav-link::after {
            content: '→';
            font-size: 1.2rem;
            color: #333333;
            opacity: 0.5;
        }

        .menu-label {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #000000;
            margin-bottom: 25px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .menu-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, #333333, transparent);
        }

        .mobile-cat-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 50px;
        }

        .mobile-cat-item {
            padding: 18px 10px;
            background: #fff;
            text-decoration: none;
            color: #0F1F17;
            font-size: 0.95rem; /* Better readability */
            border: 1px solid #333333;
            border-radius: 4px;
            text-align: center;
            font-weight: 600;
            font-family: 'Inter', serif;
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
            transition: all 0.3s ease;
            min-height: 48px; /* Touch target */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .mobile-cat-item:active {
            background: #ffffff;
            transform: scale(0.98);
        }

        .mobile-menu-footer {
            margin-top: auto;
            background: #fff;
            border-top: 2px solid #333333;
            padding: 30px 20px;
        }

        .mobile-action-links {
            display: flex;
            justify-content: space-between;
            margin-bottom: 25px;
            gap: 15px;
        }

        .mobile-action-links a {
            flex: 1;
            text-decoration: none;
            color: #0F1F17;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            font-size: 0.85rem;
            font-weight: 600;
            padding: 12px;
            border: 1px solid rgba(0, 0, 0, 0.3);
            border-radius: 4px;
        }

        .mobile-social {
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .mobile-social a {
            font-size: 1.4rem;
            color: #000000;
        }

        .secondary-nav {
            background: #ffffff;
            border-top: 1px dashed rgba(0, 0, 0, 0.3);
            border-bottom: 2px solid rgba(0, 0, 0, 0.3);
            padding: 12px 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px; 
            transition: var(--transition);
        }

        .nav-spacer {
            width: 200px; /* Reduced for smaller logo */
            flex-shrink: 0;
        }

        .cat-link {
            text-decoration: none;
            color: var(--brand-grey);
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .cat-link svg {
            color: var(--brand-gold);
            width: 15px; /* Slightly smaller icon */
            height: 15px;
            transition: var(--transition);
        }

        .cat-link:hover {
            color: var(--brand-dark);
        }

        .cat-link:hover svg {
            transform: scale(1.15) rotate(5deg);
        }

        /* Mobile Specific Overlays */
        @media (max-width: 768px) {
            .secondary-nav {
                display: none !important;
            }
            .search-overlay {
                padding-top: 70px;
            }

            .search-close {
                top: 16px;
                right: 16px;
                width: 38px;
                height: 38px;
                font-size: 1.2rem;
            }

            .search-input-container {
                width: 92%;
            }

            .search-input-container h2 {
                font-size: 1.3rem;
                letter-spacing: 2px;
            }

            .search-subtitle {
                font-size: 0.65rem;
                margin-bottom: 20px;
            }

            .search-input-wrapper input {
                font-size: 0.95rem;
                padding: 14px 52px 14px 20px;
            }

            .side-drawer {
                width: 100%;
                right: -100%;
            }

            .drawer-header {
                padding: 20px;
            }

            .drawer-body {
                padding: 20px;
            }

            .drawer-footer {
                padding: 20px;
            }

            .auth-modal-box {
                flex-direction: column;
                height: auto;
                max-height: 95vh;
                border-radius: 12px;
                overflow-y: auto;
            }

            .auth-image-side {
                display: none !important; /* Force hide to make room for inputs */
            }

            .auth-form-side {
                padding: 15px !important;
                flex: none;
                width: 100%;
            }

            .auth-tabs {
                margin-bottom: 15px;
                padding-top: 10px;
            }

            .auth-tab {
                font-size: 0.9rem;
                padding: 8px;
            }

            .btn-close-modal {
                top: 5px;
                right: 5px;
                width: 26px;
                height: 26px;
                font-size: 0.8rem;
                border-width: 1px;
                background: #ffffff;
            }

            .btn-primary-modal {
                padding: 12px;
                font-size: 0.9rem;
                margin-top: 10px;
            }

            .form-group-modal {
                margin-bottom: 10px;
            }

            .form-control-modal {
                padding: 8px 12px;
                font-size: 0.85rem;
            }

            .auth-divider {
                margin: 10px 0;
                font-size: 0.75rem;
            }

            .btn-google {
                padding: 10px;
                font-size: 0.8rem;
                margin-bottom: 10px;
            }

            .auth-form h3 {
                font-size: 1.4rem !important;
                margin-bottom: 5px !important;
            }

            .auth-form p {
                font-size: 0.85rem !important;
                margin-bottom: 15px !important;
            }
        }

        /* ===== SEARCH OVERLAY — ULTRA ANIMATED ===== */

        /* --- Keyframes --- */
        @keyframes panelSlideLeft {
            from { transform: translateX(-100%); opacity: 0; }
            to   { transform: translateX(0);    opacity: 1; }
        }
        @keyframes panelSlideRight {
            from { transform: translateX(80px) scale(0.96); opacity: 0; }
            to   { transform: translateX(0)    scale(1);    opacity: 1; }
        }
        @keyframes titleReveal {
            from { clip-path: inset(0 100% 0 0); opacity: 0; transform: translateX(-10px); }
            to   { clip-path: inset(0 0% 0 0);   opacity: 1; transform: translateX(0); }
        }
        @keyframes subtitleFade {
            from { opacity: 0; transform: translateY(8px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        @keyframes spinSlow {
            to { transform: rotate(360deg); }
        }
        @keyframes gemFloat {
            0%, 100% { transform: translateY(0)    rotate(0deg)  scale(1); }
            25%       { transform: translateY(-8px)  rotate(8deg)  scale(1.05); }
            75%       { transform: translateY(-4px)  rotate(-5deg) scale(1.02); }
        }
        @keyframes orbitalDot {
            from { transform: rotate(0deg)   translateX(22px) rotate(0deg); }
            to   { transform: rotate(360deg) translateX(22px) rotate(-360deg); }
        }
        @keyframes orbitalDot2 {
            from { transform: rotate(180deg) translateX(18px) rotate(-180deg); }
            to   { transform: rotate(540deg) translateX(18px) rotate(-540deg); }
        }
        @keyframes goldPulseRing {
            0%   { transform: scale(1);   opacity: 0.7; }
            100% { transform: scale(2);   opacity: 0; }
        }
        @keyframes shimmerSlide {
            0%   { background-position: -800px 0; }
            100% { background-position: 800px 0; }
        }
        @keyframes shimmerSweep {
            0%   { left: -80%; }
            100% { left: 130%; }
        }
        @keyframes catCardIn {
            from { opacity: 0; transform: translateY(20px) rotateX(15deg) scale(0.9); }
            to   { opacity: 1; transform: translateY(0)    rotateX(0deg)  scale(1); }
        }
        @keyframes resultItemIn {
            from { opacity: 0; transform: translateX(-16px); }
            to   { opacity: 1; transform: translateX(0); }
        }
        @keyframes breatheBorder {
            0%, 100% { box-shadow: 0 0 0 0   rgba(181,141,85,0);
                        border-color: rgba(181,141,85,0.2); }
            50%       { box-shadow: 0 0 0 6px rgba(181,141,85,0.06);
                        border-color: rgba(181,141,85,0.45); }
        }
        @keyframes particleFloat {
            0%   { transform: translateY(0)   translateX(0)    rotate(0deg);   opacity: 0.4; }
            33%  { transform: translateY(-30px) translateX(10px)  rotate(60deg);  opacity: 0.7; }
            66%  { transform: translateY(-55px) translateX(-8px)  rotate(120deg); opacity: 0.3; }
            100% { transform: translateY(-85px) translateX(4px)   rotate(180deg); opacity: 0; }
        }
        @keyframes rippleOut {
            from { transform: scale(0); opacity: 0.5; }
            to   { transform: scale(4); opacity: 0; }
        }
        @keyframes sparkLine {
            from { width: 0; opacity: 0; }
            to   { width: 60px; opacity: 1; }
        }
        @keyframes inputGlow {
            0%,100% { box-shadow: 0 0 0 0 rgba(181,141,85,0); }
            50%      { box-shadow: 0 0 20px 2px rgba(181,141,85,0.12); }
        }
        @keyframes floatBadge {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-4px); }
        }

        /* === OVERLAY BASE === */
        .search-overlay {
            position: fixed;
            inset: 0;
            z-index: 2000;
            display: grid;
            grid-template-columns: 320px 1fr;
            grid-template-rows: 1fr;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.5s cubic-bezier(0.4,0,0.2,1),
                        visibility 0.5s cubic-bezier(0.4,0,0.2,1);
            overflow: hidden;
        }
        .search-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Left panel — categories */
        .search-left-panel {
            background: linear-gradient(160deg, #120d04 0%, #1e1509 30%, #2a1c0d 60%, #120d04 100%);
            padding: 50px 30px 40px;
            display: flex;
            flex-direction: column;
            gap: 0;
            position: relative;
            overflow: hidden;
            animation: panelSlideLeft 0.6s cubic-bezier(0.34,1.56,0.64,1) both;
        }
        /* Deep radial glow */
        .search-left-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse at 50% -10%, rgba(181,141,85,0.22) 0%, transparent 55%),
                radial-gradient(ellipse at 80% 90%, rgba(181,141,85,0.08) 0%, transparent 40%);
            pointer-events: none;
            z-index: 0;
        }
        /* Vertical gold separator */
        .search-left-panel::after {
            content: '';
            position: absolute;
            top: 0; right: 0;
            width: 1px;
            height: 100%;
            background: linear-gradient(180deg,
                transparent 0%,
                rgba(181,141,85,0.6) 30%,
                rgba(181,141,85,0.3) 70%,
                transparent 100%);
            z-index: 0;
        }

        /* Floating particles canvas */
        .search-particles {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            overflow: hidden;
        }
        .search-particle {
            position: absolute;
            font-size: 0.65rem;
            color: rgba(181,141,85,0.5);
            animation: particleFloat linear infinite;
            will-change: transform, opacity;
        }

        /* Brand mark */
        .search-brand-mark {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 36px;
            position: relative;
            z-index: 1;
        }
        .search-brand-gem-wrap {
            position: relative;
            width: 44px; height: 44px;
        }
        .search-brand-gem {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #c9a84c, var(--brand-gold), #e8c97a);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem;
            color: #120d04;
            animation: gemFloat 4.5s ease-in-out infinite;
            box-shadow: 0 6px 24px rgba(181,141,85,0.5), 0 2px 6px rgba(0,0,0,0.3);
            position: relative;
            z-index: 1;
        }
        /* Orbiting dots around gem */
        .gem-orbit-dot {
            position: absolute;
            width: 5px; height: 5px;
            border-radius: 50%;
            background: var(--brand-gold);
            top: 50%; left: 50%;
            margin: -2.5px;
            transform-origin: center;
        }
        .gem-orbit-dot:nth-child(1) { animation: orbitalDot  3.5s linear infinite; opacity: 0.8; }
        .gem-orbit-dot:nth-child(2) { animation: orbitalDot2 2.8s linear infinite; opacity: 0.5; width: 3px; height: 3px; background: #e8c97a; }

        .search-brand-text {
            font-family: var(--heading-font);
            font-size: 0.6rem;
            letter-spacing: 3px;
            color: rgba(255,255,255,0.45);
            text-transform: uppercase;
            line-height: 1.6;
        }
        .search-brand-text strong {
            display: block;
            font-size: 0.88rem;
            color: rgba(255,255,255,0.9);
            letter-spacing: 2.5px;
            font-weight: 600;
        }

        /* Stats row */
        .search-stats {
            display: flex;
            gap: 0;
            margin-bottom: 28px;
            position: relative;
            z-index: 1;
        }
        .search-stat {
            flex: 1;
            text-align: center;
            padding: 10px 0;
            border-right: 1px solid rgba(181,141,85,0.1);
            animation: subtitleFade 0.6s ease both;
        }
        .search-stat:last-child { border-right: none; }
        .search-stat-num {
            display: block;
            font-family: var(--heading-font);
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--brand-gold);
            letter-spacing: 1px;
        }
        .search-stat-label {
            font-size: 0.55rem;
            color: rgba(255,255,255,0.35);
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .search-stat.stagger-s1 { animation-delay: 0.3s; }
        .search-stat.stagger-s2 { animation-delay: 0.45s; }
        .search-stat.stagger-s3 { animation-delay: 0.6s; }

        .search-panel-title {
            font-family: var(--heading-font);
            font-size: 0.58rem;
            letter-spacing: 3.5px;
            color: rgba(181,141,85,0.6);
            text-transform: uppercase;
            margin-bottom: 14px;
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .search-panel-title::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, rgba(181,141,85,0.25), transparent);
        }

        /* Category cards */
        .search-cat-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 24px;
            position: relative;
            z-index: 1;
            perspective: 800px;
        }
        .search-cat-card {
            background: rgba(255,255,255,0.035);
            border: 1px solid rgba(181,141,85,0.12);
            border-radius: 12px;
            padding: 16px 10px;
            text-decoration: none;
            color: rgba(255,255,255,0.7);
            font-size: 0.76rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
            cursor: pointer;
            text-align: center;
            font-family: var(--body-font);
            position: relative;
            overflow: hidden;
        }
        /* Shimmer sweep on hover */
        .search-cat-card::before {
            content: '';
            position: absolute;
            top: -50%; left: -80%;
            width: 60%; height: 200%;
            background: linear-gradient(105deg, transparent, rgba(255,255,255,0.08), transparent);
            transition: none;
            pointer-events: none;
        }
        .search-cat-card:hover::before {
            animation: shimmerSweep 0.55s ease forwards;
        }
        .search-cat-card i {
            font-size: 1.35rem;
            color: var(--brand-gold);
            transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
            filter: drop-shadow(0 0 0px rgba(181,141,85,0));
        }
        .search-cat-card:hover {
            background: rgba(181,141,85,0.1);
            border-color: rgba(181,141,85,0.45);
            color: #fff;
            transform: translateY(-5px) scale(1.03);
            box-shadow: 0 12px 30px rgba(0,0,0,0.4), 0 0 0 1px rgba(181,141,85,0.2) inset;
        }
        .search-cat-card:hover i {
            transform: scale(1.3) rotate(-8deg);
            filter: drop-shadow(0 0 6px rgba(181,141,85,0.7));
        }
        /* Ripple on click */
        .search-cat-card .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(181,141,85,0.25);
            transform: scale(0);
            animation: rippleOut 0.6s linear;
            pointer-events: none;
        }
        .search-cat-card.stagger-1 { animation: catCardIn 0.55s 0.15s cubic-bezier(0.34,1.56,0.64,1) both; }
        .search-cat-card.stagger-2 { animation: catCardIn 0.55s 0.22s cubic-bezier(0.34,1.56,0.64,1) both; }
        .search-cat-card.stagger-3 { animation: catCardIn 0.55s 0.29s cubic-bezier(0.34,1.56,0.64,1) both; }
        .search-cat-card.stagger-4 { animation: catCardIn 0.55s 0.36s cubic-bezier(0.34,1.56,0.64,1) both; }
        .search-cat-card.stagger-5 { animation: catCardIn 0.55s 0.43s cubic-bezier(0.34,1.56,0.64,1) both; }
        .search-cat-card.stagger-6 { animation: catCardIn 0.55s 0.50s cubic-bezier(0.34,1.56,0.64,1) both; }

        .search-left-footer {
            margin-top: auto;
            position: relative;
            z-index: 1;
            border-top: 1px solid rgba(181,141,85,0.1);
            padding-top: 18px;
            animation: subtitleFade 0.6s 0.7s both;
        }
        .search-kbd-hint {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.66rem;
            color: rgba(255,255,255,0.25);
            letter-spacing: 0.5px;
        }
        .search-kbd {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 3px 8px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 4px;
            font-size: 0.6rem;
            color: rgba(255,255,255,0.4);
            font-family: monospace;
            letter-spacing: 1px;
        }

        /* Right panel — search */
        .search-right-panel {
            background: linear-gradient(145deg, #fafaf7 0%, #f5efe3 50%, #fafaf7 100%);
            display: flex;
            flex-direction: column;
            padding: 0;
            position: relative;
            overflow-y: auto;
            animation: panelSlideRight 0.55s 0.1s cubic-bezier(0.34,1.56,0.64,1) both;
        }
        /* Animated gold progress bar */
        .search-right-panel::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg,
                transparent 0%, var(--brand-gold) 20%, #e8c97a 50%,
                #c9a84c 80%, transparent 100%);
            background-size: 400% auto;
            animation: shimmerSlide 2.5s linear infinite;
            z-index: 1;
        }
        /* Floating glow orb top-right */
        .search-right-panel::after {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 280px; height: 280px;
            background: radial-gradient(circle, rgba(181,141,85,0.06) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            animation: gemFloat 6s ease-in-out infinite;
        }

        /* Close button */
        .search-close {
            position: absolute;
            top: 24px; right: 32px;
            width: 42px; height: 42px;
            background: rgba(255,255,255,0.95);
            border: 1.5px solid rgba(181,141,85,0.2);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
            cursor: pointer;
            color: #888;
            transition: all 0.4s cubic-bezier(0.34,1.56,0.64,1);
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            z-index: 10;
            animation: subtitleFade 0.5s 0.4s both;
        }
        .search-close:hover {
            background: var(--brand-gold);
            border-color: var(--brand-gold);
            color: #fff;
            transform: rotate(90deg) scale(1.15);
            box-shadow: 0 8px 28px rgba(181,141,85,0.45);
        }

        /* Main search content area */
        .search-input-container {
            padding: 60px 52px 40px;
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 1;
        }

        /* Sparkle + title */
        .search-sparkle {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
            animation: subtitleFade 0.6s 0.25s both;
        }
        .search-sparkle-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: var(--brand-gold);
            position: relative;
            box-shadow: 0 0 8px rgba(181,141,85,0.6);
        }
        .search-sparkle-dot::after {
            content: '';
            position: absolute;
            inset: -5px;
            border-radius: 50%;
            border: 1.5px solid rgba(181,141,85,0.5);
            animation: goldPulseRing 2s ease-out infinite;
        }
        .search-sparkle-line {
            height: 1px;
            background: linear-gradient(90deg, var(--brand-gold), transparent);
            animation: sparkLine 0.8s 0.4s ease both;
        }
        .search-sparkle-label {
            font-size: 0.62rem;
            letter-spacing: 3.5px;
            color: var(--brand-gold);
            text-transform: uppercase;
            font-weight: 700;
            animation: subtitleFade 0.6s 0.35s both;
        }

        .search-input-container h2 {
            font-family: var(--heading-font);
            font-size: 2.6rem;
            margin-bottom: 6px;
            font-weight: 400;
            color: #1a1208;
            text-transform: uppercase;
            letter-spacing: 6px;
            line-height: 1.15;
            animation: titleReveal 0.8s 0.2s cubic-bezier(0.4,0,0.2,1) both;
        }
        .search-subtitle {
            font-size: 0.7rem;
            color: #c0aa85;
            letter-spacing: 2.5px;
            text-transform: uppercase;
            margin-bottom: 38px;
            display: block;
            animation: subtitleFade 0.7s 0.5s both;
        }

        /* Breathing animated search bar */
        .search-input-wrapper {
            position: relative;
            background: #fff;
            border: 1.5px solid rgba(181,141,85,0.2);
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.05), 0 1px 4px rgba(181,141,85,0.08);
            transition: all 0.4s cubic-bezier(0.4,0,0.2,1);
            overflow: visible;
            margin-bottom: 8px;
            animation: breatheBorder 3s 1.5s ease-in-out infinite, subtitleFade 0.6s 0.55s both;
        }
        .search-input-wrapper:focus-within {
            border-color: var(--brand-gold);
            border-radius: 18px;
            box-shadow:
                0 20px 60px rgba(181,141,85,0.16),
                0 4px 16px rgba(181,141,85,0.1),
                0 0 0 6px rgba(181,141,85,0.07);
            transform: translateY(-3px) scale(1.005);
            animation: inputGlow 2s ease-in-out infinite;
        }

        .search-input-wrapper input {
            width: 100%;
            background: transparent;
            border: none;
            padding: 20px 70px 20px 24px;
            font-size: 1.1rem;
            font-family: var(--heading-font);
            outline: none;
            color: #1a1208;
            letter-spacing: 0.5px;
            border-radius: 14px;
        }
        .search-input-wrapper input::placeholder {
            color: #c8bfaf;
            font-style: italic;
            font-size: 1rem;
        }

        .search-input-wrapper .search-icon-btn {
            position: absolute;
            right: 10px; top: 50%;
            transform: translateY(-50%);
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #c9a84c, var(--brand-gold));
            border: none;
            border-radius: 10px;
            cursor: pointer;
            color: #fff;
            font-size: 1.05rem;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
            box-shadow: 0 4px 16px rgba(181,141,85,0.4);
        }
        .search-input-wrapper .search-icon-btn:hover {
            background: linear-gradient(135deg, var(--brand-gold), #e8c97a);
            transform: translateY(-50%) scale(1.12) rotate(-5deg);
            box-shadow: 0 8px 24px rgba(181,141,85,0.5);
        }

        .search-char-hint {
            font-size: 0.65rem;
            color: #ccc;
            text-align: right;
            letter-spacing: 0.5px;
            margin-bottom: 28px;
            height: 14px;
        }

        /* Results area */
        .search-results {
            flex: 1;
        }

        .search-results-label {
            font-size: 0.64rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: var(--brand-gold);
            margin-bottom: 14px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .search-results-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, rgba(181,141,85,0.25), transparent);
        }

        /* Trending tags */
        .trending-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 28px;
        }
        .trending-tags .badge {
            border-color: rgba(181,141,85,0.25) !important;
            color: #7a6040 !important;
            background: rgba(181,141,85,0.06) !important;
            font-size: 0.74rem !important;
            font-weight: 500 !important;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.34,1.56,0.64,1);
            font-family: var(--body-font);
            padding: 8px 18px !important;
            border-radius: 30px !important;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .trending-tags .badge:hover {
            background: linear-gradient(135deg, var(--brand-gold), #c9a84c) !important;
            border-color: transparent !important;
            color: #fff !important;
            transform: translateY(-3px) scale(1.04);
            box-shadow: 0 8px 22px rgba(181,141,85,0.35);
        }

        /* Result items — stagger animation */
        .search-result-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 12px 16px;
            border-radius: 14px;
            margin-bottom: 6px;
            text-decoration: none;
            color: inherit;
            transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
            border: 1.5px solid transparent;
            position: relative;
            animation: resultItemIn 0.4s ease both;
        }
        .search-result-item:nth-child(1)  { animation-delay: 0.05s; }
        .search-result-item:nth-child(2)  { animation-delay: 0.10s; }
        .search-result-item:nth-child(3)  { animation-delay: 0.15s; }
        .search-result-item:nth-child(4)  { animation-delay: 0.20s; }
        .search-result-item:nth-child(5)  { animation-delay: 0.25s; }
        .search-result-item::before {
            content: '';
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%) scaleY(0);
            width: 3px;
            height: 60%;
            background: linear-gradient(180deg, var(--brand-gold), #e8c97a);
            border-radius: 0 3px 3px 0;
            transition: transform 0.3s cubic-bezier(0.34,1.56,0.64,1);
        }
        .search-result-item:hover::before { transform: translateY(-50%) scaleY(1); }
        .search-result-item:hover {
            background: #fff;
            border-color: rgba(181,141,85,0.18);
            box-shadow: 0 8px 32px rgba(0,0,0,0.07), 0 2px 8px rgba(181,141,85,0.05);
            transform: translateX(8px);
        }

        .search-result-img {
            width: 62px; height: 62px;
            border-radius: 12px;
            object-fit: cover;
            border: 1.5px solid rgba(181,141,85,0.18);
            flex-shrink: 0;
            box-shadow: 0 4px 14px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .search-result-item:hover .search-result-img {
            transform: scale(1.05);
        }

        .search-result-info { flex: 1; min-width: 0; }

        .search-result-name {
            font-family: var(--body-font);
            font-size: 0.9rem;
            font-weight: 600;
            color: #1a1208;
            display: block;
            margin-bottom: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .search-result-meta {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .search-result-price {
            font-size: 0.85rem;
            color: var(--brand-gold);
            font-weight: 700;
        }
        .search-result-collection {
            font-size: 0.65rem;
            color: #bbb;
            background: rgba(0,0,0,0.04);
            border: 1px solid rgba(0,0,0,0.07);
            border-radius: 20px;
            padding: 2px 8px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .search-result-arrow {
            width: 34px; height: 34px;
            border-radius: 50%;
            border: 1.5px solid rgba(181,141,85,0.18);
            background: rgba(181,141,85,0.04);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.85rem;
            color: #c9a84c;
            transition: all 0.3s cubic-bezier(0.34,1.56,0.64,1);
            flex-shrink: 0;
        }
        .search-result-item:hover .search-result-arrow {
            background: var(--brand-gold);
            border-color: var(--brand-gold);
            color: #fff;
            transform: translateX(3px) scale(1.1);
        }

        /* No results */
        .search-no-results {
            text-align: center;
            padding: 60px 0;
            color: #ccc;
        }
        .search-no-results i {
            font-size: 3rem;
            display: block;
            margin-bottom: 16px;
            color: rgba(181,141,85,0.3);
        }
        .search-no-results strong {
            display: block;
            color: #555;
            font-size: 1rem;
            margin-bottom: 8px;
            font-family: var(--heading-font);
            letter-spacing: 1px;
        }
        .search-no-results span {
            font-size: 0.8rem;
            color: #bbb;
        }

        /* Loading */
        .search-loading {
            text-align: center;
            padding: 40px 0;
            color: #bbb;
            font-size: 0.78rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .search-loading .spinner {
            width: 34px; height: 34px;
            border: 3px solid rgba(181,141,85,0.12);
            border-top-color: var(--brand-gold);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            margin: 0 auto 14px;
        }

        /* View all link */
        .search-view-all {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 18px;
            font-size: 0.75rem;
            color: var(--brand-gold);
            text-decoration: none;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 600;
            transition: all 0.25s ease;
            font-family: var(--body-font);
        }
        .search-view-all:hover {
            gap: 14px;
            color: #c9a84c;
        }

        /* Mobile: collapse to single column */
        @media (max-width: 900px) {
            .search-overlay {
                grid-template-columns: 1fr;
                grid-template-rows: auto 1fr;
            }
            .search-left-panel {
                padding: 24px 20px 18px;
                gap: 0;
            }
            .search-brand-mark { margin-bottom: 14px; }
            .search-cat-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 8px;
                margin-bottom: 0;
            }
            .search-cat-card { padding: 10px 6px; font-size: 0.7rem; }
            .search-cat-card i { font-size: 1.1rem; }
            .search-left-footer { display: none; }
            .search-panel-title { margin-bottom: 10px; }
            .search-input-container { padding: 24px 20px 24px; }
            .search-input-container h2 { font-size: 1.5rem; letter-spacing: 2px; }
            .search-close { top: 14px; right: 14px; width: 36px; height: 36px; font-size: 1.1rem; }
        }

        /* ===== SIDE CART DRAWER — ULTRA PREMIUM ===== */
        .drawer-overlay {
            position: fixed;
            inset: 0;
            background: rgba(18, 13, 4, 0.4);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .drawer-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .side-drawer {
            position: fixed;
            top: 0;
            right: -480px;
            width: 450px;
            height: 100vh;
            background: linear-gradient(145deg, #fafaf7 0%, #f5efe3 50%, #fafaf7 100%);
            border-left: 4px solid var(--brand-gold);
            z-index: 10000;
            box-shadow: -10px 0 50px rgba(0, 0, 0, 0.15);
            transition: right 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .side-drawer.active {
            right: 0;
        }

        .drawer-header {
            padding: 35px 35px 25px;
            background: transparent;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }
        .drawer-header::after {
            content: '';
            position: absolute;
            bottom: 0; left: 35px; right: 35px;
            height: 1px;
            background: linear-gradient(90deg, rgba(181,141,85,0.3), transparent);
        }

        .drawer-header-title {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .drawer-header-title h3 {
            font-family: var(--heading-font);
            font-size: 1.6rem;
            font-weight: 400;
            color: #1a1208;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 3px;
        }
        .drawer-header-subtitle {
            font-size: 0.65rem;
            color: #b8a88a;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .close-drawer {
            width: 40px; height: 40px;
            background: #fff;
            border: 1.5px solid rgba(181,141,85,0.2);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
            cursor: pointer;
            color: #666;
            transition: all 0.35s cubic-bezier(0.34,1.56,0.64,1);
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }

        .close-drawer:hover {
            background: var(--brand-gold);
            border-color: var(--brand-gold);
            color: #fff;
            transform: rotate(90deg) scale(1.1);
            box-shadow: 0 6px 20px rgba(181,141,85,0.4);
        }

        .drawer-body {
            flex: 1;
            overflow-y: auto;
            padding: 25px 35px;
            /* Custom scrollbar for drawer */
            scrollbar-width: thin;
            scrollbar-color: rgba(181,141,85,0.3) transparent;
        }
        .drawer-body::-webkit-scrollbar { width: 6px; }
        .drawer-body::-webkit-scrollbar-thumb { background: rgba(181,141,85,0.3); border-radius: 4px; }

        .drawer-item {
            display: flex;
            gap: 18px;
            margin-bottom: 20px;
            padding: 16px;
            background: #fff;
            border: 1px solid rgba(181,141,85,0.15);
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
            transition: all 0.3s ease;
            position: relative;
        }
        .drawer-item:hover {
            border-color: rgba(181,141,85,0.4);
            box-shadow: 0 8px 25px rgba(0,0,0,0.06), 0 2px 8px rgba(181,141,85,0.08);
            transform: translateY(-2px);
        }

        .drawer-item img {
            width: 85px;
            height: 85px;
            object-fit: cover;
            border-radius: 10px;
            background: #faf8f4;
            padding: 4px;
            border: 1px solid rgba(181,141,85,0.1);
        }

        .drawer-item-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2px 0;
        }

        .drawer-item-name {
            font-family: var(--heading-font);
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 4px;
            display: block;
            text-decoration: none;
            color: #1a1208;
            line-height: 1.3;
            letter-spacing: 0.5px;
        }

        .drawer-item-meta {
            font-size: 0.7rem;
            color: #b8a88a;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }

        .drawer-item-price {
            font-weight: 600;
            color: var(--brand-gold);
            font-size: 1.05rem;
        }

        .drawer-qty-controls {
            display: flex;
            align-items: center;
            gap: 12px;
            background: #fafaf7;
            padding: 4px 8px;
            border-radius: 20px;
            border: 1px solid rgba(181,141,85,0.1);
            width: fit-content;
        }

        .qty-btn {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: none;
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #666;
        }

        .qty-btn:hover {
            background: var(--brand-gold);
            color: #fff;
            box-shadow: 0 4px 10px rgba(181,141,85,0.3);
        }

        .remove-item-btn {
            background: #fff;
            border: 1px solid rgba(181,141,85,0.2);
            width: 30px; height: 30px;
            border-radius: 50%;
            color: #a89f91;
            cursor: pointer;
            font-size: 0.9rem;
            display: flex; align-items: center; justify-content: center;
            transition: all 0.3s ease;
            position: absolute;
            top: -10px; right: -10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            opacity: 0;
        }
        .drawer-item:hover .remove-item-btn {
            opacity: 1;
        }

        .remove-item-btn:hover {
            color: #fff;
            background: #e74c3c;
            border-color: #e74c3c;
            transform: scale(1.1);
            box-shadow: 0 4px 12px rgba(231,76,60,0.3);
        }

        /* Empty State */
        .drawer-empty {
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #b8a88a;
            animation: subtitleFade 0.6s ease both;
        }
        .drawer-empty-icon {
            width: 80px; height: 80px;
            background: #fff;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 2.2rem;
            color: var(--brand-gold);
            box-shadow: 0 10px 30px rgba(181,141,85,0.15);
            margin-bottom: 24px;
            border: 1px solid rgba(181,141,85,0.1);
            animation: gemFloat 4s ease-in-out infinite;
        }
        .drawer-empty h4 {
            font-family: var(--heading-font);
            color: #1a1208;
            font-size: 1.4rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 8px;
        }
        .drawer-empty p {
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            margin-bottom: 30px;
        }
        .btn-continue-shopping {
            display: inline-block;
            padding: 12px 30px;
            background: transparent;
            color: var(--brand-gold);
            border: 1.5px solid var(--brand-gold);
            border-radius: 30px;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 2px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-continue-shopping:hover {
            background: var(--brand-gold);
            color: #fff;
            box-shadow: 0 6px 20px rgba(181,141,85,0.3);
            transform: translateY(-2px);
        }

        .drawer-footer {
            padding: 25px 35px 35px;
            background: #fff;
            border-top: 1px solid rgba(181,141,85,0.15);
            box-shadow: 0 -10px 30px rgba(0,0,0,0.02);
            position: relative;
        }

        .drawer-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 20px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .drawer-total-val {
            font-family: var(--heading-font);
            font-size: 1.5rem;
            color: #1a1208;
            font-weight: 600;
            letter-spacing: 0;
        }

        .btn-drawer-checkout {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 18px;
            background: linear-gradient(135deg, #c9a84c, var(--brand-gold));
            color: #fff;
            border-radius: 12px;
            text-align: center;
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(181,141,85,0.3);
        }

        .btn-drawer-checkout:hover {
            background: linear-gradient(135deg, var(--brand-gold), #e8c97a);
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(181,141,85,0.45);
        }

        .btn-drawer-view-cart {
            display: block;
            text-align: center;
            margin-top: 16px;
            color: #b8a88a;
            text-decoration: none;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: color 0.3s ease;
            font-weight: 500;
        }

        .btn-drawer-view-cart:hover {
            color: var(--brand-gold);
        }

        @media (max-width: 500px) {
            .side-drawer {
                width: 100%;
                right: -100%;
            }
            .drawer-header { padding: 25px 25px 20px; }
            .drawer-body { padding: 20px 25px; }
            .drawer-footer { padding: 20px 25px 25px; }
        }

        /* ===== GLOBAL AUTH MODAL STYLES ===== */
        .auth-modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6); /* More transparent outside */
            backdrop-filter: blur(3px); /* Subtle blur */
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
        }

        .auth-modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .auth-modal-box {
            background: #fff;
            width: 95%;
            max-width: 950px;
            border-radius: 16px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.5);
            position: relative;
            transform: translateY(40px);
            transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
            display: flex;
            overflow: hidden;
        }

        .auth-modal-overlay.active .auth-modal-box {
            transform: translateY(0);
        }

        .auth-image-side {
            flex: 1;
            background: url("https://images.unsplash.com/photo-1543163521-1bf539c55dd2?q=80&w=1200") center/cover no-repeat;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            text-align: center;
        }

        .auth-image-side::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(42, 12, 12, 0.85) 0%, rgba(90, 25, 25, 0.6) 100%);
        }

        .auth-image-content {
            position: relative;
            z-index: 2;
            color: var(--brand-light);
            border: 2px solid rgba(0, 0, 0, 0.4);
            padding: 30px 20px;
            border-radius: 200px 200px 0 0; /* Rajwadi Arch */
            background: rgba(0,0,0,0.2);
            backdrop-filter: blur(4px);
        }

        .auth-image-content h2 {
            font-family: 'Inter', serif;
            font-size: 2.2rem;
            color: var(--brand-gold);
            margin-bottom: 15px;
        }

        .auth-image-content p {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #e0d5c1;
        }

        .auth-form-side {
            flex: 1.2;
            padding: 60px;
            background: #fff;
            position: relative;
            background-image: radial-gradient(circle at right top, rgba(0, 0, 0, 0.05) 0%, transparent 50%);
            display: flex;
            flex-direction: column;
        }

        .auth-scroll-area {
            flex: 1;
            overflow-y: auto;
            padding-right: 10px;
        }

        .auth-scroll-area::-webkit-scrollbar {
            width: 4px;
        }
        
        .auth-scroll-area::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, 0.5);
            border-radius: 4px;
        }

        .auth-divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 25px 0;
            color: var(--brand-grey);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .auth-divider::before, .auth-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid rgba(0, 0, 0, 0.3);
        }

        .auth-divider:not(:empty)::before {
            margin-right: 15px;
        }

        .auth-divider:not(:empty)::after {
            margin-left: 15px;
        }

        .btn-google {
            width: 100%;
            background: #fff;
            color: #333;
            border: 1px solid #ddd;
            padding: 15px;
            font-size: 0.95rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 25px;
        }

        .btn-google:hover {
            background: #f5f5f5;
            border-color: #ccc;
        }

        .btn-google img {
            width: 20px;
        }

        .auth-modal-overlay.active .auth-modal-box {
            transform: translateY(0);
        }

        .btn-close-modal {
            position: absolute;
            top: 20px;
            right: 25px;
            background: #fff;
            width: 35px;
            height: 35px;
            border-radius: 0; /* Sharp Square */
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--brand-gold);
            font-size: 1.2rem;
            color: var(--brand-dark);
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .btn-close-modal:hover {
            background: var(--brand-gold);
            color: #fff;
            transform: rotate(90deg);
        }

        .auth-tabs {
            display: flex;
            border-bottom: 2px solid rgba(0, 0, 0, 0.2);
            margin-bottom: 35px;
        }

        .auth-tab {
            flex: 1;
            text-align: center;
            padding: 15px;
            font-family: 'Inter', serif;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--brand-grey);
            cursor: pointer;
            border-bottom: 2px solid transparent;
            transition: all 0.3s;
        }

        .auth-tab.active {
            color: var(--brand-dark);
            border-bottom-color: var(--brand-gold);
        }

        .auth-form {
            display: none;
        }

        .auth-form.active {
            display: block;
        }

        .reg-grid-mobile {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        @media (max-width: 768px) {
            .reg-grid-mobile {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

        .form-group-modal {
            margin-bottom: 20px;
        }

        .form-group-modal label {
            display: block;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--brand-grey);
            margin-bottom: 8px;
        }

        .form-control-modal {
            width: 100%;
            padding: 15px;
            background: #fdfaf7;
            border: 1px solid rgba(0, 0, 0, 0.3);
            font-family: 'Outfit', sans-serif;
            font-size: 1rem;
            color: var(--brand-dark);
            outline: none;
            transition: all 0.3s ease;
        }

        .form-control-modal:focus {
            border-color: var(--brand-gold);
            box-shadow: 0 0 0 3px rgba(0, 0, 0, 0.1);
        }

        .btn-primary-modal {
            width: 100%;
            background: var(--brand-gold);
            color: #000000;
            border: none;
            padding: 20px;
            font-size: 1.1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 30px;
            cursor: pointer;
            transition: all 0.4s ease;
        }

        /* ===== PREMIUM MOBILE REFINEMENTS ===== */
        @media (max-width: 768px) {
            :root {
                --navbar-height: 70px;
            }

            body {
                font-size: 14px;
            }

            .top-bar {
                display: none !important; /* Hide top bar on mobile to save space */
            }

            .header-main {
                padding: 0 20px;
                height: var(--navbar-height);
            }

            /* Stack sections gracefully */
            .delivery-offers-section,
            .details-layout-split,
            .footer-grid {
                display: flex !important;
                flex-direction: column !important;
                gap: 30px;
            }

            .pincode-input-wrap {
                flex-wrap: wrap;
                gap: 10px;
            }

            .pincode-input-wrap input {
                border-radius: 4px !important;
            }

            .pincode-input-wrap .check-btn {
                width: 100%;
                border-radius: 4px !important;
            }

            /* Improved Mobile Typography */
            h1, .premium-title { font-size: 2rem !important; }
            h2 { font-size: 1.8rem !important; }
            h3 { font-size: 1.4rem !important; }

            /* Sticky Bar Optimization */
            .sticky-atc-bar {
                padding: 10px 15px;
            }
            .sticky-promo-banner {
                display: none !important; /* Hide promo on mobile sticky bar */
            }
            .btn-sticky-buy, .btn-sticky-atc {
                padding: 12px 15px;
                font-size: 0.8rem;
            }
        }



        /* ===== PROPER TRANSPARENT AJAX LOADER ===== */
        .ajax-loading-overlay {
            position: fixed;
            inset: 0;
            background: rgba(42, 12, 12, 0.15); /* Ultra-light brand tint */
            backdrop-filter: blur(12px); /* Premium glassmorphism */
            -webkit-backdrop-filter: blur(12px);
            z-index: 11000;
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        
        .ajax-loading-overlay.active {
            display: flex;
            opacity: 1;
        }

        .diamond-facet-loader {
            width: 80px;
            height: 80px;
            position: relative;
            transform: rotate(45deg);
            animation: diamond-spin 2s infinite ease-in-out;
        }

        .diamond-facet-loader::before {
            content: '';
            position: absolute;
            inset: 0;
            border: 3px solid var(--brand-gold);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.4), inset 0 0 15px rgba(0, 0, 0, 0.2);
            animation: facet-pulse 2s infinite alternate;
        }

        @keyframes diamond-spin {
            0% { transform: rotate(45deg) scale(0.8); }
            50% { transform: rotate(225deg) scale(1.1); }
            100% { transform: rotate(405deg) scale(0.8); }
        }

        @keyframes facet-pulse {
            from { border-color: var(--brand-gold); box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); }
            to { border-color: #fff; box-shadow: 0 0 30px rgba(0, 0, 0, 0.6); }
        }

        .loader-brand-label {
            position: absolute;
            bottom: -50px;
            left: 50%;
            transform: translateX(-50%);
            color: var(--brand-gold);
            font-family: var(--heading-font);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 4px;
            white-space: nowrap;
            font-weight: 600;
        }

        /* ===== LUXURY LOADER ===== */
        #luxury-loader {
            position: fixed;
            inset: 0;
            background: #0a0a0f;
            z-index: 99999;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            overflow: hidden;
            animation: exitLoader 0.7s forwards 4.8s;
        }

        @keyframes exitLoader {
            0% { transform: translateY(0); opacity: 1; }
            100% { transform: translateY(-20px); opacity: 0; visibility: hidden; }
        }

        .loader-content {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Step 1: Dark Flash */
        .flash-point {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 2px;
            height: 2px;
            background: #fff;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            box-shadow: 0 0 20px 10px #fff;
            opacity: 0;
            animation: flashAnim 0.3s forwards ease-in-out;
            z-index: 10;
        }

        @keyframes flashAnim {
            0% { opacity: 0; transform: translate(-50%, -50%) scale(0); }
            50% { opacity: 1; transform: translate(-50%, -50%) scale(1.5); }
            100% { opacity: 0; transform: translate(-50%, -50%) scale(0); }
        }

        /* Step 2: Diamond Facet Build */
        .diamond-container {
            position: relative;
            width: 120px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            animation: fadeInContainer 0.1s forwards 0.3s;
        }

        @keyframes fadeInContainer {
            to { opacity: 1; }
        }

        .diamond-svg {
            width: 100px;
            height: 100px;
            z-index: 2;
        }

        .diamond-path {
            stroke-dasharray: 400;
            stroke-dashoffset: 400;
            animation: drawDiamond 1.5s forwards ease-in-out 0.3s;
            filter: drop-shadow(0 0 4px rgba(196, 160, 100, 0.4));
        }

        @keyframes drawDiamond {
            to { stroke-dashoffset: 0; }
        }

        /* Step 3: Golden Glow Burst */
        .glow-burst {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 0;
            height: 0;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(196,160,100,0.8) 0%, rgba(10,10,15,0) 70%);
            opacity: 0;
            z-index: 1;
            animation: burstAnim 0.5s forwards ease-out 1.8s;
        }

        @keyframes burstAnim {
            0% { width: 0; height: 0; opacity: 1; }
            50% { width: 150px; height: 150px; opacity: 0.8; }
            100% { width: 300px; height: 300px; opacity: 0; }
        }

        .sparkle {
            position: absolute;
            color: #f0d898;
            font-size: 20px;
            opacity: 0;
            animation: sparkleAnim 0.5s forwards;
            text-shadow: 0 0 10px #c4a064;
        }
        .s1 { top: 10%; left: 10%; animation-delay: 1.8s; }
        .s2 { top: 20%; right: 10%; animation-delay: 1.9s; }
        .s3 { bottom: 20%; left: 20%; animation-delay: 2.0s; }
        .s4 { bottom: 10%; right: 20%; animation-delay: 2.1s; }

        @keyframes sparkleAnim {
            0% { opacity: 0; transform: scale(0) rotate(0deg); }
            50% { opacity: 1; transform: scale(1.5) rotate(45deg); }
            100% { opacity: 0; transform: scale(0) rotate(90deg); }
        }

        /* Step 4: Letter Drop */
        .text-container {
            position: relative;
            margin-top: 30px;
            font-family: 'Playfair Display', serif;
            font-size: 3rem;
            font-weight: 400;
            display: inline-block;
        }

        .letters-wrapper {
            display: flex;
            color: #f0e8d5;
        }

        .letter, .letter-fill {
            display: inline-block;
            width: 45px;
            text-align: center;
        }

        .letter {
            opacity: 0;
            transform: translateY(-30px);
            animation: letterDrop 0.5s forwards cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .l1 { animation-delay: 2.3s; }
        .l2 { animation-delay: 2.4s; }
        .l3 { animation-delay: 2.5s; }
        .l4 { animation-delay: 2.6s; }
        .l5 { animation-delay: 2.7s; }
        .l6 { animation-delay: 2.8s; }
        .l7 { animation-delay: 2.9s; }

        @keyframes letterDrop {
            to { opacity: 1; transform: translateY(0); }
        }

        /* Step 5: Gold Liquid Fill */
        .liquid-fill-overlay {
            position: absolute;
            top: 0;
            left: 0;
            display: flex;
            background: linear-gradient(to top, #c4a064 0%, #f0d898 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            clip-path: inset(100% 0 0 0);
            animation: liquidFill 1s forwards ease-in-out 3.2s;
        }

        .letter-fill {
            opacity: 0;
            animation: fillVisible 0.1s forwards 3.2s;
        }

        @keyframes fillVisible {
            to { opacity: 1; }
        }

        @keyframes liquidFill {
            to { clip-path: inset(0 0 0 0); }
        }

        /* Step 6: Tagline Fade */
        .tagline {
            margin-top: 15px;
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            color: #8a7040;
            letter-spacing: 6px;
            text-transform: uppercase;
            opacity: 0;
            animation: taglineFade 0.6s forwards 4.2s;
        }

        @keyframes taglineFade {
            to { opacity: 1; }
        }
    </style>
</head>

<body>




    <!-- Proper Transparent AJAX Action Loader -->
    <div class="ajax-loading-overlay" id="ajaxLoader">
        <div class="diamond-facet-loader">
            <div class="loader-brand-label">Lexoria Diamond</div>
        </div>
    </div>

    <!-- Top Bar -->
    <div class="top-bar">
        <div class="top-bar-left">
            <a href="{{ route('track-order') }}">Track Order</a>
            <a href="{{ route('store-locator') }}">Store Locator</a>
            <a href="{{ route('contact-us') }}">Contact</a>
        </div>
    </div>

    <!-- Main Header -->
    <div class="main-header-container">
        <header class="header-main">
            <!-- Left Navigation -->
            <nav class="nav-left">
                <div class="nav-item">
                    <a href="{{ route('collections') }}" class="nav-link">Jewellery</a>
                    <div class="mega-menu">
                        <div class="mega-nav-grid">
                            <div class="category-group">
                                <h4>Shop by Design</h4>
                                <a href="{{ route('collections') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-gem"></i></div>
                                    <div class="tile-text"><span>Rings</span><small>Timeless Radiance</small></div>
                                </a>
                                <a href="{{ route('collections') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-stars"></i></div>
                                    <div class="tile-text"><span>Earrings</span><small>Elegant Statements</small></div>
                                </a>
                                <a href="{{ route('collections') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-exclude"></i></div>
                                    <div class="tile-text"><span>Necklaces</span><small>Exquisite Grace</small></div>
                                </a>
                            </div>
                            <div class="category-group">
                                <h4>Metals & Assets</h4>
                                <a href="{{ route('collections') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-brightness-high"></i></div>
                                    <div class="tile-text"><span>Pure Gold</span><small>22KT & 18KT</small></div>
                                </a>
                                <a href="{{ route('collections') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-diamond"></i></div>
                                    <div class="tile-text"><span>Certified Diamond</span><small>Luxury
                                            Brilliance</small></div>
                                </a>
                                <a href="{{ route('collections') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-flower1"></i></div>
                                    <div class="tile-text"><span>Rose Gold</span><small>Modern Feminine</small></div>
                                </a>
                            </div>
                            <div class="category-group">
                                <h4>Special Occasions</h4>
                                <a href="{{ route('collections') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-heart-pulse"></i></div>
                                    <div class="tile-text"><span>The Bridal Store</span><small>Your Special Day</small>
                                    </div>
                                </a>
                                <a href="{{ route('collections') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-gift"></i></div>
                                    <div class="tile-text"><span>Gifts for Him</span><small>Classic Mastery</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="mega-showcase">
                            <div class="showcase-card">
                                <img src="https://images.unsplash.com/photo-1515562141207-7a88fb7ce338"
                                    alt="Featured Jewellery">
                                <div class="showcase-overlay">
                                    <span class="showcase-label">Boutique Exclusive</span>
                                    <h3 class="showcase-title">The Vintage Gold Heritage</h3>
                                    <a href="{{ route('collections') }}" class="btn-mini">Explore Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nav-item">
                    <a href="{{ route('collections') }}" class="nav-link">Diamonds</a>
                    <div class="mega-menu">
                        <div class="mega-nav-grid">
                            <div class="category-group">
                                <h4>Diamond Shapes</h4>
                                <a href="{{ route('diamond-shapes') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-octagon"></i></div>
                                    <div class="tile-text"><span>Round Brilliant</span><small>Ultimate Sparkle</small>
                                    </div>
                                </a>
                                <a href="{{ route('diamond-shapes') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-pentagon"></i></div>
                                    <div class="tile-text"><span>Emerald Cut</span><small>Vintage Sophistication</small>
                                    </div>
                                </a>
                                <a href="{{ route('diamond-shapes') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-suit-heart"></i></div>
                                    <div class="tile-text"><span>Heart Shape</span><small>Pure Romance</small></div>
                                </a>
                            </div>
                            <div class="category-group">
                                <h4>Education</h4>
                                <a href="{{ route('diamond-education') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-journal-text"></i></div>
                                    <div class="tile-text"><span>Diamond Guide</span><small>Discover the 4Cs</small>
                                    </div>
                                </a>
                                <a href="{{ route('diamond-education') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-shield-check"></i></div>
                                    <div class="tile-text"><span>Certification</span><small>GIA & IGI Standards</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="mega-showcase">
                            <div class="showcase-card">
                                <img src="https://images.unsplash.com/photo-1601121141461-9d6647bca1ed" alt="Diamonds">
                                <div class="showcase-overlay">
                                    <span class="showcase-label">Investment</span>
                                    <h3 class="showcase-title">Rare Solitaire Masterpieces</h3>
                                    <a href="{{ route('investment-masterpieces') }}" class="btn-mini">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nav-item">
                    <a href="{{ route('collections') }}" class="nav-link">Collections</a>
                    <div class="mega-menu">
                        <div class="mega-nav-grid">
                            <div class="category-group">
                                <h4>Curated Series</h4>
                                <a href="{{ route('collections') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-palette"></i></div>
                                    <div class="tile-text"><span>The Artist Series</span><small>Handcrafted Masterpieces</small></div>
                                </a>
                                <a href="{{ route('collections') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-moon-stars"></i></div>
                                    <div class="tile-text"><span>Celestial Moods</span><small>Inspired by Night</small></div>
                                </a>
                                <a href="{{ route('collections') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-heart-pulse"></i></div>
                                    <div class="tile-text"><span>Signature Wedding</span><small>Your Forever Story</small></div>
                                </a>
                            </div>
                            <div class="category-group">
                                <h4>Latest Stories</h4>
                                <a href="{{ route('collections') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-camera"></i></div>
                                    <div class="tile-text"><span>Spring Glow '24</span><small>New Arrivals</small></div>
                                </a>
                                <a href="{{ route('collections') }}" class="category-tile">
                                    <div class="tile-icon"><i class="bi bi-stars"></i></div>
                                    <div class="tile-text"><span>Starlight Galaxy</span><small>Limited Edition</small></div>
                                </a>
                            </div>
                        </div>
                        <div class="mega-showcase">
                            <div class="showcase-card">
                                <img src="https://images.unsplash.com/photo-1543163521-1bf539c55dd2?q=80&w=800" alt="Special Collection">
                                <div class="showcase-overlay">
                                    <span class="showcase-label">Artisan Spotlight</span>
                                    <h3 class="showcase-title">The Diamond Bridal Edit</h3>
                                    <a href="{{ route('collections') }}" class="btn-mini">View Lookbook</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="nav-item">
                    <a href="{{ route('customized') }}" class="nav-link">Customized</a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('about') }}" class="nav-link">About</a>
                </div>
            </nav>

            <!-- Toggle for Mobile -->
            <div class="mobile-menu-toggle">
                <i class="bi bi-list"></i>
            </div>

            <!-- Logo with pop-out container -->
            <div class="header-logo">
                <a href="/" class="logo-pop-container">
                    <img src="{{ asset($settings['logo'] ?? 'img/lexoria-logo.png') }}" class="desktop-logo" alt="{{ $settings['store_name'] ?? 'Meet Diamond' }} Logo">
                    <img src="{{ asset($settings['logo'] ?? 'img/lexoria-logo.png') }}" class="mobile-logo" alt="{{ $settings['store_name'] ?? 'Meet Diamond' }} Logo">
                </a>
            </div>

            @php
                $cartItems = [];
                if(auth()->check()) {
                    $dbItems = \App\Models\CartItem::with('product')->where('user_id', auth()->id())->get();
                    foreach($dbItems as $dbItem) {
                        $cartItems[$dbItem->product_id] = [
                            'id' => $dbItem->product_id,
                            'name' => $dbItem->product->name,
                            'quantity' => $dbItem->quantity,
                            'price' => $dbItem->product->price,
                            'image' => $dbItem->product->image
                        ];
                    }
                } else {
                    $cartItems = session()->get('cart', []);
                }
                $cartCount = count($cartItems);
            @endphp
            <!-- Right Actions -->
            <div class="header-right">
                <div class="search-trigger">
                    <i class="bi bi-search"></i>
                </div>
                <div class="header-actions">
                    @auth
                        <div class="nav-item user-dropdown-parent" style="position: relative;">
                            <a href="javascript:void(0)" class="action-icon" title="My Account">
                                <i class="bi bi-person-check-fill"></i>
                            </a>
                            <div class="user-dropdown">
                                <div class="user-info-brief">
                                    <strong>{{ auth()->user()->name }}</strong>
                                    <span>{{ auth()->user()->email }}</span>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('profile.index') }}" class="dropdown-link"><i class="bi bi-grid"></i> Dashboard</a>
                                <a href="{{ route('orders.index') }}" class="dropdown-link"><i class="bi bi-box-seam"></i> Order History</a>
                                <a href="{{ route('wishlist.index') }}" class="dropdown-link"><i class="bi bi-heart"></i> Wishlist</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                    @csrf
                                    <button type="submit" class="dropdown-link logout-btn"><i class="bi bi-power"></i> Logout</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="action-icon" title="Login">
                            <i class="bi bi-person"></i>
                        </a>
                    @endauth
                    <a href="{{ route('wishlist.index') }}" class="action-icon" title="Wishlist">
                        <i class="bi bi-heart"></i>
                        @php
                            $wCount = auth()->check() ? \App\Models\WishlistItem::where('user_id', auth()->id())->count() : count(session()->get('wishlist', []));
                        @endphp
                        <span class="badge-count wishlist-count">{{ $wCount }}</span>
                    </a>
                    <a href="javascript:void(0)" class="action-icon" id="cartTrigger" title="Cart">
                        <i class="bi bi-bag"></i>
                        <span class="badge-count header-cart-count">{{ $cartCount }}</span>
                    </a>
                </div>
            </div>
        </header>

        <!-- Category Nav (Visible on Desktop) -->
        <nav class="secondary-nav">
            <a href="{{ route('products') }}" class="cat-link">
                <i class="bi bi-grid-3x3-gap" style="color: var(--brand-gold); font-size: 1.1rem;"></i>
                <span>Shop All</span>
            </a>
            <a href="{{ route('collections') }}" class="cat-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="4" y="10" width="16" height="6" rx="1" />
                    <rect x="6" y="5" width="12" height="5" rx="1" />
                    <rect x="2" y="15" width="20" height="5" rx="1" />
                </svg>
                <span>Gold</span>
            </a>
            <a href="{{ route('collections') }}" class="cat-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M2.5 7.5L12 21.5L21.5 7.5L16.5 2.5H7.5L2.5 7.5Z" />
                    <path d="M2.5 7.5H21.5" />
                    <path d="M7.5 2.5L12 7.5L16.5 2.5" />
                    <path d="M12 7.5V21.5" />
                </svg>
                <span>Diamond</span>
            </a>
            <a href="{{ route('collections') }}" class="cat-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="14" r="6" />
                    <path d="M10 6L12 2L14 6H10Z" />
                </svg>
                <span>Solitaire</span>
            </a>


            <a href="{{ route('collections') }}" class="cat-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="9" cy="12" r="5" />
                    <circle cx="15" cy="12" r="5" />
                </svg>
                <span>Bridal</span>
            </a>
            <a href="{{ route('collections') }}" class="cat-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="14" r="6" />
                    <polygon points="12,3 14,6 10,6" />
                </svg>
                <span>Engagement</span>
            </a>
            <a href="{{ route('collections') }}" class="cat-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="8" cy="15" r="3" />
                    <circle cx="16" cy="15" r="3" />
                    <path d="M8 12V5C8 3 9 3 10 4" />
                    <path d="M16 12V5C16 3 15 3 14 4" />
                </svg>
                <span>Earrings</span>
            </a>
            <a href="{{ route('collections') }}" class="cat-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="13" r="6" />
                    <path d="M10 7 L14 7 L13 4 L11 4 Z" />
                </svg>
                <span>Rings</span>
            </a>
            <a href="{{ route('collections') }}" class="cat-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M4 6 C4 6, 12 18, 20 6" />
                    <circle cx="12" cy="16" r="3" />
                </svg>
                <span>Necklaces</span>
            </a>
            <a href="{{ route('collections') }}" class="cat-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="6" />
                    <path d="M12 6V3M12 21v-3M9 4h6M9 20h6" />
                </svg>
                <span>Men's</span>
            </a>
            <a href="{{ route('collections') }}" class="cat-link">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <rect x="4" y="9" width="16" height="12" rx="1" />
                    <rect x="2" y="6" width="20" height="3" rx="1" />
                    <path d="M12 9V22" />
                    <path d="M12 6C12 6 8 2 6 4C4 6 8 6 12 6Z" />
                    <path d="M12 6C12 6 16 2 18 4C20 6 16 6 12 6Z" />
                </svg>
                <span>Gifts</span>
            </a>
        </nav>
    </div>

    <!-- Alert Messages (Premium Design) -->
    <div class="premium-alert-container" id="alertContainer">
        @if(session('success'))
            <div class="premium-alert">
                <i class="bi bi-check2-circle"></i>
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button>
            </div>
        @endif
    </div>
    <style>
        .premium-alert-container {
            position: fixed;
            top: 120px;
            right: 30px;
            z-index: 10001;
            pointer-events: none;
        }

        .premium-alert {
            background: #fff;
            color: #1a1a1a;
            padding: 15px 25px;
            border-left: 4px solid var(--brand-gold);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 15px;
            border-radius: 4px;
            margin-bottom: 10px;
            animation: slideIn 0.5s ease;
            pointer-events: auto;
        }

        .d-none {
            display: none !important;
        }

        .premium-alert i {
            color: var(--brand-gold);
            font-size: 1.2rem;
        }

        .premium-alert button {
            background: none;
            border: none;
            cursor: pointer;
            color: #999;
            margin-left: 20px;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>

    <!-- Search Overlay — Ultra Animated -->
    <div class="search-overlay" id="searchOverlay">

        <!-- LEFT: Category + particles panel -->
        <div class="search-left-panel" id="searchLeftPanel">
            <!-- Floating diamond particles (JS injects these) -->
            <div class="search-particles" id="searchParticles"></div>

            <!-- Brand mark with orbiting dots -->
            <div class="search-brand-mark">
                <div class="search-brand-gem-wrap">
                    <div class="search-brand-gem"><i class="bi bi-gem"></i></div>
                    <span class="gem-orbit-dot"></span>
                    <span class="gem-orbit-dot"></span>
                </div>
                <div class="search-brand-text">
                    <span>Lexoria</span>
                    <strong>Diamonds</strong>
                </div>
            </div>

            <!-- Animated stats -->
            <div class="search-stats">
                <div class="search-stat stagger-s1">
                    <span class="search-stat-num" data-count="500">500+</span>
                    <span class="search-stat-label">Designs</span>
                </div>
                <div class="search-stat stagger-s2">
                    <span class="search-stat-num" data-count="22">22K</span>
                    <span class="search-stat-label">Gold</span>
                </div>
                <div class="search-stat stagger-s3">
                    <span class="search-stat-num">GIA</span>
                    <span class="search-stat-label">Certified</span>
                </div>
            </div>

            <p class="search-panel-title">Browse Categories</p>
            <div class="search-cat-grid">
                <a href="{{ route('collections') }}" class="search-cat-card stagger-1">
                    <i class="bi bi-circle-fill" style="font-size:0.8rem; color:#e8c97a;"></i>
                    <span>Rings</span>
                </a>
                <a href="{{ route('collections') }}" class="search-cat-card stagger-2">
                    <i class="bi bi-link-45deg"></i>
                    <span>Necklaces</span>
                </a>
                <a href="{{ route('collections') }}" class="search-cat-card stagger-3">
                    <i class="bi bi-asterisk"></i>
                    <span>Earrings</span>
                </a>
                <a href="{{ route('collections') }}" class="search-cat-card stagger-4">
                    <i class="bi bi-gem"></i>
                    <span>Solitaire</span>
                </a>
                <a href="{{ route('collections') }}" class="search-cat-card stagger-5">
                    <i class="bi bi-heart"></i>
                    <span>Bridal</span>
                </a>
                <a href="{{ route('collections') }}" class="search-cat-card stagger-6">
                    <i class="bi bi-stars"></i>
                    <span>Gold</span>
                </a>
            </div>

            <div class="search-left-footer">
                <div class="search-kbd-hint">
                    <span class="search-kbd">ESC</span>
                    <span>to close</span>
                    <span class="search-kbd">Enter</span>
                    <span>to search</span>
                </div>
            </div>
        </div>

        <!-- RIGHT: Search panel -->
        <div class="search-right-panel">
            <div class="search-close" id="closeSearch">
                <i class="bi bi-x"></i>
            </div>
            <div class="search-input-container">
                <span class="search-sparkle">
                    <span class="search-sparkle-dot"></span>
                    <span class="search-sparkle-line"></span>
                    <span class="search-sparkle-label">Lexoria Search</span>
                </span>
                <h2>Find Your Piece</h2>
                <span class="search-subtitle">Discover exquisite jewellery crafted for you</span>
                <div class="search-input-wrapper">
                    <input type="text" id="searchInput" placeholder="Rings, necklaces, earrings..." autocomplete="off">
                    <button class="search-icon-btn" id="searchBtn"><i class="bi bi-search"></i></button>
                </div>
                <div class="search-char-hint" id="searchCharHint">Type at least 2 characters to search</div>
                <div class="search-results" id="searchResults"></div>
            </div>
        </div>

    </div>

    <!-- Side Cart Drawer -->
    <div class="drawer-overlay" id="cartOverlay"></div>
    <div class="side-drawer" id="cartDrawer">
        <div class="drawer-header">
            <div class="drawer-header-title">
                <h3>Shopping Bag</h3>
                <span class="drawer-header-subtitle"><span class="header-cart-count">{{ $cartCount }}</span> items</span>
            </div>
            <button class="close-drawer" id="closeCart"><i class="bi bi-x"></i></button>
        </div>
        <div class="drawer-body" id="drawerBody">
            @php 
                $total = 0; 
            @endphp
        @if(count($cartItems) > 0)
            @foreach($cartItems as $id => $item)
                @php $total += $item['price'] * $item['quantity']; @endphp
                <div class="drawer-item" data-id="{{ $id }}">
                    <button type="button" class="remove-item-btn ajax-remove" data-id="{{ $id }}" title="Remove Item">
                        <i class="bi bi-x"></i>
                    </button>
                    <img src="{{ str_starts_with($item['image'], 'http') ? $item['image'] : asset($item['image']) }}"
                        alt="{{ $item['name'] }}">
                    <div class="drawer-item-info">
                        <div>
                            <a href="#" class="drawer-item-name">{{ $item['name'] }}</a>
                            <div class="drawer-item-meta">{{ $item['collection'] ?? 'Lexoria Fine Jewelry' }}</div>
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: flex-end;">
                            <div class="drawer-qty-controls">
                                <button type="button" class="qty-btn ajax-update" data-id="{{ $id }}" data-qty="{{ $item['quantity'] - 1 }}" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>
                                    <i class="bi bi-dash"></i>
                                </button>
                                <span class="item-qty" style="font-size: 0.85rem; font-weight: 600; min-width: 20px; text-align: center;">{{ $item['quantity'] }}</span>
                                <button type="button" class="qty-btn ajax-update" data-id="{{ $id }}" data-qty="{{ $item['quantity'] + 1 }}">
                                    <i class="bi bi-plus"></i>
                                </button>
                            </div>
                            <div class="drawer-item-price">${{ number_format($item['price']) }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="drawer-empty">
                <div class="drawer-empty-icon"><i class="bi bi-bag"></i></div>
                <h4>Your Bag is Empty</h4>
                <p>Discover our exclusive collections and find the perfect piece.</p>
                <a href="{{ route('products') }}" class="btn-continue-shopping">Explore Collections</a>
            </div>
        @endif
        </div>
        <div class="drawer-footer {{ count($cartItems) > 0 ? '' : 'd-none' }}" id="drawerFooter">
            <div class="drawer-total">
                <span>Estimated Total</span>
                <span class="drawer-total-val" id="drawerTotalValue">${{ number_format($total) }}</span>
            </div>
            <a href="{{ route('checkout.index') }}" class="btn-drawer-checkout">
                <span>Secure Checkout</span>
                <i class="bi bi-lock-fill" style="font-size:1.1rem;"></i>
            </a>
            <a href="{{ route('cart.index') }}" class="btn-drawer-view-cart">View Full Bag</a>
        </div>
    </div>



    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenu">
        <div class="mobile-menu-header">
            <div class="mobile-menu-close" id="closeMobileMenu">
                <i class="bi bi-x-lg"></i>
            </div>
            <div class="mobile-logo-small">
                <img src="{{ asset('img/lexoria-logo.png') }}" alt="Logo">
            </div>
        </div>
        <div class="mobile-menu-body">
            <nav class="mobile-primary-nav">
                <a href="/" class="mobile-nav-link">Home</a>
                <a href="{{ route('collections') }}" class="mobile-nav-link">Collections</a>
                <a href="{{ route('products') }}" class="mobile-nav-link">Shop All</a>
                <a href="{{ route('collections') }}" class="mobile-nav-link">Baskets</a>
                <a href="{{ route('collections') }}" class="mobile-nav-link">Pendants</a>
                <a href="{{ route('customized') }}" class="mobile-nav-link">Customized</a>
                <a href="{{ route('collections') }}" class="mobile-nav-link">About Us</a>
            </nav>
            <div class="mobile-secondary-nav">
                <p class="menu-label">Shop By Category</p>
                <div class="mobile-cat-grid">
                    <a href="{{ route('collections') }}" class="mobile-cat-item">Gold</a>
                    <a href="{{ route('collections') }}" class="mobile-cat-item">Diamond</a>
                    <a href="{{ route('collections') }}" class="mobile-cat-item">Solitaire</a>
                    <a href="{{ route('collections') }}" class="mobile-cat-item">Bridal</a>
                    <a href="{{ route('collections') }}" class="mobile-cat-item">Engagement</a>
                    <a href="{{ route('collections') }}" class="mobile-cat-item">Earrings</a>
                </div>
            </div>
            <div class="mobile-menu-footer">
                <div class="mobile-action-links">
                    <a href="{{ route('wishlist.index') }}"><i class="bi bi-heart"></i> Wishlist</a>
                    @auth
                        <a href="{{ route('profile.index') }}"><i class="bi bi-person"></i> My Account</a>
                    @else
                        <a href="{{ route('login') }}"><i class="bi bi-person"></i> Login</a>
                    @endauth
                </div>
                <div class="mobile-social">
                    <a href="{{ route('collections') }}"><i class="bi bi-instagram"></i></a>
                    <a href="{{ route('collections') }}"><i class="bi bi-facebook"></i></a>
                    <a href="{{ route('collections') }}"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const header = document.querySelector('.main-header-container');
            const searchTrigger = document.querySelector('.search-trigger');
            const searchOverlay = document.getElementById('searchOverlay');
            const closeSearch = document.getElementById('closeSearch');

            // Scroll Effect for subtle height adjustment
            window.addEventListener('scroll', function () {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });

            // ═══════════════════════════════════════════════
            // SEARCH ANIMATIONS — Particles + Ripple + Glow
            // ═══════════════════════════════════════════════
            const particlesContainer = document.getElementById('searchParticles');
            const searchRightPanel   = document.querySelector('.search-right-panel');
            const gemSymbols = ['◆', '◇', '✦', '✧', '⬥', '★', '✶'];
            let particleInterval = null;

            function spawnParticle() {
                if (!particlesContainer) return;
                const p = document.createElement('span');
                p.className = 'search-particle';
                p.textContent = gemSymbols[Math.floor(Math.random() * gemSymbols.length)];
                p.style.left   = Math.random() * 100 + '%';
                p.style.bottom = '-10px';
                p.style.fontSize = (0.5 + Math.random() * 0.6) + 'rem';
                p.style.animationDuration  = (3 + Math.random() * 5) + 's';
                p.style.animationDelay     = '0s';
                p.style.opacity = 0.3 + Math.random() * 0.4;
                particlesContainer.appendChild(p);
                setTimeout(() => p.remove(), 8000);
            }

            // Ripple on category cards
            document.querySelectorAll('.search-cat-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    ripple.className = 'ripple';
                    const rect = card.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height) * 2;
                    ripple.style.width  = ripple.style.height = size + 'px';
                    ripple.style.left   = (e.clientX - rect.left - size / 2) + 'px';
                    ripple.style.top    = (e.clientY - rect.top  - size / 2) + 'px';
                    card.appendChild(ripple);
                    setTimeout(() => ripple.remove(), 700);
                });
            });

            // Cursor-tracking glow on right panel
            if (searchRightPanel) {
                searchRightPanel.addEventListener('mousemove', function(e) {
                    const rect = searchRightPanel.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    searchRightPanel.style.background =
                        `radial-gradient(ellipse 400px 300px at ${x}px ${y}px, rgba(181,141,85,0.06) 0%, transparent 70%), ` +
                        `linear-gradient(145deg, #fafaf7 0%, #f5efe3 50%, #fafaf7 100%)`;
                });
                searchRightPanel.addEventListener('mouseleave', function() {
                    searchRightPanel.style.background =
                        'linear-gradient(145deg, #fafaf7 0%, #f5efe3 50%, #fafaf7 100%)';
                });
            }

            // ═══════════════════════════════════════════
            // AUTO-OPEN SEARCH ON PAGE LOAD WITH ANIMATION
            // ═══════════════════════════════════════════
            function openSearch() {
                searchOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';

                // Burst particles immediately
                spawnParticle(); spawnParticle(); spawnParticle(); spawnParticle();
                particleInterval = setInterval(spawnParticle, 1200);

                // Load initial suggestions
                if (searchInput && searchInput.value === '') {
                    searchResultsContainer.innerHTML = trendingTagsHtml() +
                        `<p class="search-results-label">New Masterpieces</p>
                         <div class="search-loading"><div class="spinner"></div><span>Loading...</span></div>`;

                    fetch('{{ route("search.ajax") }}?q=new')
                        .then(res => res.json())
                        .then(products => {
                            if (products.length > 0) {
                                let html = trendingTagsHtml() + `<p class="search-results-label">New Masterpieces</p>`;
                                products.slice(0, 4).forEach(p => { html += buildResultCard(p); });
                                html += `<a href="{{ route('products') }}" class="search-view-all">View All Jewellery <i class="bi bi-arrow-right"></i></a>`;
                                searchResultsContainer.innerHTML = html;
                            }
                        }).catch(() => {});

                    setTimeout(() => searchInput.focus(), 600);
                }
            }

            const searchResultsContainer = document.getElementById('searchResults');
            let searchTimeout = null;

            const charHint = document.getElementById('searchCharHint');

            // Helper: build a product result card
            function buildResultCard(product) {
                return `
                    <a href="${product.url}" class="search-result-item">
                        <img src="${product.image}" alt="${product.name}" class="search-result-img">
                        <div class="search-result-info">
                            <span class="search-result-name">${product.name}</span>
                            <div class="search-result-meta">
                                <span class="search-result-price">$${Number(product.price).toLocaleString('en-US')}</span>
                                ${product.collection ? `<span class="search-result-collection">${product.collection}</span>` : ''}
                            </div>
                        </div>
                        <div class="search-result-arrow"><i class="bi bi-arrow-right"></i></div>
                    </a>`;
            }

            // Helper: trending tags HTML
            function trendingTagsHtml() {
                return `
                    <p class="search-results-label">Trending Searches</p>
                    <div class="trending-tags mb-4">
                        <span class="badge border" onclick="fillSearch('Diamond Rings')"><i class="bi bi-circle-fill" style="font-size:0.55rem;"></i> Diamond Rings</span>
                        <span class="badge border" onclick="fillSearch('Gold Necklaces')"><i class="bi bi-link-45deg"></i> Gold Necklaces</span>
                        <span class="badge border" onclick="fillSearch('Earrings')"><i class="bi bi-asterisk" style="font-size:0.65rem;"></i> Earrings</span>
                        <span class="badge border" onclick="fillSearch('Solitaire')"><i class="bi bi-gem" style="font-size:0.65rem;"></i> Solitaire</span>
                        <span class="badge border" onclick="fillSearch('Bridal')"><i class="bi bi-heart" style="font-size:0.65rem;"></i> Bridal</span>
                    </div>`;
            }

            // Search trigger click — reuse openSearch
            searchTrigger.addEventListener('click', () => {
                if (!searchOverlay.classList.contains('active')) {
                    openSearch();
                }
            });

            window.fillSearch = function(text) {
                searchInput.value = text;
                searchInput.dispatchEvent(new Event('input'));
                searchInput.focus();
            };

            closeSearch.addEventListener('click', () => {
                searchOverlay.classList.remove('active');
                document.body.style.overflow = 'auto';
                searchInput.value = '';
                searchResultsContainer.innerHTML = '';
                if (charHint) charHint.textContent = 'Type at least 2 characters to search';
                // Stop particles
                clearInterval(particleInterval);
                if (particlesContainer) particlesContainer.innerHTML = '';
            });

            // Escape key to close
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && searchOverlay.classList.contains('active')) {
                    closeSearch.click();
                }
            });

            // Live AJAX Search with Debounce + char hint
            searchInput.addEventListener('input', function () {
                const query = this.value.trim();
                clearTimeout(searchTimeout);

                // Update char hint
                if (charHint) {
                    if (query.length === 0) {
                        charHint.textContent = 'Type at least 2 characters to search';
                    } else if (query.length === 1) {
                        charHint.textContent = 'One more character...';
                    } else {
                        charHint.textContent = `Searching for "${query}"`;
                    }
                }

                if (query.length < 2) {
                    searchResultsContainer.innerHTML = '';
                    return;
                }

                searchResultsContainer.innerHTML = `
                    <div class="search-loading">
                        <div class="spinner"></div>
                        <span>Searching...</span>
                    </div>`;

                searchTimeout = setTimeout(() => {
                    fetch(`{{ route('search.ajax') }}?q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(products => {
                            if (charHint) charHint.textContent = products.length > 0 ? `${products.length} result${products.length > 1 ? 's' : ''} found` : 'No results found';
                            if (products.length === 0) {
                                searchResultsContainer.innerHTML = `
                                    <div class="search-no-results">
                                        <i class="bi bi-search"></i>
                                        <strong>No results found</strong>
                                        <span>Try different keywords or browse our categories</span>
                                    </div>`;
                                return;
                            }
                            let html = `<p class="search-results-label">Results for "${query}"</p>`;
                            products.forEach(p => { html += buildResultCard(p); });
                            html += `<a href="{{ route('products') }}?q=${encodeURIComponent(query)}" class="search-view-all">See all results <i class="bi bi-arrow-right"></i></a>`;
                            searchResultsContainer.innerHTML = html;
                        })
                        .catch(() => {
                            searchResultsContainer.innerHTML = `
                                <div class="search-no-results">
                                    <i class="bi bi-exclamation-circle"></i>
                                    <strong>Something went wrong</strong>
                                    <span>Please try again</span>
                                </div>`;
                        });
                }, 320);
            });

            // Side Cart Drawer Toggle
            const cartTrigger = document.getElementById('cartTrigger');
            const cartDrawer = document.getElementById('cartDrawer');
            const cartOverlay = document.getElementById('cartOverlay');
            const closeCart = document.getElementById('closeCart');

            const openDrawer = () => {
                cartDrawer.classList.add('active');
                cartOverlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            };

            const closeDrawer = () => {
                cartDrawer.classList.remove('active');
                cartOverlay.classList.remove('active');
                document.body.style.overflow = 'auto';
            };

            if (cartTrigger) cartTrigger.addEventListener('click', openDrawer);
            if (closeCart) closeCart.addEventListener('click', closeDrawer);
            if (cartOverlay) cartOverlay.addEventListener('click', closeDrawer);

            // AJAX Cart Functions
             window.updateCartUI = function(data) {
                // Update specific elements if needed
                const cartBadges = document.querySelectorAll('.header-cart-count');
                cartBadges.forEach(bc => bc.textContent = data.count);

                const drawerHeaderCount = document.querySelector('.header-cart-count');
                if (drawerHeaderCount) drawerHeaderCount.textContent = data.count;

                const drawerBody = document.getElementById('drawerBody');
                const drawerFooter = document.getElementById('drawerFooter');
                const drawerTotalValue = document.getElementById('drawerTotalValue');

                if (data.count === 0) {
                    drawerBody.innerHTML = `
                        <div style="text-align:center; padding-top: 50px; color: #999;">
                            <i class="bi bi-bag" style="font-size: 3rem; display:block; margin-bottom:15px;"></i>
                            <p>Your bag is empty.</p>
                        </div>
                    `;
                    if (drawerFooter) drawerFooter.style.display = 'none';
                } else {
                    if (drawerFooter) drawerFooter.style.display = 'block';
                    if (drawerTotalValue) drawerTotalValue.textContent = '$' + data.total.toLocaleString();

                    let html = '';
                    Object.keys(data.cart).forEach(id => {
                        const item = data.cart[id];
                        const qty = parseInt(item.quantity);
                        const price = parseFloat(item.price);
                        html += `
                            <div class="drawer-item" data-id="${id}">
                                <img src="${item.image.startsWith('http') ? item.image : '/' + item.image}" alt="${item.name}">
                                <div class="drawer-item-info">
                                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                        <span class="drawer-item-name">${item.name}</span>
                                        <button type="button" class="remove-item-btn ajax-remove" data-id="${id}" title="Remove Item">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </div>
                                    <div class="drawer-item-price">$${price.toLocaleString()}</div>
                                    <div class="drawer-qty-controls">
                                        <button type="button" class="qty-btn ajax-update" data-id="${id}" data-qty="${qty - 1}" ${qty <= 1 ? 'disabled' : ''}>
                                            <i class="bi bi-dash"></i>
                                        </button>
                                        <span class="item-qty" style="font-size: 0.9rem; font-weight: 600; min-width: 20px; text-align: center;">${qty}</span>
                                        <button type="button" class="qty-btn ajax-update" data-id="${id}" data-qty="${qty + 1}">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    drawerBody.innerHTML = html;
                }
            };

             window.showNotification = function(message) {
                const container = document.getElementById('alertContainer');
                const alert = document.createElement('div');
                alert.className = 'premium-alert';
                alert.innerHTML = `
                    <i class="bi bi-check2-circle"></i>
                    <span>${message}</span>
                    <button onclick="this.parentElement.remove()"><i class="bi bi-x"></i></button>
                `;
                container.appendChild(alert);
                setTimeout(() => {
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateX(50px)';
                    alert.style.transition = 'all 0.5s ease';
                    setTimeout(() => alert.remove(), 500);
                }, 4000);
            };

            // Event Delegation for AJAX actions
             document.body.addEventListener('click', function(e) {
                const atcForm = e.target.closest('.ajax-atc-form');
                const wishlistForm = e.target.closest('.ajax-wishlist-form');
                const isSubmitBtn = e.target.closest('button[type="submit"]');

                if (!isSubmitBtn) return;

                // Add to Cart
                if (atcForm) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    window.showLoader(); // Show premium loader
                    const formData = new FormData(atcForm);
                    fetch('{{ route("cart.add") }}', {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        })
                        .then(res => res.json())
                        .then(data => {
                            window.hideLoader();
                            if (data.success) {
                                updateCartUI(data);
                                openDrawer();
                                showNotification(data.message);
                            }
                        })
                        .catch(() => {
                            window.hideLoader();
                            showNotification("Pranam! Something went wrong while updating your bag.");
                        });
                }
                // Add to Wishlist
                else if (wishlistForm) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    window.showLoader();
                    const formData = new FormData(wishlistForm);
                    fetch('{{ route("wishlist.add") }}', {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        })
                        .then(res => res.json())
                        .then(data => {
                            window.hideLoader();
                            if (data.success) {
                                // Update wishlist count badges
                                const wishlistBadges = document.querySelectorAll('.wishlist-count');
                                wishlistBadges.forEach(wb => wb.textContent = data.count);
                                showNotification(data.message);
                                
                                // Toggle heart icon if possible
                                const heartIcon = wishlistForm.querySelector('i');
                                if (heartIcon) {
                                    heartIcon.classList.remove('bi-heart');
                                    heartIcon.classList.add('bi-heart-fill');
                                }
                            }
                        })
                        .catch(() => {
                            window.hideLoader();
                            showNotification("Could not update your wishlist. Please try again.");
                        });
                }

                // Remove Item
                if (e.target.closest('.ajax-remove')) {
                    const btn = e.target.closest('.ajax-remove');
                    const id = btn.dataset.id;
                    const formData = new FormData();
                    formData.append('id', id);
                    formData.append('_token', '{{ csrf_token() }}');
                    
                    fetch('{{ route("cart.remove") }}', {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                updateCartUI(data);
                            }
                    });
                }

                // Update Quantity
                if (e.target.closest('.ajax-update')) {
                    const btn = e.target.closest('.ajax-update');
                    const id = btn.dataset.id;
                    const qty = parseInt(btn.dataset.qty);
                    const formData = new FormData();
                    formData.append('id', id);
                    formData.append('quantity', qty);
                    formData.append('_token', '{{ csrf_token() }}');
                    
                    fetch('{{ route("cart.update") }}', {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                updateCartUI(data);
                            }
                    });
                }
            });

            // Mobile Menu Toggle
            const menuToggle = document.querySelector('.mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const closeMobileMenu = document.getElementById('closeMobileMenu');

            if (menuToggle) {
                menuToggle.addEventListener('click', () => {
                    mobileMenu.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });
            }

            if (closeMobileMenu) {
                closeMobileMenu.addEventListener('click', () => {
                    mobileMenu.classList.remove('active');
                    document.body.style.overflow = 'auto';
                });
            }
        });




    </script>






    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Global AJAX Loader Helpers
            window.showLoader = () => document.getElementById('ajaxLoader').classList.add('active');
            window.hideLoader = () => document.getElementById('ajaxLoader').classList.remove('active');

            // Remove Luxury Loader from DOM after animation completes
            setTimeout(() => {
                const loader = document.getElementById('luxury-loader');
                if (loader) {
                    loader.remove();
                }
            }, 5500);


        });
    </script>

    <style>
        /* Typing Indicator Styles */
        .typing-indicator .message-bubble {
            display: flex;
            gap: 4px;
            padding: 15px 20px !important;
            background: #fff !important;
        }
        .dot {
            width: 6px;
            height: 6px;
            background: #333333;
            border-radius: 50%;
            animation: dot-pulse 1.4s infinite ease-in-out;
        }
        .dot:nth-child(2) { animation-delay: 0.2s; }
        .dot:nth-child(3) { animation-delay: 0.4s; }

        @keyframes dot-pulse {
            0%, 80%, 100% { transform: scale(0); opacity: 0.3; }
            40% { transform: scale(1); opacity: 1; }
        }
    </style>
</body>

</html>


