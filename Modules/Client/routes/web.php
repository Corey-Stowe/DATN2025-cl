<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\App\Http\Controllers\AuthController;
use Modules\Client\App\Http\Controllers\CartController;
use Modules\Client\App\Http\Controllers\PostController;
use Modules\Client\App\Http\Controllers\ShopController;
use Modules\Client\App\Http\Controllers\LoginController;
use Modules\Admin\App\Http\Controllers\InvoiceController;
use Modules\Client\App\Http\Controllers\ClientController;
use Modules\Client\App\Http\Controllers\RegisterController;
use Modules\Client\App\Http\Controllers\MyAccountController;
use Artesaos\SEOTools\Contracts\SEOTools;
use Modules\Client\App\Http\Controllers\TicketController;
use Modules\Client\App\Http\Controllers\VerificationController;
use Modules\Client\App\Http\Controllers\ResetPasswordController;
use Modules\Client\App\Http\Controllers\ForgotPasswordController;
use Modules\Client\App\Http\Controllers\ReviewController;
use Modules\Client\App\Http\Controllers\WishlistController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(ClientController::class)
->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('search', 'search')->name('search');
    Route::get('shortingseach', 'shortingseach')->name('shortingseach');
    Route::get('searchprice', 'searchprice')->name('searchprice');
    route::get('seach/category/{id}/{keywd}', 'seachcategory')->name('seachcategory');

    route::get(('search/{keywd}'), 'searchget')->name('searchget');
    // Route::get('querybuilder')
});
Route::controller(ShopController::class)->prefix('shop')->as('shop.')
->group(function () {
    Route::get('/', 'index')->name('shopIndex');
    Route::get('product-detail/{slug}', 'show')->name('productDetail');
    Route::post('rend-variant', 'rendAjax')->name('rend_variant');
    Route::post('rend-product-variant', 'rendPrdV')->name('rendPrdV');
});
Route::controller(CartController::class)->prefix('cart')->as('cart.')->group(function () {
    Route::get('checkout', 'checkout')->name('checkout');
});
Route::prefix('other')->as('other.')->group(function () {
    Route::get('contact', function () {
        return view('client::contents.other-pages.contact-us');
    })
    ->middleware('auth.checkLog')
    ->name('contactUs');
    Route::get('aboutUs', function () {
        return view('client::contents.other-pages.about-us');
    })->name('aboutUs');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/postDetail/{slug}', [PostController::class, 'show'])->name('postDetail');
    Route::post('search', [PostController::class, 'search'])->name('posts.search');
});

Route::controller(RegisterController::class)->prefix('auth')->as('auth.')->group(function () {
    Route::post('log-reg', 'register')->name('log-reg');
    Route::get('myAccount', 'myAccount')->name('myAcc');
});
// route hiển thịn form đăng nhập, đăng ký
Route::get('/showform', [AuthController::class, 'form'])->name('showForm');
Route::get('/form-reg', [AuthController::class, 'form_reg'])->name('formReg');
Route::get('/email/verify/{id}', [VerificationController::class, 'verify'])->name('verification.verify');



// Route::get('/login', [LoginController::class, 'showLoginForm'])->name('showLoginForm');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::controller(MyAccountController::class)->middleware('auth.checkLog')->group(function () {
    Route::get('/my-account', 'index')->name('my-account');
    Route::get('/get-orders', 'getOrders')->name('orders.get.list');
    Route::get('/get-order-details/{id}', 'getOrderDetails')->name('order.details');
    Route::get('/orders/{id}/download-pdf', 'downloadPDF')->name('orders.downloadPDF');
    Route::post('/orders/{id}/cancel', 'cancelOrder')->name('orders.cancel');
    Route::post('/orders/{id}/reset', 'resetOrder')->name('orders.reset');
    Route::post('/orders/{id}/received', 'markAsReceived')->name('orders.received');
    Route::post('/update-password', 'changePassword')->name('change.password');
    // dang xuat tai khoan
    Route::post('/logout', 'logout')->name('logout');
});
route::get('responehandle', [CartController::class, 'handlewallet'])->name('handlewallet');
// Route cho trang yêu cầu đặt lại mật khẩu
Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordForm'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('email-password');

// Route cho trang đặt lại mật khẩu
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// đăng nhập với google
Route::get('auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::get('map', [ClientController::class, 'map'])->name('map');
//giỏ hàng
Route::controller(TicketController::class)
->name('ticket.')
->group(function () {
    Route::post('add-ticket', 'addTicket')->name('addTicket');
    Route::get('chat/{id}', [TicketController::class,'chatshow'])->name('chat');
    Route::post('sent-chat', 'sentchat')->name('sentchat');

});

Route::controller(CartController::class)->group(function () {
    Route::post('/cart/add', 'add')->name('cart.add');
    Route::get('/cart', 'index')->name('cart.index');
    Route::get('/cart/list', 'list')->name('cart.list');
    Route::put('/cart/update/{id}', 'update')->name('cart.update');
    Route::delete('/cart/remove/{id}', 'remove')->name('cart.remove');
    Route::post('/cart/apply-coupon', 'applyCoupon')->name('cart.applyCoupon');
    Route::get('/cart/checkout', 'order')->name('cart.checkout');
    Route::post('/cart/remove-discount-code', 'removeDiscountCode')->name('cart.removeDiscountCode');
    route::get('retrypayment/{id}', 'retrypayment')->name('retrypayment');
});

Route::post('/submit-review', [ReviewController::class, 'submitReview'])->name('submit-review');

Route::get('/invoice/{id}', [MyAccountController::class, 'invoiceDetail'])->name('client.invoice.show')->middleware('auth.checkLog');

Route::post('/send-notification', [CartController::class, 'sendNotification'])->name('send.notification');
route::get('filterproduct', [ShopController::class, 'filterproduct'])->name('filterproduct');

Route::controller(WishlistController::class)->group(function () {
    Route::get('/wishlist', 'index')->name('wishlist.index')->middleware('auth.checkLog');;
    Route::post('/wishlist/add', 'add')->name('wishlist.add')->middleware('auth.checkLog');;
    Route::delete('/wishlist/remove/{id}', 'destroy')->name('wishlist.remove')->middleware('auth.checkLog');;
});
