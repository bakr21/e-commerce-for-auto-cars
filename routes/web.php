<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\website\WebsiteController;
use App\Http\Controllers\website\AddToCartController;
use App\Http\Controllers\website\CheckoutController;
use App\Http\Controllers\website\ShopController;
use App\Http\Controllers\website\ChangePasswordController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DiscountCodeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\SideBannerController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\website\ContactController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// routes for not authenticated



// Email verification

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');
// Processing verification link
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/')->with('success', 'Email verified successfully .');
})->middleware(['auth', 'signed'])->name('verification.verify');
// Resend verification link
Route::post('/email/resend', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link has been sent again. Check your email!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.resend');

// authenticate users & admin



//Users Routes List

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function() {

    Route::get('/', [WebsiteController::class, 'index'])->name('home');
    Route::get('about', function () { return view('website.about'); })->name('website.about');
    Route::get('blog', function () { return view('website.blog.blog'); })->name('website.blog');
    Route::get('blogs', function () { return view('website.blog.index'); })->name('website.blog.index');
    Route::get('catalogs', [WebsiteController::class, 'catalogPage'])->name('website.catalogs');
    Route::get('catalog/download/{id}', [WebsiteController::class, 'downloadCatalog'])->name('website.catalog.download');
    Route::get('page/{slug}', [PageController::class, 'show'])->name('website.page');
    Route::post('messages', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('messages.store');
    Route::get('shop/{categoryslug?}',[ShopController::class, 'index'])->name('website.shop');
    Route::get('categories', [WebsiteController::class, 'getCategories'])->name('website.categories');
    Route::get('category/{slug}', [WebsiteController::class, 'getCategoryBySlug'])->name('website.category_slug');
    Route::get('category/{category_slug}/{product_slug}', [websiteController::class, 'getProductBySlug'])->name('get_product_slug');
    Route::post('product/add_to_cart', [AddToCartController::class, 'addToCart'])->name('product.addToCart');
    Route::get('cart-count', [AddToCartController::class, 'cartCount'])->name('cart.count');
    Route::post('save-rating/{productId}', [ShopController::class, 'saveRating'])->name('rating.save');

    Route::controller(AuthController::class)->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::post('register', 'registerSave')
                    ->middleware('throttle:5,1')
                    ->name('register.save');

        Route::get('login', 'login')->name('login');
        Route::post('login', 'loginAction')
                    ->middleware('throttle:5,1')
                    ->name('login.action');

        Route::get('logout', 'logout')->middleware('auth')->name('logout');

        // Password Reset Routes
        Route::get('forgot-password', 'forgotPassword')->name('password.request');
        Route::post('forgot-password', 'processForgetPassword')
        ->middleware('throttle:3,1')
        ->name('password.email');

        Route::get('reset-password/{token}', 'resetPassword')->name('password.reset');
        Route::post('reset-password', 'processResetPassword')->name('password.update');
    });

    Route::middleware(['auth', 'UserAcces:user'])->group(function () {
        Route::get('cart', [AddToCartController::class, 'index'])->name('website.cart');
        Route::delete('cart/destroy/{id}', [AddToCartController::class, 'destroy'])->name('cart.destroy');
        Route::put('cart/update', [AddToCartController::class, 'update'])->name('cart.update');

        // Paths requiring email verification
        Route::middleware('verified')->group(function () {
            Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
            Route::post('process-checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.processCheckout');

            Route::get('/paypal/success', [CheckoutController::class, 'paypalSuccess'])->name('paypal.success');
            Route::get('/paypal/cancel', [CheckoutController::class, 'paypalCancel'])->name('paypal.cancel');

            Route::get('stripe/success', [CheckoutController::class, 'stripeSucces'])->name('stripe.success');
            Route::get('stripe/cancel', [CheckoutController::class, 'stripeCancel'])->name('stripe.cancel');

            Route::get('thankyou/{orderId}', [CheckoutController::class, 'thankYou'])->name('checkout.thankyou');
            Route::post('get-order-summery', [CheckoutController::class, 'getOrderSummary'])->name('checkout.getOrderSummary');
            Route::post('apply-discount', [CheckoutController::class, 'applyDiscount'])->name('checkout.applyDiscount');
            Route::post('remove-discount', [CheckoutController::class, 'removeDiscount'])->name('checkout.removeDiscount');

            Route::prefix('account')->group(function () {
                Route::get('profile', [AuthController::class,'profile'])->name('website.account.profile');
                Route::post('update-profile', [AuthController::class,'updateprofile'])->name('website.account.updateprofile');
                Route::post('update-address', [AuthController::class,'updateAddress'])->name('website.account.updateAddress');

                Route::get('orders', [AuthController::class,'orders'])->name('website.account.orders');
                Route::get('order-detail/{orderid}', [AuthController::class,'orderDetail'])->name('website.account.orderdetail');
                Route::get('wishlist', [AuthController::class,'wishlist'])->name('website.account.wishlist');
                Route::post('/add-to-wishlist', [WebsiteController::class, 'addToWishlist'])->name('website.addToWishlist');
                Route::post('remove-product-from-wishlist', [AuthController::class,'removeProductFromWishlist'])->name('website.account.removeProductFromWishlist');
                Route::get('/wishlist/count', [AuthController::class, 'wishlistCount'])->name('wishlist.count');

                Route::get('change-password', [ChangePasswordController::class, 'index'])->name('website.account.change-password');
                Route::post('process-change-password', [ChangePasswordController::class, 'changePassword'])->name('website.account.processChange-password');
            });
        });
    });

});


//Admin Routes List

Route::middleware(['auth', 'UserAcces:admin'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::resource('products', ProductController::class);
        Route::delete('/product/{product}/image/{image}', [ProductController::class, 'deleteImage'])->name('product.image.delete');
        Route::resource('categories', CategoryController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('shipping', ShippingController::class);
        Route::resource('pages', PageController::class);
        Route::resource('message', ContactController::class);
        Route::resource('coupons', DiscountCodeController::class);
        Route::get('reviews', [ReviewController::class, 'index'])->name('reviews.index');
        Route::post('reviews/{id}/update-status', [ReviewController::class, 'updateStatus'])->name('reviews.updateStatus');
        Route::get('general-settings',[SettingController::class, 'edit'])->name('settings.edit');
        Route::put('general-settings', [SettingController::class, 'update'])->name('settings.update');

        // orders routes admin
        Route::get('orders', [OrderController::class,'index'])->name('orders.index');
        Route::get('/order/{orderId}', [OrderController::class, 'detail'])->name('order.detail');
        Route::put('/order/change-status/{orderId}', [OrderController::class, 'updateStatus'])->name('order.updatestatus');
        Route::post('/order/send-email/{orderId}', [OrderController::class, 'sendInvoiceEmail'])->name('order.sendInvoiceEmail');

        // user routes admin
        Route::resource('users', UserController::class);

        // admin profile
        Route::get('profile', [ProfileController::class, 'index'])->name('admin.profile');
        Route::post('process-change-profile', [ProfileController::class, 'processChangesProfile'])->name('admin.processChange-profile');

        Route::get('/get-slug', [AdminController::class, 'getSlug'])->name('getSlug');

        // Website Content Management
        Route::resource('carousels', CarouselController::class);
        Route::resource('side-banners', SideBannerController::class);
        Route::resource('catalogs', CatalogController::class);
        Route::get('catalog-page', [WebsiteController::class, 'catalogPage'])->name('website.catalog');
    });
});
