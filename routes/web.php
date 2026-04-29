<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\AuthController as UserAuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HeadlineController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Models\Category;
use App\Http\Controllers\Admin\BannerController;
use Illuminate\Support\Str;

// Admin routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Admin Product Routes
    Route::get('/admin/product-list', [AdminProductController::class, 'index'])
        ->name('admin.product-list');
    Route::get('/admin/add-product', [AdminProductController::class, 'create'])
        ->name('admin.add-product');
    Route::post('/admin/add-product', [AdminProductController::class, 'store'])
        ->name('admin.product.store');
    Route::get('/admin/edit-product/{id}', [AdminProductController::class, 'edit'])
        ->name('admin.edit-product');
    Route::post('/admin/update-product/{id}', [AdminProductController::class, 'update'])
        ->name('admin.product.update');
    Route::delete('/admin/delete-product/{id}', [AdminProductController::class, 'destroy'])
        ->name('admin.product.delete');

    // Stock Management Routes
    Route::get('/admin/add-stock', [AdminProductController::class, 'addStock'])->name('admin.add-stock');
    Route::post('/admin/store-stock', [AdminProductController::class, 'storeStock'])->name('admin.stock.store');

    Route::get('/admin/stock-list', [AdminProductController::class, 'stockList'])->name('admin.stock-list');

    // AJAX route for getting products by subcategory
    Route::get('/admin/subcategories/{subcategoryId}/products', [AdminProductController::class, 'getProductsBySubcategory'])
        ->name('admin.get.products');

    // AJAX routes for admin
    Route::get('/admin/categories/{categoryId}/subcategories', [AdminProductController::class, 'getSubcategories'])
        ->name('admin.get.subcategories');
    Route::delete('/admin/product-image/{id}', [AdminProductController::class, 'deleteImage'])
        ->name('admin.product.image.delete');

    // Category Routes
    Route::get('/admin/category-list', [CategoryController::class, 'index'])
        ->name('admin.category-list');
    Route::get('/admin/add-category', [CategoryController::class, 'create'])
        ->name('admin.add-category');
    Route::post('/admin/add-category', [CategoryController::class, 'store'])
        ->name('admin.category.store');
    Route::get('/admin/edit-category/{id}', [CategoryController::class, 'edit'])
        ->name('admin.edit-category');
    // Route::post('/admin/update-category/{id}', [CategoryController::class, 'update'])
    //     ->name('admin.category.update');
    Route::delete('/admin/delete-category/{id}', [CategoryController::class, 'destroy'])
        ->name('admin.category.delete');
    Route::match(['post', 'put'], '/admin/update-category/{id}', [CategoryController::class, 'update'])->name('admin.category.update');

    // Admin Headline Routes
    Route::get('/admin/headline-list', [HeadlineController::class, 'index'])->name('admin.headlines.index'); // Ekhane name thik kora hoyeche
    Route::post('/admin/add-headline', [HeadlineController::class, 'store'])->name('admin.headline.store');
    Route::get('/admin/edit-headline/{id}', [HeadlineController::class, 'edit'])->name('admin.headline.edit');
    Route::put('/admin/update-headline/{id}', [HeadlineController::class, 'update'])->name('admin.headline.update');
    Route::delete('/admin/delete-headline/{id}', [HeadlineController::class, 'destroy'])->name('admin.headline.delete');

    //Admin Order Routes
    Route::get('/admin/order-list', [AdminOrderController::class, 'index'])
        ->name('admin.order-list');

    Route::get('/admin/orders/pending', [AdminOrderController::class, 'pending'])
        ->name('admin.orders.pending');

    Route::get('/admin/orders/processing', [AdminOrderController::class, 'processing'])
        ->name('admin.orders.processing');

    Route::get('/admin/orders/shipped', [AdminOrderController::class, 'shipped'])
        ->name('admin.orders.shipped');

    Route::get('/admin/orders/delivered', [AdminOrderController::class, 'delivered'])
        ->name('admin.orders.delivered');

    Route::get('/admin/orders/cancelled', [AdminOrderController::class, 'cancelled'])
        ->name('admin.orders.cancelled');

    Route::get('/admin/order-detail/{id}', [AdminOrderController::class, 'show'])
        ->name('admin.order-detail');

    Route::get('/admin/order-tracking/{id}', [AdminOrderController::class, 'tracking'])
        ->name('admin.order-tracking');

    Route::post('/admin/order/{id}/update-status', [AdminOrderController::class, 'updateStatus'])
        ->name('admin.order.update-status');

    Route::delete('/admin/orders/{id}/delete', [AdminOrderController::class, 'destroy'])
        ->name('admin.order.delete');

    Route::post('/admin/order/{id}/add-tracking', [AdminOrderController::class, 'addTracking'])
        ->name('admin.order.add-tracking');

    // Admin Review Routes
    Route::get('/admin/review-list', [ReviewController::class, 'index'])
        ->name('admin.review-list');

    Route::get('/admin/add-review', [ReviewController::class, 'create'])
        ->name('admin.add-review');

    Route::post('/admin/add-review', [ReviewController::class, 'store'])
        ->name('admin.review.store');

    Route::get('/admin/edit-review/{review}', [ReviewController::class, 'edit'])
        ->name('admin.edit-review');

    Route::put('/admin/update-review/{review}', [ReviewController::class, 'update'])
        ->name('admin.review.update');

    Route::delete('/admin/delete-review/{review}', [ReviewController::class, 'destroy'])
        ->name('admin.review.delete');

    Route::post('/admin/review/{review}/toggle-status', [ReviewController::class, 'toggleStatus'])
        ->name('admin.review.toggle-status');

    Route::get('/admin/faq-list', [AdminFaqController::class, 'index'])
        ->name('admin.faqs.index');
    Route::get('/admin/add-faq', [AdminFaqController::class, 'create'])
        ->name('admin.faqs.add-faq');
    Route::post('/admin/add-faq', [AdminFaqController::class, 'store'])
        ->name('admin.faqs.store');
    Route::get('/admin/edit-faq/{faq}', [AdminFaqController::class, 'edit'])
        ->name('admin.faqs.edit-faq');
    Route::put('/admin/update-faq/{faq}', [AdminFaqController::class, 'update'])
        ->name('admin.faqs.update');
    Route::delete('/admin/delete-faq/{faq}', [AdminFaqController::class, 'destroy'])
        ->name('admin.faqs.delete');
    Route::post('/admin/faq/{faq}/toggle-status', [AdminFaqController::class, 'toggleStatus'])
        ->name('admin.faqs.toggle-status');


    // Settings Routes
    Route::get('/admin/settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::post('/admin/settings/update', [SettingController::class, 'update'])->name('admin.settings.update');

// Social Media Links er jonno noutun route
Route::get('/admin/social-links', [SettingController::class, 'socialLinks'])->name('admin.social-links.index');
Route::post('/admin/social-links/update', [SettingController::class, 'updateSocialLinks'])->name('admin.social-links.update');

    // Contact Messages Routes
    Route::get('/admin/messages', [ContactMessageController::class, 'index'])->name('admin.messages.index');
    Route::get('/admin/messages/{id}', [ContactMessageController::class, 'show'])->name('admin.messages.show');
    Route::post('/admin/messages/{id}/mark-read', [ContactMessageController::class, 'markAsRead'])->name('admin.messages.mark-read');
    Route::post('/admin/messages/{id}/mark-unread', [ContactMessageController::class, 'markAsUnread'])->name('admin.messages.mark-unread');
    Route::delete('/admin/messages/{id}', [ContactMessageController::class, 'destroy'])->name('admin.messages.destroy');

    // Notification API
    Route::get('/admin/notifications/unread-messages', [ContactMessageController::class, 'getUnreadMessages'])->name('notifications.unread-messages');

    // Admin User Routes
    Route::get('/admin/users', [AdminUserController::class, 'index'])
        ->name('admin.all-user');
    Route::delete('/admin/users/{id}/delete', [AdminUserController::class, 'destroy'])
        ->name('admin.all-user.delete');

    //Currency-Settings    
    Route::get('/admin/currency-settings', [App\Http\Controllers\Admin\CurrencySettingController::class, 'index'])
        ->name('admin.currency-settings.index');
    Route::post('/admin/currency-settings/store', [App\Http\Controllers\Admin\CurrencySettingController::class, 'store'])
        ->name('admin.currency-settings.store');

    //Report
    Route::get('admin/report', [ReportController::class, 'index'])->name('admin.report');
    Route::get('admin/report/stock', [ReportController::class, 'stockReport'])->name('admin.report.stock');
    Route::get('admin/report/sell', [ReportController::class, 'sellReport'])->name('admin.report.sell');
    Route::get('admin/report/restock', [ReportController::class, 'restockReport'])->name('admin.report.restock');

    // Banner Routes (অবশ্যই admin. গ্রুপ মিডলওয়্যারের ভেতরেই থাকবে)
    Route::get('/admin/banner', [BannerController::class, 'index'])->name('admin.banners.index');
    Route::get('/admin/banner/create', [BannerController::class, 'create'])->name('admin.banners.create');
    Route::post('/admin/banner/store', [BannerController::class, 'store'])->name('admin.banners.store');
    Route::delete('/admin/banner/{id}/delete', [BannerController::class, 'destroy'])->name('admin.banners.destroy');

    
});


