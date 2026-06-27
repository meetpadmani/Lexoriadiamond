<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Admin\BrandStoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CollectionController as FrontendCollectionController;

use App\Http\Controllers\Admin\TypographyController;
use App\Http\Controllers\Frontend\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/run-migration', function() {
    try {
        \Illuminate\Support\Facades\DB::statement("
            CREATE TABLE IF NOT EXISTS `custom_orders` (
                `id` bigint unsigned not null auto_increment primary key,
                `name` varchar(255) not null,
                `email` varchar(255) not null,
                `phone` varchar(255) not null,
                `description` text not null,
                `image_path` varchar(255) not null,
                `status` varchar(255) not null default 'pending',
                `created_at` timestamp null,
                `updated_at` timestamp null
            ) default character set utf8mb4 collate 'utf8mb4_unicode_ci'
        ");
        return 'Table created successfully!';
    } catch (\Exception $e) {
        return $e->getMessage() . "\n" . $e->getTraceAsString();
    }
});
Route::get('/sitemap.xml', [App\Http\Controllers\Frontend\SitemapController::class, 'index'])->name('sitemap');
Route::get('/collections', [FrontendCollectionController::class, 'index'])->name('collections');
Route::get('/products', [App\Http\Controllers\Frontend\ProductController::class, 'index'])->name('products');
Route::get('/collections/{slug}', [FrontendCollectionController::class, 'show'])->name('collections.show');
Route::get('/collections/{collectionSlug}/{productSlug}', [FrontendCollectionController::class, 'productDetail'])->name('collections.product');
Route::get('/watch-and-shop/{slug}', [HomeController::class, 'videoProductDetail'])->name('watch-and-shop.detail');
Route::get('/set-locale/{locale}', [App\Http\Controllers\Frontend\LocalizationController::class, 'setLocale'])->name('set.locale');


// Informational Pages
Route::get('/diamond-shapes', [HomeController::class, 'diamondShapes'])->name('diamond-shapes');
Route::get('/diamond-education', [HomeController::class, 'diamondEducation'])->name('diamond-education');
Route::get('/investment-masterpieces', [HomeController::class, 'investment'])->name('investment-masterpieces');

// Footer Pages — Customer Care
Route::get('/help-faqs', [HomeController::class, 'helpFaqs'])->name('help-faqs');
Route::get('/track-order', [HomeController::class, 'trackOrder'])->name('track-order');
Route::get('/order-tracking/{order_number}', [HomeController::class, 'viewOrder'])->name('order.tracking');
Route::get('/return-policy', [HomeController::class, 'returnPolicy'])->name('return-policy');
Route::get('/jewellery-care', [HomeController::class, 'jewellleryCare'])->name('jewellery-care');
Route::get('/store-locator', [HomeController::class, 'storeLocator'])->name('store-locator');

// Footer Pages — About Bhaumik
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/our-story', [HomeController::class, 'ourStory'])->name('our-story');
Route::get('/heritage', [HomeController::class, 'heritage'])->name('heritage');
Route::get('/craftsmanship', [HomeController::class, 'craftsmanship'])->name('craftsmanship');
Route::get('/ethical-diamonds', [HomeController::class, 'ethicalDiamonds'])->name('ethical-diamonds');
Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contact-us');

// Footer Pages — Policies
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-conditions', [HomeController::class, 'termsConditions'])->name('terms-conditions');
Route::get('/shipping-policy', [HomeController::class, 'shippingPolicy'])->name('shipping-policy');
Route::get('/exchange-buyback', [HomeController::class, 'exchangeBuyback'])->name('exchange-buyback');
Route::get('/cookie-policy', [HomeController::class, 'cookiePolicy'])->name('cookie-policy');

// Customized Page
Route::get('/customized', [HomeController::class, 'customized'])->name('customized');
Route::post('/customized/submit', [\App\Http\Controllers\Frontend\CustomOrderController::class, 'submit'])->name('customized.submit');

// Ajax Search & Chatbot Route
Route::get('/search-ajax', [App\Http\Controllers\Frontend\SearchController::class, 'ajaxSearch'])->name('search.ajax');
Route::post('/chatbot/get-response', [App\Http\Controllers\ChatbotController::class, 'getResponse'])->name('chatbot.get-response');

