<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Admin\App\Http\Controllers\Api\AccountController;
use Modules\Admin\App\Http\Controllers\Api\CouponController;
use Modules\Admin\App\Http\Controllers\Api\NotificationController;
use Modules\Admin\App\Http\Controllers\Api\UserController;
use Modules\Admin\App\Http\Controllers\SupportController;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::middleware(['auth:sanctum'])->prefix('v1')->name('api.')->group(function () {
    Route::get('admin', fn(Request $request) => $request->user())->name('admin');
});

Route::controller(CouponController::class)
    ->prefix('coupons')
    ->as('api.coupons.')
    //->middleware(['role:super_admin|coupon_manager'])
    ->group(function () {
        Route::get('/', 'index')->name('index');
        // Route::post('/', 'store')->name('store');
        // Route::get('/{id}', 'show')->name('show');
        // Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });
Route::controller(AccountController::class)
    ->prefix('accounts')
    //->middleware(['role:super_admin'])
    ->as('api.accounts.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        // Route::post('/', 'store')->name('store');
        // Route::get('/{id}', 'show')->name('show');
        // Route::put('/{id}', 'update')->name('update');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

Route::controller(UserController::class)
    ->prefix('users')
    ->as('api.users.')
    //->middleware(['role:super_admin|customer_manager'])
    ->group(function () {
        Route::get('/', 'index')->name('index');
        // Route::post('/', 'store')->name('store');
        // Route::get('/{id}', 'show')->name('show');
        // Route::put('/{id}', 'update')->name('update');
        // Route::delete('/{id}', 'destroy')->name('destroy');
    });

Route::controller(SupportController::class)
    ->prefix('supports')
    //->middleware(['role:super_admin|ticket_manager'])
    ->as('api.supports.')
    ->group(function () {
        Route::post('customer', 'seachcustomer')->name('seachcustomer');
        Route::get('customer/{id}', 'userdetail')->name('userdetail');
        route::get('lastid', 'getlastticket')->name('getlastticket');
        // Route::post('/', 'store')->name('store');
        // Route::get('/{id}', 'show')->name('show');
        // Route::put('/{id}', 'update')->name('update');
        // Route::delete('/{id}', 'destroy')->name('destroy');
    });

Route::controller(NotificationController::class)
    ->prefix('notifications')
    ->as('api.notifications.')
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/read', 'read')->name('read');
        Route::get('/count', 'unreadCount')->name('count.read');
    });