// User Authentication Routes
Route::get('/login', [UserAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [UserAuthController::class, 'login'])->name('user.login');
Route::get('/register', [UserAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [UserAuthController::class, 'register'])->name('user.register');
Route::post('/logout', [UserAuthController::class, 'logout'])->name('user.logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'show'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'send'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'show'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'update'])
    ->middleware('guest')
    ->name('password.update');


// Cart AJAX Routes (public access for checking authentication)
// Route::post('/cart/add/{productId}', [CartController::class, 'addToCartAjax'])->name('cart.add.ajax');
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');

// Cart Routes with authentication middleware
Route::middleware(['auth.user'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add-item/{productId}', [CartController::class, 'addToCart'])->name('cart.add.item');
    Route::get('/cart/add-item/{productId}', [CartController::class, 'addToCart'])->name('cart.add.item.get');
    Route::post('/cart/add-ajax/{productId}', [CartController::class, 'addToCartAjax'])->name('cart.add.ajax');
    Route::put('/cart/update/{cartId}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove/{cartId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');
    Route::get('/order/success/{orderId}', [OrderController::class, 'orderSuccess'])->name('order.success');
    Route::get('/my-orders', [OrderController::class, 'userOrders'])->name('user.orders');


    Route::get('/wishlist', [App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist');
    Route::post('/wishlist/toggle', [App\Http\Controllers\WishlistController::class, 'toggle'])->name('wishlist.toggle');
    Route::post('/wishlist/remove', [App\Http\Controllers\WishlistController::class, 'remove'])->name('wishlist.remove');
    Route::get('/wishlist/count', [App\Http\Controllers\WishlistController::class, 'getCount'])->name('wishlist.count');
    Route::get('/wishlist/product-ids', [App\Http\Controllers\WishlistController::class, 'getProductIds'])->name('wishlist.product-ids');
});


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

// ADD THIS NEW ROUTE HERE
Route::put('/profile/update', [HomeController::class, 'updateProfile'])->name('profile.update');

// NEW POST route to handle the password update
Route::post('/profile/update-password', [HomeController::class, 'updatePassword'])->name('profile.update-password');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/submit', [ContactController::class, 'store'])->name('contact.submit');


Route::get('/shops', [ProductController::class, 'shop'])->name('shops');
//Route::get('/product/{id}', [ProductController::class, 'showDetails'])->name('product-details');
Route::get('/{cat_slug}/{subcat_slug}/{prod_slug}', [ProductController::class, 'showDetails'])->name('product-details');

Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/new-arrivals', [App\Http\Controllers\HomeController::class, 'newArrivals'])
    ->name('new-arrivals');

Route::get('/currency/switch/{currency}', [App\Http\Controllers\CurrencyController::class, 'switch'])
    ->name('currency.switch');
Route::get('/currency/reset', [App\Http\Controllers\CurrencyController::class, 'reset'])
    ->name('currency.reset');
Route::post('/change-currency', function (\Illuminate\Http\Request $request) {
    $setting = \App\Models\CurrencySetting::getActive();

    $currency = $request->currency;

    // Only allow primary or secondary
    if (
        $currency === $setting->primary_currency ||
        $currency === $setting->secondary_currency
    ) {
        session(['currency' => $currency]);
    }

    return back();
})->name('currency.change');


// Admin User Management Routes
Route::get('/run-cmd', function () {
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
    return 'Storage linked and cache cleared successfully!';
});




// Route::get('/admin/all-user', function () {
//     return view('admin.all-user');
// })->name('admin.all-user');

Route::get('/admin/add-new-user', function () {
    return view('admin.add-new-user');
})->name('admin.add-new-user');

Route::get('/fix-slug', function () {
    $categories = Category::all();
    foreach ($categories as $cat) {
        $cat->update([
            'slug' => Str::slug($cat->name)
        ]);
    }
    return "All slugs updated!";
});