// Email Verification Routes
Route::get('/email/verify', function () {
    return view('frontend.auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (\Illuminate\Foundation\Auth\EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('checkout.index')->with('success', 'Your royal email has been verified. Welcome to Bhaumik Diamond.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Illuminate\Http\Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('success', 'A new verification scroll has been sent to your inbox.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Cart & Wishlist Routes
Route::post('/cart/add', [App\Http\Controllers\Frontend\CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [App\Http\Controllers\Frontend\CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [App\Http\Controllers\Frontend\CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart', [App\Http\Controllers\Frontend\CartController::class, 'index'])->name('cart.index');
// Guest or Authenticated Checkout
Route::get('/checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout/place-order', [App\Http\Controllers\Frontend\CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
Route::post('/checkout/apply-coupon', [App\Http\Controllers\Frontend\CheckoutController::class, 'applyCoupon'])->name('checkout.applyCoupon');

Route::middleware(['auth'])->group(function () {
    Route::post('/product/{product}/review', [App\Http\Controllers\ProductReviewController::class, 'store'])->name('product.review.store');
});

Route::middleware(['auth'])->group(function () {
    // Order History
    Route::get('/my-orders', [App\Http\Controllers\Frontend\OrderController::class, 'index'])->name('orders.index');
    Route::get('/my-orders/{orderNumber}', [App\Http\Controllers\Frontend\OrderController::class, 'show'])->name('orders.show');

    // User Profile Dashboard
    Route::get('/my-account', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/my-account/update-profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/my-account/update-password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/my-account/download/{product}', [ProfileController::class, 'downloadDigitalProduct'])->name('profile.download');
});

Route::get('/order/success/{id}', [App\Http\Controllers\Frontend\CheckoutController::class, 'success'])->name('order.success');
Route::get('/order/invoice/{id}', [App\Http\Controllers\Frontend\CheckoutController::class, 'invoice'])->name('order.invoice');

Route::post('/payment/razorpay/callback', [App\Http\Controllers\Frontend\CheckoutController::class, 'paymentCallback'])->name('razorpay.callback');
Route::post('/wishlist/add', [App\Http\Controllers\Frontend\WishlistController::class, 'add'])->name('wishlist.add');
Route::post('/wishlist/remove', [App\Http\Controllers\Frontend\WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/wishlist', [App\Http\Controllers\Frontend\WishlistController::class, 'index'])->name('wishlist.index');

// Auth Routes with Rate Limiting
Route::middleware('throttle:10,1')->group(function () {
    Route::get('/login', [App\Http\Controllers\Frontend\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [App\Http\Controllers\Frontend\AuthController::class, 'login']);
    Route::post('/login-with-otp', [App\Http\Controllers\Frontend\AuthController::class, 'sendLoginOtp'])->name('login.otp');
    Route::get('/register', [App\Http\Controllers\Frontend\AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [App\Http\Controllers\Frontend\AuthController::class, 'register']);
    
    // OTP Verification
    Route::get('/verify-otp', [App\Http\Controllers\Frontend\AuthController::class, 'showOtpVerify'])->name('otp.verify');
    Route::post('/verify-otp', [App\Http\Controllers\Frontend\AuthController::class, 'verifyOtp'])->name('otp.verify.submit');
});

Route::post('/logout', [App\Http\Controllers\Frontend\AuthController::class, 'logout'])->name('logout');
Route::get('/forgot-password', [App\Http\Controllers\Frontend\AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [App\Http\Controllers\Frontend\AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [App\Http\Controllers\Frontend\AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [App\Http\Controllers\Frontend\AuthController::class, 'resetPassword'])->name('password.update');

use App\Http\Controllers\Admin\AdminAuthController;

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Hero management
    Route::get('/hero', [HeroController::class, 'index'])->name('hero.index');
    Route::post('/hero/update', [HeroController::class, 'update'])->name('hero.update');

    // Collections management
    Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
    Route::get('/collections/create', [CollectionController::class, 'create'])->name('collections.create');
    Route::post('/collections/store', [CollectionController::class, 'store'])->name('collections.store');
    Route::get('/collections/{collection}/edit', [CollectionController::class, 'edit'])->name('collections.edit');
    Route::post('/collections/{collection}/update', [CollectionController::class, 'update'])->name('collections.update');
    Route::post('/collections/{collection}/delete', [CollectionController::class, 'destroy'])->name('collections.destroy');

    // Products management
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::post('/products/{product}/update', [ProductController::class, 'update'])->name('products.update');
    Route::post('/products/{product}/delete', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::post('/products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggleStatus');

    // Brand Story management
    Route::get('/brand-story', [BrandStoryController::class, 'index'])->name('brand-story.index');
    Route::post('/brand-story/update', [BrandStoryController::class, 'update'])->name('brand-story.update');

    // Typography management
    Route::get('/typography', [TypographyController::class, 'index'])->name('typography.index');
    Route::post('/typography/update', [TypographyController::class, 'update'])->name('typography.update');

    // Video Product management
    Route::get('/video-products', [\App\Http\Controllers\Admin\VideoProductController::class, 'index'])->name('video-products.index');
    Route::get('/video-products/create', [\App\Http\Controllers\Admin\VideoProductController::class, 'create'])->name('video-products.create');
    Route::post('/video-products/store', [\App\Http\Controllers\Admin\VideoProductController::class, 'store'])->name('video-products.store');
    Route::get('/video-products/{videoProduct}/edit', [\App\Http\Controllers\Admin\VideoProductController::class, 'edit'])->name('video-products.edit');
    Route::post('/video-products/{videoProduct}/update', [\App\Http\Controllers\Admin\VideoProductController::class, 'update'])->name('video-products.update');
    Route::post('/video-products/{videoProduct}/delete', [\App\Http\Controllers\Admin\VideoProductController::class, 'destroy'])->name('video-products.destroy');
    Route::get('/video-products/toggle/{videoProduct}', [\App\Http\Controllers\Admin\VideoProductController::class, 'toggleStatus'])->name('video-products.toggleStatus');

    // Chunk Upload
    Route::post('/upload-video-chunk', [App\Http\Controllers\Admin\ChunkUploadController::class, 'upload'])->name('upload.video.chunk');

    Route::get('/posters', [App\Http\Controllers\Admin\PosterController::class, 'index'])->name('posters.index');
    Route::post('/posters/reorder', [App\Http\Controllers\Admin\PosterController::class, 'reorder'])->name('posters.reorder');
    Route::get('/posters/create', [App\Http\Controllers\Admin\PosterController::class, 'create'])->name('posters.create');
    Route::post('/posters/store', [App\Http\Controllers\Admin\PosterController::class, 'store'])->name('posters.store');
    Route::get('/posters/{poster}/edit', [App\Http\Controllers\Admin\PosterController::class, 'edit'])->name('posters.edit');
    Route::post('/posters/{poster}/update', [App\Http\Controllers\Admin\PosterController::class, 'update'])->name('posters.update');
    Route::post('/posters/{poster}/delete', [App\Http\Controllers\Admin\PosterController::class, 'destroy'])->name('posters.destroy');

    // Admin Order Management
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/status', [App\Http\Controllers\Admin\OrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::post('/orders/{order}/tracking', [App\Http\Controllers\Admin\OrderController::class, 'updateTracking'])->name('orders.updateTracking');
    Route::get('/orders/{order}/sticker', [App\Http\Controllers\Admin\OrderController::class, 'printSticker'])->name('orders.sticker');
    Route::post('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('orders.destroy');

    // Admin Custom Orders
    Route::get('/custom-orders', [App\Http\Controllers\Admin\CustomOrderController::class, 'index'])->name('custom_orders.index');
    Route::get('/custom-orders/{id}', [App\Http\Controllers\Admin\CustomOrderController::class, 'show'])->name('custom_orders.show');
    Route::post('/custom-orders/{id}/status', [App\Http\Controllers\Admin\CustomOrderController::class, 'updateStatus'])->name('custom_orders.updateStatus');
    Route::delete('/custom-orders/{id}', [App\Http\Controllers\Admin\CustomOrderController::class, 'destroy'])->name('custom_orders.destroy');

    // User Management
    Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::post('users/{user}/reset-password', [App\Http\Controllers\Admin\UserController::class, 'sendResetLink'])->name('users.resetPassword');
    Route::get('users/{user}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
    Route::post('users/{user}/toggle-status', [App\Http\Controllers\Admin\UserController::class, 'toggleStatus'])->name('users.toggleStatus');
    Route::post('users/{user}/update-role', [App\Http\Controllers\Admin\UserController::class, 'updateRole'])->name('users.updateRole');
    Route::delete('users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

    // Blog Management
    Route::resource('blog-categories', App\Http\Controllers\Admin\BlogCategoryController::class);
    Route::resource('blog-posts', App\Http\Controllers\Admin\BlogPostController::class);
    Route::resource('blog-tags', App\Http\Controllers\Admin\BlogTagController::class);

    // Coupon & Discount System
    Route::get('/coupons', [App\Http\Controllers\Admin\CouponController::class, 'index'])->name('coupons.index');
    Route::get('/coupons/create', [App\Http\Controllers\Admin\CouponController::class, 'create'])->name('coupons.create');
    Route::post('/coupons', [App\Http\Controllers\Admin\CouponController::class, 'store'])->name('coupons.store');
    Route::get('/coupons/{coupon}/edit', [App\Http\Controllers\Admin\CouponController::class, 'edit'])->name('coupons.edit');
    Route::put('/coupons/{coupon}', [App\Http\Controllers\Admin\CouponController::class, 'update'])->name('coupons.update');
    Route::delete('/coupons/{coupon}', [App\Http\Controllers\Admin\CouponController::class, 'destroy'])->name('coupons.destroy');
    Route::post('/coupons/{coupon}/toggle-status', [App\Http\Controllers\Admin\CouponController::class, 'toggleStatus'])->name('coupons.toggleStatus');

    // Customer Reviews
    Route::get('/reviews', [App\Http\Controllers\Admin\ReviewController::class, 'index'])->name('reviews.index');
    Route::post('/reviews', [App\Http\Controllers\Admin\ReviewController::class, 'store'])->name('reviews.store');
    Route::post('/reviews/{review}/update-status', [App\Http\Controllers\Admin\ReviewController::class, 'updateStatus'])->name('reviews.updateStatus');
    Route::delete('/reviews/{review}', [App\Http\Controllers\Admin\ReviewController::class, 'destroy'])->name('reviews.destroy');

    // System Settings Studio
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    // Payment Settings
    Route::get('/payment-settings', [App\Http\Controllers\Admin\PaymentSettingController::class, 'index'])->name('payment-settings.index');
    Route::post('/payment-settings/update', [App\Http\Controllers\Admin\PaymentSettingController::class, 'update'])->name('payment-settings.update');

    // Marketing Settings
    Route::get('/marketing', [App\Http\Controllers\Admin\MarketingSettingController::class, 'index'])->name('marketing.index');
    Route::post('/marketing/update', [App\Http\Controllers\Admin\MarketingSettingController::class, 'update'])->name('marketing.update');


    // Gallery Images
    Route::get('/gallery-images', [App\Http\Controllers\GalleryImageController::class, 'index'])->name('gallery-images.index');
    Route::post('/gallery-images/store', [App\Http\Controllers\GalleryImageController::class, 'store'])->name('gallery-images.store');
    Route::post('/gallery-images/{galleryImage}/delete', [App\Http\Controllers\GalleryImageController::class, 'destroy'])->name('gallery-images.destroy');

    // Brand Management
    Route::get('/brands', [App\Http\Controllers\Admin\BrandController::class, 'index'])->name('brands.index');
    Route::get('/brands/create', [App\Http\Controllers\Admin\BrandController::class, 'create'])->name('brands.create');
    Route::post('/brands/store', [App\Http\Controllers\Admin\BrandController::class, 'store'])->name('brands.store');
    Route::get('/brands/{brand}/edit', [App\Http\Controllers\Admin\BrandController::class, 'edit'])->name('brands.edit');
    Route::post('/brands/{brand}/update', [App\Http\Controllers\Admin\BrandController::class, 'update'])->name('brands.update');
    Route::post('/brands/{brand}/delete', [App\Http\Controllers\Admin\BrandController::class, 'destroy'])->name('brands.destroy');
    Route::get('/brands/toggle/{brand}', [App\Http\Controllers\Admin\BrandController::class, 'toggleStatus'])->name('brands.toggleStatus');

    // SEO Management Command Center
    Route::get('/seo', [App\Http\Controllers\Admin\SEOController::class, 'index'])->name('seo.index');

    // Notifications Management
    Route::get('/notifications', [App\Http\Controllers\Admin\NotificationController::class, 'index'])->name('notifications.index');

    // Personal Profile
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/update', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/password', [App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('profile.password');

    // Analytics & Reports Module
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\ReportController::class, 'index'])->name('index');
        Route::get('/sales', [App\Http\Controllers\Admin\ReportController::class, 'sales'])->name('sales');
        Route::get('/products', [App\Http\Controllers\Admin\ReportController::class, 'products'])->name('products');
        Route::get('/customers', [App\Http\Controllers\Admin\ReportController::class, 'customers'])->name('customers');
        Route::get('/tax', [App\Http\Controllers\Admin\ReportController::class, 'tax'])->name('tax');
        Route::get('/profit-loss', [App\Http\Controllers\Admin\ReportController::class, 'profitLoss'])->name('profit_loss');
        Route::get('/export', [App\Http\Controllers\Admin\ReportController::class, 'export'])->name('export');
    });

    // Engagement & Retention (Abandoned Cart & Wishlist)
    Route::prefix('engagement')->name('engagement.')->group(function () {
        Route::get('/abandoned-carts', [App\Http\Controllers\Admin\EngagementController::class, 'abandonedCarts'])->name('abandoned-carts');
        Route::post('/abandoned-carts/bulk-remind', [App\Http\Controllers\Admin\EngagementController::class, 'sendBulkAbandonedReminder'])->name('abandoned-carts.bulk-remind');
        Route::post('/abandoned-carts/{user}/remind', [App\Http\Controllers\Admin\EngagementController::class, 'sendAbandonedReminder'])->name('abandoned-carts.remind');
        Route::get('/wishlists', [App\Http\Controllers\Admin\EngagementController::class, 'wishlists'])->name('wishlists');
        Route::post('/wishlists/{user}/remind', [App\Http\Controllers\Admin\EngagementController::class, 'sendWishlistReminder'])->name('wishlists.remind');
        Route::get('/whatsapp', [App\Http\Controllers\Admin\EngagementController::class, 'whatsapp'])->name('whatsapp');
        Route::get('/whatsapp/qr', [App\Http\Controllers\Admin\EngagementController::class, 'whatsappQr'])->name('whatsapp.qr');
        Route::get('/whatsapp/status', [App\Http\Controllers\Admin\EngagementController::class, 'whatsappStatus'])->name('whatsapp.status');
        Route::post('/whatsapp/broadcast', [App\Http\Controllers\Admin\EngagementController::class, 'sendBroadcast'])->name('whatsapp.broadcast');
    });

    // Competitor Intelligence Module
    Route::prefix('competitors')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\CompetitorController::class, 'index'])->name('competitors.index');
        Route::post('/search', [\App\Http\Controllers\Admin\CompetitorController::class, 'search'])->name('competitors.search');
        Route::post('/store', [\App\Http\Controllers\Admin\CompetitorController::class, 'store'])->name('competitors.store');
        Route::delete('/{id}', [\App\Http\Controllers\Admin\CompetitorController::class, 'destroy'])->name('competitors.destroy');
        Route::get('/dashboard', [\App\Http\Controllers\Admin\CompetitorStatsController::class, 'dashboard'])->name('competitors.dashboard');
        Route::post('/scrape', [\App\Http\Controllers\Admin\CompetitorScrapeController::class, 'scrapeAll'])->name('competitors.scrape');
        Route::get('/alerts', [\App\Http\Controllers\Admin\CompetitorAlertController::class, 'index'])->name('competitors.alerts');
        Route::post('/alerts/{id}/read', [\App\Http\Controllers\Admin\CompetitorAlertController::class, 'markRead'])->name('competitors.alerts.read');
    });
});
