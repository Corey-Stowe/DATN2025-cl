<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Wallet\App\Http\Controllers\WalletController;

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

// Route::middleware(['auth:sanctum'])->prefix('v1')->name('api.')->group(function () {
//     Route::get('wallet', fn (Request $request) => $request->user())->name('wallet');
// });

Route::controller(WalletController::class)->prefix('wallet')
->name('api.wallet.')->group(function (){
    Route::get('/', [WalletController::class, 'callbackvnpaydata'])->name('callbackvnpaydata');
});
