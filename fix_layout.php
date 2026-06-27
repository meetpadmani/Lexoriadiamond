<?php
$file = 'resources/views/admin/layout.blade.php';
$content = file_get_contents($file);

// Find start of sidebar-nav-wrapper
$start = strpos($content, '<div class="sidebar-nav-wrapper">');
$end = strpos($content, '<!-- Footer -->', $start);

if ($start !== false && $end !== false) {
    $newNav = <<<'HTML'
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
            </nav>

            <div class="nav-section-label">Marketing & Engagement</div>
            <nav class="sidebar-nav">
                <a class="nav-link {{ Route::is('admin.engagement.wishlists') ? 'active' : '' }}"
                    href="{{ route('admin.engagement.wishlists') }}">
                    <i class="bi bi-heart"></i> Customer Wishlists
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
                <a class="nav-link {{ Route::is('admin.chatbot-knowledge.*') ? 'active' : '' }}"
                    href="{{ route('admin.chatbot-knowledge.index') }}">
                    <i class="bi bi-robot"></i> AI Chatbot Training
                </a>
            </nav>

            <div class="nav-section-label">Quick Links</div>
            <nav class="sidebar-nav">
                <a class="nav-link" href="/" target="_blank">
                    <i class="bi bi-box-arrow-up-right"></i> View Live Store
                </a>
            </nav>
        </div>

HTML;

    $content = substr_replace($content, $newNav, $start, $end - $start);
    file_put_contents($file, $content);
    echo "Sidebar fixed.\n";
} else {
    echo "Could not find tags.\n";
}
