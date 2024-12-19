<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Client\App\Http\Controllers\CartController;
use Modules\Client\App\Http\Controllers\ClientController;
use Modules\Client\App\Http\Controllers\ShopController;
use Modules\Client\App\Http\Controllers\TicketController;
use PHPUnit\Framework\Attributes\Ticket;

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
    Route::get('client', fn (Request $request) => $request->user())->name('client');

});
Route::get('v1/meanhxuyen', [CartController::class, 'meanhxuyen'])
->name('meanhxuyen');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('checkout');


Route::controller(ClientController::class)->group(function () {
    Route::post('v1/hintseach', 'seachhint')->name('seachhint');
});

Route::controller(TicketController::class)->group(function () {
    Route::get('v1/aigenerate/{id}', 'aigenerate')->name('aigenerate');
});

Route::controller(ClientController::class)->group(function () {
    Route::get('v1/getshipping/{id}', 'shipping')->name('shipping');
});
Route::controller(ShopController::class)->group(function () {
    Route::get('v1/findprod/{id}', 'showproduct')->name('showproduct');
});



