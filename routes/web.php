<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\AdminReviewController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\front\AuthController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\ProfileController;
use App\Http\Controllers\front\ReviewController;
use App\Http\Controllers\front\ShopController;
use App\Http\Controllers\front\WhishlistController;
use App\Http\Controllers\AIRecommendationController;

Route::get('/getSlug', function (Request $request) {
    $slug = $request->title ? Str::slug($request->title) : '';
    return response()->json([
        'status' => 200,
        'slug' => $slug
    ], 200);
})->name('getSlug');


Route::group(['prefix' => 'male-fashion'], function () {

    Route::name('front.')->group(function () {
        Route::get('/', [HomeController::class, 'home'])->name('home');
        // Shop Controller Routes
        Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
        Route::get('/shop/{slug}', [ShopController::class, 'product'])->name('product');
        // Cart Controller Routes
        Route::get('/cart', [CartController::class, 'cart'])->name('cart');
        Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
        Route::post('/update-cart', [CartController::class, 'updateCart'])->name('updateCart');
        Route::post('/delete-cart', [CartController::class, 'deleteItem'])->name('deleteCartItem');
        // Review Controller Routes
        Route::post('/', [ReviewController::class, 'store'])->name('reviewStore');
        Route::get('/edit', [ReviewController::class, 'edit'])->name('reviewEdit');
        Route::put('/update', [ReviewController::class, 'update'])->name('reviewUpdate');
    });

    Route::group(['middleware' => 'guest'], function () {
        Route::name('front.')->group(function () {
            Route::get('register', [AuthController::class, 'userRegister'])->name('userRegister');
            // Route to handle sending OTP
            Route::post('send-otp', [AuthController::class, 'sendOtp'])->name('sendOtp');
            // Route to handle user registration after OTP verification
            Route::post('verify-otp', [AuthController::class, 'verifyOtp'])->name('verifyOtp');
            Route::get('login', [AuthController::class, 'userLogin'])->name('userLogin');
            Route::post('authentication', [AuthController::class, 'userAuthentication'])->name('userAuthentication');
            Route::post('/restore/{id}', [AuthController::class, 'restoreAccount'])->name('restore');
        });
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::name('front.')->group(function () {
            // Profile Controller Routes
            Route::get('profile', [ProfileController::class, 'userProfile'])->name('userProfile');
            Route::put('update-profile/{id}', [ProfileController::class, 'updateProfile'])->name('updateProfile');
            Route::get('orders-list', [ProfileController::class, 'orderList'])->name('orderList');
            Route::get('pending-orders-list', [ProfileController::class, 'orderPendingList'])->name('orderPendingList');
            Route::get('delivered-orders-list', [ProfileController::class, 'orderDeliveredList'])->name('orderDeliveredList');
            Route::get('/order-detail/{id}', [ProfileController::class, 'orderDetail'])->name('orderDetail');
            // Auth Controller Routes
            Route::get('logout', [AuthController::class, 'logout'])->name('logout');
            Route::get('/change-password', [AuthController::class, 'changePassword'])->name('changePassword');
            Route::post('/change-password', [AuthController::class, 'changePasswordProcess'])->name('changePasswordProcess');
            Route::get('/delete-account', [AuthController::class, 'deleteAcc'])->name('deleteAcc');
            Route::delete('/delete-account-process', [AuthController::class, 'deleteAccProcess'])->name('deleteAccProcess');

            // Whishlist Controller Routes
            Route::get('wishlist', [WhishlistController::class, 'viewWishlist'])->name('viewWishlist');
            Route::post('add-to-wishlist', [WhishlistController::class, 'addToWishlist'])->name('addToWishlist');
            Route::post('remove-to-wishlist', [WhishlistController::class, 'reomveWhishlistPro'])->name('reomveWhishlistPro');
            // Checkout Controller Routes
            Route::get('checkout', [CheckoutController::class, 'viewCheckout'])->name('viewCheckout');
            Route::post('checkout', [CheckoutController::class, 'checkoutProcess'])->name('checkoutProcess');
            Route::post('order-summary', [CheckoutController::class, 'getOrderSummery'])->name('getOrderSummery');
        });
    });
});



Route::group(['prefix' => 'admin'], function () {


    Route::group(['middleware' => 'admin.guest'], function () {
        Route::name('admin.')->group(function () {
            Route::get('login', [AdminController::class, 'login'])->name('login');
            Route::post('authentication', [AdminController::class, 'authentication'])->name('authentication');
        });
    });

    Route::group(['middleware' => 'admin.auth'], function () {
        Route::name('admin.')->group(function () {
            Route::get('register', [AdminController::class, 'register'])->name('register');
            Route::post('registerProcess', [AdminController::class, 'processRegister'])->name('processRegister');
            Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::get('logout', [AdminController::class, 'logout'])->name('logout');
            Route::get('change-password', [AdminController::class, 'changePass'])->name('changePass');
            Route::post('change-password-process', [AdminController::class, 'changePassProcess'])->name('changePassProcess');
        });


        Route::prefix('users')->name('user.')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('list');
            Route::get('edit/{user}', [AdminController::class, 'edit'])->name('edit');
            Route::put('/{user}', [AdminController::class, 'update'])->name('update');
        });

        // Category Routes
        Route::resource('category', CategoryController::class);
        Route::get('/active/category', [CategoryController::class, 'active'])->name('category.active');
        Route::get('/block/category', [CategoryController::class, 'block'])->name('category.block');

        // Sub Category Routes
        Route::resource('sub-category', SubCategoryController::class);
        Route::get('/active/sub-category', [SubCategoryController::class, 'active'])->name('sub-category.active');
        Route::get('/block/sub-category', [SubCategoryController::class, 'block'])->name('sub-category.block');

        // Brand Routes
        Route::resource('brands', BrandController::class);
        Route::get('/active/brand', [BrandController::class, 'active'])->name('brands.active');
        Route::get('/block/brand', [BrandController::class, 'block'])->name('brands.block');

        // Product Routes
        Route::resource('product', ProductController::class);
        Route::get('/publish/product', [ProductController::class, 'publish'])->name('product.publish');
        Route::get('/draft/product', [ProductController::class, 'draft'])->name('product.draft');

        // Shipping Routes
        Route::resource('shipping', ShippingController::class);

        // Order Routes
        Route::get('/orders', [OrderController::class, 'index'])->name('order.index');

        // Order Routes
        Route::resource('review', AdminReviewController::class);
    });
});
