<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\website\WebsiteController;
use App\Http\Controllers\website\AddToCartController;
use App\Http\Controllers\website\CheckoutController;
use App\Http\Controllers\website\ShopController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\Admin\ShippingController;


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

Route::get('/', [WebsiteController::class, 'index'])->name('home');

Route::get('about', function () { return view('website.about'); })->name('website.about');
Route::get('blog', function () { return view('website.blog.blog'); })->name('website.blog');
Route::get('blogs', function () { return view('website.blog.index'); })->name('website.blog.index');

Route::get('shop/{categoryslug?}',[ShopController::class, 'index'])->name('website.shop');
Route::get('contact', function () { return view('website.contact'); })->name('website.contact');
Route::get('categories', [WebsiteController::class, 'getCategories'])->name('website.categories');
Route::get('category/{slug}', [WebsiteController::class, 'getCategoryBySlug'])->name('website.category_slug');
Route::get('/category/{category_slug}/{product_slug}', [websiteController::class, 'getProductBySlug'])->name('get_product_slug');
Route::post('/product/add_to_cart', [AddToCartController::class, 'addToCart'])->name('product.addToCart');
Route::get('/cart-count', [AddToCartController::class, 'cartCount'])->name('cart.count');





// authenticate users & admin

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');
    
    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');
    
    Route::get('logout', 'logout')->middleware('auth')->name('logout');
    
});


//Users Routes List 

Route::middleware(['auth', 'UserAcces:user'])->group(function () {
    Route::get('cart', [AddToCartController::class, 'index'])->name('website.cart');
    Route::delete('cart/destroy/{id}',[AddToCartController::class,'destroy'])->name('cart.destroy');
    Route::post('cart/update',[AddToCartController::class,'update'])->name('cart.update');
    Route::get('checkout',[CheckoutController::class,'index'])->name('checkout.index');
    Route::post('process-checkout',[CheckoutController::class, 'processCheckout'])->name('checkout.processCheckout');
    Route::get('thankyou/{orderId}',[CheckoutController::class, 'thankYou'])->name('checkout.thankyou');
    Route::post('get-order-summery',[CheckoutController::class, 'getOrderSummary'])->name('checkout.getOrderSummary');

    Route::prefix('account')->group(function () {
        Route::get('profile', [AuthController::class,'profile'])->name('website.account.profile');

        Route::get('orders', [AuthController::class,'orders'])->name('website.account.orders');
        Route::get('order-detail/{orderid}', [AuthController::class,'orderDetail'])->name('website.account.orderdetail');
        Route::get('wishlist', [AuthController::class,'wishlist'])->name('website.account.wishlist');
        Route::post('/add-to-wishlist', [WebsiteController::class, 'addToWishlist'])->name('website.addToWishlist');
        Route::post('remove-product-from-wishlist', [AuthController::class,'removeProductFromWishlist'])->name('website.account.removeProductFromWishlist');
        Route::get('/wishlist/count', [AuthController::class, 'wishlistCount'])->name('wishlist.count');

        
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

        // orders routes admin
        Route::get('orders', [OrderController::class,'index'])->name('orders.index');
        Route::get('/order/{orderId}', [OrderController::class, 'detail'])->name('order.detail');
        Route::put('/order/change-status/{orderId}', [OrderController::class, 'updateStatus'])->name('order.updatestatus');
        Route::post('/order/send-email/{orderId}', [OrderController::class, 'sendInvoiceEmail'])->name('order.sendInvoiceEmail');

        // profile routes admin
        Route::get('profile', [AdminController::class, 'profilepage'])->name('admin.profile');

        Route::get('/get-slug', [AdminController::class, 'getSlug'])->name('getSlug');

    });
});