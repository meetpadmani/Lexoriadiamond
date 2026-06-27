<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lexoria Admin - @yield('title')</title>

    <!-- Premium Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;1,600&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root {
            --brand-primary: #0d6efd;
            --brand-primary-hover: #0b5ed7;
            --bg-page: #f4f6f9;
            --bg-card: #ffffff;
            --bg-card-hover: #ffffff;
            --border-color: #dee2e6;
            --border-hover: #adb5bd;
            --text-primary: #212529;
            --text-secondary: #6c757d;
            
            --sidebar-width: 250px;
            --topbar-height: 60px;
            --transition: all 0.2s ease-in-out;
            --radius-sm: 20px;
            --radius-md: 20px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-page);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-page);
        }

        ::-webkit-scrollbar-thumb {
            background: #adb5bd;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #6c757d;
        }

        /* ===== SIDEBAR ===== */
        .admin-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1050;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
            border-right: 1px solid var(--border-color);
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }

        /* Sidebar Brand */
        .sidebar-brand {
            padding: 15px 20px;
            border-bottom: 1px solid var(--border-color);
            flex-shrink: 0;
            text-align: center;
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-brand-link {
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand-icon {
            color: var(--brand-primary);
            font-size: 1.5rem;
        }

        .brand-text h5 {
            color: var(--text-primary);
            margin: 0;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .brand-text small {
            display: none;
        }

        /* Sidebar Navigation */
        .sidebar-nav-wrapper {
            flex: 1;
            overflow-y: auto;
            padding: 15px 0;
        }

        .nav-section-label {
            padding: 10px 20px 5px;
            color: var(--text-secondary);
            font-size: 0.75rem;
            text-transform: uppercase;
            font-weight: 600;
        }

        .sidebar-nav .nav-link {
            padding: 10px 20px;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.9rem;
            transition: var(--transition);
            text-decoration: none;
            margin: 2px 10px;
            border-radius: var(--radius-sm);
        }

        .sidebar-nav .nav-link i {
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
            color: var(--text-secondary);
        }

        .sidebar-nav .nav-link:hover {
            background: #f8f9fa;
            color: var(--brand-primary);
        }

        .sidebar-nav .nav-link:hover i {
            color: var(--brand-primary);
        }

        .sidebar-nav .nav-link.active {
            background: rgba(13, 110, 253, 0.1);
            color: var(--brand-primary);
            font-weight: 600;
        }

        .sidebar-nav .nav-link.active i {
            color: var(--brand-primary);
        }

        /* Sidebar Footer */
        .sidebar-footer {
            padding: 15px;
            border-top: 1px solid var(--border-color);
            text-align: center;
        }

        .sidebar-footer .ver {
            color: var(--text-secondary);
            font-size: 0.8rem;
        }

        /* ===== MAIN CONTENT ===== */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
        }

        .main-wrapper.expanded {
            margin-left: 0;
        }

        .admin-sidebar.collapsed {
            transform: translateX(-100%);
        }

        /* ===== TOP NAVBAR ===== */
        .top-navbar {
            height: var(--topbar-height);
            padding: 0 20px;
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            font-size: 1.25rem;
            color: var(--text-secondary);
            cursor: pointer;
            transition: var(--transition);
        }
        
        .sidebar-toggle:hover {
            color: var(--brand-primary);
        }

        .page-title-box h4 {
            font-size: 1.2rem;
            color: var(--text-primary);
            margin: 0;
            font-weight: 600;
        }

        .page-title-box .breadcrumb-text {
            display: none;
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .topbar-icon-btn {
            background: #f8f9fa;
            border: 1px solid transparent;
            color: var(--text-secondary);
            font-size: 1.1rem;
            cursor: pointer;
            transition: var(--transition);
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: var(--radius-sm);
        }

        .topbar-icon-btn:hover {
            color: var(--brand-primary);
            background: #e9ecef;
        }

        .notif-dot {
            position: absolute;
            top: 6px;
            right: 8px;
            width: 8px;
            height: 8px;
            background: #dc3545;
            border-radius: 50%;
        }

        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            padding-left: 15px;
            border-left: 1px solid var(--border-color);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: var(--brand-primary);
            color: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .user-name {
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-primary);
        }

        /* Dropdowns */
        .dropdown-menu {
            background: #ffffff !important;
            border: 1px solid var(--border-color) !important;
            border-radius: var(--radius-sm) !important;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
            padding: 5px 0 !important;
        }

        .dropdown-item {
            font-size: 0.9rem;
            padding: 8px 20px;
            transition: var(--transition);
            color: var(--text-primary);
        }

        .dropdown-item:hover {
            background: #f8f9fa;
            color: var(--text-primary);
        }

        /* ===== CONTENT BODY ===== */
        .content-body {
            padding: 15px 20px;
            max-width: 100% !important;
            margin: 0 !important;
            flex: 1;
        }

        /* Remove extra container padding globally */
        .container-fluid {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        /* ===== CARDS ===== */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            margin-bottom: 24px;
        }
        
        .card-header {
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            padding: 15px 20px;
            border-radius: calc(var(--radius-md) - 1px) calc(var(--radius-md) - 1px) 0 0;
        }

        .card-header h5 {
            margin: 0;
            color: var(--text-primary);
            font-size: 1.1rem;
            font-weight: 600;
        }

        .card-body {
            padding: 20px;
        }

        /* ===== BUTTONS ===== */
        .btn-premium {
            background: var(--brand-primary);
            color: #ffffff;
            border-radius: var(--radius-sm);
            padding: 8px 16px;
            font-size: 0.9rem;
            font-weight: 500;
            border: 1px solid var(--brand-primary);
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-premium:hover {
            background: var(--brand-primary-hover);
            color: #ffffff;
            border-color: var(--brand-primary-hover);
        }

        .btn-gold-outline {
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            background: #ffffff;
            border-radius: var(--radius-sm);
            padding: 8px 16px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-gold-outline:hover {
            background: #f8f9fa;
            color: var(--text-primary);
            border-color: #adb5bd;
        }

        /* ===== TABLES ===== */
        .table {
            margin: 0;
            color: var(--text-primary);
        }

        .table thead th {
            background: #f8f9fa;
            border-bottom: 2px solid var(--border-color);
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 600;
            padding: 12px 16px;
        }

        .table tbody td {
            padding: 12px 16px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.9rem;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        /* ===== ALERTS ===== */
        .alert {
            border-radius: var(--radius-md);
            border: 1px solid transparent;
            padding: 12px 20px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background-color: #d1e7dd;
            border-color: #badbcc;
            color: #0f5132;
        }

        /* ===== FORM ELEMENTS ===== */
        .form-control,
        .form-select {
            border-radius: var(--radius-sm);
            padding: 8px 12px;
            border: 1px solid #ced4da;
            background: #ffffff;
            font-size: 0.95rem;
            color: var(--text-primary);
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            border-color: #86b7fe;
            outline: none;
        }

        .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 6px;
            color: var(--text-primary);
        }
        
        .form-text {
            color: var(--text-secondary);
            font-size: 0.8rem;
            margin-top: 4px;
        }
        
        .form-check-input {
            border: 1px solid rgba(0,0,0,.25);
        }
        
        .form-check-input:checked {
            background-color: var(--brand-primary);
            border-color: var(--brand-primary);
        }

        /* ===== BADGES ===== */
        .badge {
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 0.75rem;
        }
        
        .badge-success { background: #198754; color: #ffffff; }
        .badge-warning { background: #ffc107; color: #000000; }
        .badge-danger { background: #dc3545; color: #ffffff; }
        .badge-info { background: #0dcaf0; color: #000000; }

        /* ===== MOBILE OVERLAY ===== */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
        }

        .sidebar-overlay.active {
            display: block;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.open {
                transform: translateX(0);
            }

            .main-wrapper {
                margin-left: 0;
            }
        }

        @media (max-width: 768px) {
            .top-navbar {
                padding: 0 10px;
            }
            .content-body {
                padding: 10px;
            }
            .premium-panel {
                padding: 1.5rem !important;
            }
            .premium-page-header {
                padding: 1.5rem !important;
            }
            .premium-page-header .d-flex.justify-content-between {
                flex-direction: column;
                align-items: stretch !important;
                gap: 1rem !important;
            }
            .premium-page-header .d-flex.align-items-center.gap-4 {
                flex-direction: column;
                text-align: center;
                gap: 1rem !important;
            }
            .user-name {
                display: none;
            }
            .page-title-box h4 {
                font-size: 1.1rem;
            }
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .marketing-tabs, .payment-tabs {
                flex-wrap: nowrap;
                overflow-x: auto;
                white-space: nowrap;
                padding-bottom: 5px;
                -webkit-overflow-scrolling: touch;
            }
            .marketing-tabs::-webkit-scrollbar, .payment-tabs::-webkit-scrollbar {
                height: 4px;
            }
            .btn-premium {
                padding: 12px 20px;
                font-size: 0.95rem;
                width: 100%;
                justify-content: center;
            }
        }
    </style>
    @yield('styles')
</head>

<body>
    <!-- Sidebar Overlay (mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <!-- Brand -->
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand-link">
                <div class="brand-icon d-flex align-items-center justify-content-center w-100">
                    <img src="{{ asset('img/lexoria-logo.png') }}" alt="Lexoria Logo" style="max-width: 160px; max-height: 45px; object-fit: contain;">
                </div>
            </a>
        </div>

        <!-- Scrollable Nav -->
                <div class="sidebar-nav-wrapper">
            <div class="nav-section-label">Overview</div>
            <nav class="sidebar-nav">
                <a class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="bi bi-grid-1x2"></i> Dashboard
                </a>
                <a class="nav-link {{ Route::is('admin.users.index') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}">
                    <i class="bi bi-people"></i> Users List
                </a>
                <a class="nav-link {{ Route::is('admin.users.create') ? 'active' : '' }}"
                    href="{{ route('admin.users.create') }}">
                    <i class="bi bi-person-plus"></i> Add New User
                </a>
                <a class="nav-link {{ Route::is('admin.orders.*') ? 'active' : '' }}"
                    href="{{ route('admin.orders.index') }}">
                    <i class="bi bi-cart-check"></i> Orders
                </a>

                <a class="nav-link {{ Route::is('admin.custom_orders.*') ? 'active' : '' }}"
                    href="{{ route('admin.custom_orders.index') }}">
                    <i class="bi bi-gem"></i> Custom Orders
                </a>
                <a class="nav-link {{ Route::is('admin.reviews.*') ? 'active' : '' }}"
                    href="{{ route('admin.reviews.index') }}">
                    <i class="bi bi-star"></i> Product Reviews
                </a>
                <a class="nav-link {{ Route::is('admin.coupons.*') ? 'active' : '' }}"
                    href="{{ route('admin.coupons.index') }}">
                    <i class="bi bi-ticket-perforated"></i> Coupons & Discounts
                </a>
                <a class="nav-link {{ Route::is('admin.reports.*') ? 'active' : '' }}"
                    href="{{ route('admin.reports.index') }}">
                    <i class="bi bi-bar-chart-line"></i> Analytics & Reports
                </a>
                <a class="nav-link {{ Route::is('admin.competitors.*') ? 'active' : '' }}"
                    href="{{ route('admin.competitors.index') }}">
                    <i class="ti-radar bi bi-radar"></i> Competitors
                </a>
            </nav>

            <div class="nav-section-label">Marketing & Engagement</div>
            <nav class="sidebar-nav">
                <a class="nav-link {{ Route::is('admin.engagement.wishlists') ? 'active' : '' }}"
                    href="{{ route('admin.engagement.wishlists') }}">
                    <i class="bi bi-heart"></i> Customer Wishlists
                </a>
                <a class="nav-link {{ Route::is('admin.engagement.whatsapp') ? 'active' : '' }}"
                    href="{{ route('admin.engagement.whatsapp') }}">
                    <i class="bi bi-whatsapp"></i> WhatsApp
                </a>
                <a class="nav-link {{ Route::is('admin.marketing.*') ? 'active' : '' }}" href="{{ route('admin.marketing.index') }}">
                    <i class="bi bi-megaphone"></i> Marketing Ads
                </a>
            </nav>

            <div class="nav-section-label">Content Management</div>
            <nav class="sidebar-nav">
                <a class="nav-link {{ Route::is('admin.hero.index') ? 'active' : '' }}"
                    href="{{ route('admin.hero.index') }}">
                    <i class="bi bi-window-stack"></i> Home Slider
                </a>
                <a class="nav-link {{ Route::is('admin.posters.*') ? 'active' : '' }}"
                    href="{{ route('admin.posters.index') }}">
                    <i class="bi bi-images"></i> Posters / Banners
                </a>
                <a class="nav-link {{ Route::is('admin.collections.*') ? 'active' : '' }}"
                    href="{{ route('admin.collections.index') }}">
                    <i class="bi bi-columns-gap"></i> Collections
                </a>
                <a class="nav-link {{ Route::is('admin.products.*') ? 'active' : '' }}"
                    href="{{ route('admin.products.index') }}">
                    <i class="bi bi-gem"></i> Products
                </a>
                <a class="nav-link {{ Route::is('admin.video-products.*') ? 'active' : '' }}"
                    href="{{ route('admin.video-products.index') }}">
                    <i class="bi bi-play-btn"></i> Watch & Shop
                </a>
                <a class="nav-link {{ Route::is('admin.gallery-images.*') ? 'active' : '' }}"
                    href="{{ route('admin.gallery-images.index') }}">
                    <i class="bi bi-image"></i> Image Gallery
                </a>
                <a class="nav-link {{ Route::is('admin.blog-posts.*') || Route::is('admin.blog-categories.*') ? 'active' : '' }}"
                    href="{{ route('admin.blog-posts.index') }}">
                    <i class="bi bi-journal-text"></i> Blog Posts
                </a>
            </nav>

            <div class="nav-section-label">Branding</div>
            <nav class="sidebar-nav">
                <a class="nav-link {{ Route::is('admin.brand-story.index') ? 'active' : '' }}"
                    href="{{ route('admin.brand-story.index') }}">
                    <i class="bi bi-feather"></i> Brand Story
                </a>
                <a class="nav-link {{ Route::is('admin.brands.*') ? 'active' : '' }}"
                    href="{{ route('admin.brands.index') }}">
                    <i class="bi bi-patch-check"></i> Brand Partners
                </a>
                <a class="nav-link {{ Route::is('admin.typography.index') ? 'active' : '' }}"
                    href="{{ route('admin.typography.index') }}">
                    <i class="bi bi-fonts"></i> Typography
                </a>
            </nav>

            <div class="nav-section-label">System Settings</div>
            <nav class="sidebar-nav">
                <a class="nav-link {{ Route::is('admin.notifications.index') ? 'active' : '' }}"
                    href="{{ route('admin.notifications.index') }}">
                    <i class="bi bi-bell"></i> Notifications
                </a>
                <a class="nav-link {{ Route::is('admin.seo.index') ? 'active' : '' }}"
                    href="{{ route('admin.seo.index') }}">
                    <i class="bi bi-globe"></i> SEO Settings
                </a>
                <a class="nav-link {{ Route::is('admin.settings.index') ? 'active' : '' }}"
                    href="{{ route('admin.settings.index') }}">
                    <i class="bi bi-gear"></i> Global Settings
                </a>
                <a class="nav-link {{ Route::is('admin.payment-settings.*') ? 'active' : '' }}"
                    href="{{ route('admin.payment-settings.index') }}">
                    <i class="bi bi-credit-card"></i> Payment Settings
                </a>

            </nav>

            <div class="nav-section-label">Quick Links</div>
            <nav class="sidebar-nav">
                <a class="nav-link" href="/" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i> View Live Store
                </a>
            </nav>
        </div>
<!-- Footer -->
        <div class="sidebar-footer">
            <div class="sidebar-footer-card">
                <div class="ver"><i class="bi bi-shield-check"
                        style="color: var(--accent-gold); margin-right: 6px;"></i>Lexoria v2.0</div>
                <div class="date">Jewellery Management System</div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-wrapper">
        <header class="top-navbar">
            <div class="topbar-left">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <div class="page-title-box">
                    <h4>@yield('title')</h4>
                    <div class="breadcrumb-text">Admin / @yield('title')</div>
                </div>
            </div>
            <div class="topbar-right">
                <!-- Dark Mode Toggle -->
                <div class="topbar-icon-btn" id="darkModeToggle" title="Toggle Dark Mode">
                    <i class="bi bi-moon-stars"></i>
                </div>

                <!-- Live Store Link -->
                <a href="/" target="_blank" class="topbar-icon-btn" title="View Store">
                    <i class="bi bi-shop"></i>
                </a>
                
                <div class="dropdown">
                    <button class="topbar-icon-btn" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: none;">
                        <i class="bi bi-bell"></i>
                        <span class="notif-dot"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-0" style="border-radius: 15px; width: 320px; overflow: hidden;">
                        <div class="px-3 py-3 bg-white border-bottom d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold" style="font-size: 0.9rem;">Notifications</h6>
                            <a href="{{ route('admin.notifications.index') }}" class="small text-decoration-none text-primary fw-600" style="font-size: 0.75rem;">View All</a>
                        </div>
                        <div class="notification-items" style="max-height: 350px; overflow-y: auto;">
                            @php
                                $recentOrders = \App\Models\Order::latest()->take(5)->get();
                            @endphp
                            @forelse($recentOrders as $order)
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="dropdown-item px-3 py-3 border-bottom d-flex align-items-start gap-3" style="white-space: normal;">
                                    <div class="bg-success-subtle rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                        <i class="bi bi-cart-check text-success" style="font-size: 0.9rem;"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold small" style="font-size: 0.8rem; line-height: 1.2;">New Order #{{ $order->order_number }}</div>
                                        <div class="text-muted mt-1" style="font-size: 0.7rem;">Placed by {{ $order->user->name ?? 'Guest' }}</div>
                                        <div class="text-primary mt-1 fw-500" style="font-size: 0.65rem;">{{ $order->created_at->diffForHumans() }}</div>
                                    </div>
                                </a>
                            @empty
                                <div class="px-3 py-5 text-center">
                                    <i class="bi bi-bell-slash text-muted fs-1 mb-2 opacity-50"></i>
                                    <p class="text-muted small mb-0">No new notifications</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.settings.index') }}" class="topbar-icon-btn text-decoration-none" title="Settings">
                    <i class="bi bi-gear"></i>
                </a>
                <div class="user-dropdown dropdown">
                    <div class="d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                        <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <i class="bi bi-chevron-down" style="font-size: 0.7rem; opacity: 0.5;"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2" style="border-radius: 12px; padding: 10px; min-width: 200px;">
                        <li class="px-3 py-2 border-bottom mb-2">
                            <div class="fw-bold" style="font-size: 0.85rem; color: var(--dark-primary);">{{ Auth::user()->name }}</div>
                            <div class="text-muted" style="font-size: 0.7rem;">{{ Auth::user()->email }}</div>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2 py-2 rounded-3 mb-1" href="{{ route('admin.profile.index') }}">
                                <i class="bi bi-person-badge"></i> Personal Profile
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2 py-2 rounded-3">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <div class="content-body animate-fade-in">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 bg-white mb-4" role="alert"
                    style="border-left: 4px solid var(--accent-gold) !important; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                        <div>
                            <h6 class="mb-0 fw-bold">Success</h6>
                            <span class="text-secondary small">{{ session('success') }}</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 bg-white mb-4" role="alert"
                    style="border-left: 4px solid #dc3545 !important; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill text-danger fs-4 me-3"></i>
                        <div>
                            <h6 class="mb-0 fw-bold">Error</h6>
                            <span class="text-secondary small">
                                @foreach($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </span>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    @yield('modals')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sidebar Toggle
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggle = document.getElementById('sidebarToggle');
            const wrapper = document.querySelector('.main-wrapper');

            if (toggle) {
                toggle.addEventListener('click', () => {
                    const isMobile = window.innerWidth <= 1024;
                    if (isMobile) {
                        sidebar.classList.toggle('open');
                        overlay.classList.toggle('active');
                    } else {
                        sidebar.classList.toggle('collapsed');
                        wrapper.classList.toggle('expanded');
                    }
                });
            }

            if (overlay) {
                overlay.addEventListener('click', () => {
                    sidebar.classList.remove('open');
<!-- Footer -->
        <div class="sidebar-footer">
            <div class="sidebar-footer-card">
                <div class="ver"><i class="bi bi-shield-check"
                        style="color: var(--accent-gold); margin-right: 6px;"></i>Lexoria v2.0</div>
                <div class="date">Jewellery Management System</div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-wrapper">
        <header class="top-navbar">
            <div class="topbar-left">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
                <div class="page-title-box">
                    <h4>@yield('title')</h4>
                    <div class="breadcrumb-text">Admin / @yield('title')</div>
                </div>
            </div>
            <div class="topbar-right">
                <!-- Live Store Link -->
                <a href="/" target="_blank" class="topbar-icon-btn" title="View Store">
                    <i class="bi bi-shop"></i>
                </a>
                
                <div class="dropdown">
                    <button class="topbar-icon-btn" data-bs-toggle="dropdown" aria-expanded="false" style="border: none; background: none;">
                        <i class="bi bi-bell"></i>
                        <span class="notif-dot"></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-3 p-0" style="border-radius: 15px; width: 320px; overflow: hidden;">
                        <div class="px-3 py-3 bg-white border-bottom d-flex justify-content-between align-items-center">
                            <h6 class="mb-0 fw-bold" style="font-size: 0.9rem;">Notifications</h6>
                            <a href="{{ route('admin.notifications.index') }}" class="small text-decoration-none text-primary fw-600" style="font-size: 0.75rem;">View All</a>
                        </div>
                        <div class="notification-items" style="max-height: 350px; overflow-y: auto;">
                            @php
                                $recentOrders = \App\Models\Order::latest()->take(5)->get();
                            @endphp
                            @forelse($recentOrders as $order)
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="dropdown-item px-3 py-3 border-bottom d-flex align-items-start gap-3" style="white-space: normal;">
                                    <div class="bg-success-subtle rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                                        <i class="bi bi-cart-check text-success" style="font-size: 0.9rem;"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold small" style="font-size: 0.8rem; line-height: 1.2;">New Order #{{ $order->order_number }}</div>
                                        <div class="text-muted mt-1" style="font-size: 0.7rem;">Placed by {{ $order->user->name ?? 'Guest' }}</div>
                                        <div class="text-primary mt-1 fw-500" style="font-size: 0.65rem;">{{ $order->created_at->diffForHumans() }}</div>
                                    </div>
                                </a>
                            @empty
                                <div class="px-3 py-5 text-center">
                                    <i class="bi bi-bell-slash text-muted fs-1 mb-2 opacity-50"></i>
                                    <p class="text-muted small mb-0">No new notifications</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.settings.index') }}" class="topbar-icon-btn text-decoration-none" title="Settings">
                    <i class="bi bi-gear"></i>
                </a>
                <div class="user-dropdown dropdown">
                    <div class="d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                        <div class="user-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                        <span class="user-name">{{ Auth::user()->name }}</span>
                        <i class="bi bi-chevron-down" style="font-size: 0.7rem; opacity: 0.5;"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg mt-2" style="border-radius: 12px; padding: 10px; min-width: 200px;">
                        <li class="px-3 py-2 border-bottom mb-2">
                            <div class="fw-bold" style="font-size: 0.85rem; color: var(--dark-primary);">{{ Auth::user()->name }}</div>
                            <div class="text-muted" style="font-size: 0.7rem;">{{ Auth::user()->email }}</div>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center gap-2 py-2 rounded-3 mb-1" href="{{ route('admin.profile.index') }}">
                                <i class="bi bi-person-badge"></i> Personal Profile
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2 py-2 rounded-3">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <div class="content-body animate-fade-in">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 bg-white mb-4" role="alert"
                    style="border-left: 4px solid var(--accent-gold) !important; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill text-success fs-4 me-3"></i>
                        <div>
                            <h6 class="mb-0 fw-bold">Success</h6>
                            <span class="text-secondary small">{{ session('success') }}</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 bg-white mb-4" role="alert"
                    style="border-left: 4px solid #dc3545 !important; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill text-danger fs-4 me-3"></i>
                        <div>
                            <h6 class="mb-0 fw-bold">Error</h6>
                            <span class="text-secondary small">
                                @foreach($errors->all() as $error)
                                    {{ $error }}<br>
                                @endforeach
                            </span>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    @yield('modals')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Sidebar Toggle
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('adminSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggle = document.getElementById('sidebarToggle');
            const wrapper = document.querySelector('.main-wrapper');

            if (toggle) {
                toggle.addEventListener('click', () => {
                    const isMobile = window.innerWidth <= 1024;
                    if (isMobile) {
                        sidebar.classList.toggle('open');
                        overlay.classList.toggle('active');
                    } else {
                        sidebar.classList.toggle('collapsed');
                        wrapper.classList.toggle('expanded');
                    }
                });
            }

            if (overlay) {
                overlay.addEventListener('click', () => {
                    sidebar.classList.remove('open');
                    overlay.classList.remove('active');
                });
            }

            // Dark Mode Toggle
            const darkModeToggle = document.getElementById('darkModeToggle');
            const body = document.body;
            const darkIcon = darkModeToggle ? darkModeToggle.querySelector('i') : null;

            // Check for saved preference
            if (localStorage.getItem('admin-dark-mode') === 'enabled' && darkIcon) {
                body.classList.add('dark-mode');
                darkIcon.classList.replace('bi-moon-stars', 'bi-sun');
            }

            if (darkModeToggle && darkIcon) {
                darkModeToggle.addEventListener('click', () => {
                    body.classList.toggle('dark-mode');
                    
                    if (body.classList.contains('dark-mode')) {
                        localStorage.setItem('admin-dark-mode', 'enabled');
                        darkIcon.classList.replace('bi-moon-stars', 'bi-sun');
                    } else {
                        localStorage.setItem('admin-dark-mode', 'disabled');
                        darkIcon.classList.replace('bi-sun', 'bi-moon-stars');
                    }
                });
            }

            // Auto-dismiss alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert-dismissible');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    bsAlert.close();
                }, 5000);
            });

            // Preserve Sidebar Scroll Position across page loads
            const sidebarWrapper = document.querySelector('.sidebar-nav-wrapper');
            if (sidebarWrapper) {
                // Restore scroll position
                const savedScroll = sessionStorage.getItem('sidebarScrollPosition');
                if (savedScroll) {
                    sidebarWrapper.scrollTop = parseInt(savedScroll, 10);
                }

                // Save scroll position before leaving the page
                window.addEventListener('beforeunload', () => {
                    sessionStorage.setItem('sidebarScrollPosition', sidebarWrapper.scrollTop);
                });
            }
        });
    </script>

    @yield('scripts')
</body>
</html>
