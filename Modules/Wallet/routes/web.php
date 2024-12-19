<?php

use Illuminate\Support\Facades\Route;
use Modules\Wallet\App\Http\Controllers\EkycController;
use Modules\Wallet\App\Http\Controllers\PayController;
use Modules\Wallet\App\Http\Controllers\WalletController;
use Modules\Wallet\App\Http\Controllers\WebauthnController;

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

Route::controller(WalletController::class)
->middleware(["user","userwallet"])
->name("wallet.")
->prefix("wallet")
->group(function(){
    Route::get("/", [WalletController::class,"index"])->name("index");
    Route::get("topup", [WalletController::class,"topup"])->name("topup");
    Route::post("charge", [WalletController::class,"charge"])->name("charge");
    Route::get('transaction-detail/{id}', [WalletController::class, 'transaction'])->name('transaction');
    Route::get('res/vnpay', [WalletController::class, 'callbackvnpaydata'])->name('callbackvnpaydata');
    Route::get('withdraw', [WalletController::class, 'withdraw'])->name('withdraw');
    Route::post('withdraw-create', [WalletController::class, 'createWithdraw'])->name('createWithdraw');
    Route::get('withdarw-cancel/{id}', [WalletController::class, 'withdrawcanel'])->name('withdrawcanel');
    Route::get('profile', [WalletController::class,'profile'])->name('profile');
});
Route::controller(PayController::class)
->middleware(["user","userwallet"])
->name("wallet.pay.")
->prefix("wallet/pay")
->group(function(){
    Route::get("wlpay.htm", [PayController::class,"index"])->name("index");
    route::get("/{id}", [PayController::class,"token"])->name("token");
    Route::post("otp", [PayController::class,"otp"])->name("otp");
    Route::post("charge", [PayController::class,"chagre"])->name("charge");
    Route::get("resendotp/{id}", [PayController::class,"resendtotp"])->name("resendtotp");
    Route::get('errorpayment', [PayController::class, 'errorpayment'])->name('errorpayment');
    Route::get('cancel/{id}', [PayController::class,'cancel'])->name('cancel');
    Route::post('OTPlessverify', [PayController::class,'chagreotpless'])->name('chagreotpless');

});


Route::controller(EkycController::class)
->middleware(["user"])
->name("ekyc.")
->prefix("wallet/ekyc")
->group(function(){
    Route::get("/", [EkycController::class,"index"])->name("index");
    Route::get("step1", [EkycController::class,"verifyadress"])->name("verifyadress");
    Route::post("step1update", [EkycController::class,"uploadadress"])->name("uploadadress");
    Route::get("step2", [EkycController::class,"verifykyc"])->name("verifykyc");
    Route::post("step2update", [EkycController::class,"uploadkyc"])->name("uploadkyc");
    Route::get("step2skip", [EkycController::class,"step2skip"])->name("step2skip");
    Route::get("step3", [EkycController::class,"verifytos"])->name("verifytos");
    Route::post("submit", [EkycController::class,"registerwallet"])->name("registerwallet");

});

Route::controller(WebauthnController::class)
->middleware(["user","userwallet"])
->name("wallet.webautn.")
->prefix("wallet/webauthn")
->group(function(){
    Route::get("/", [WebauthnController::class,"index"])->name("index");
    Route::post("register", [WebauthnController::class,"store"])->name("store");
    Route::get("login", [WebauthnController::class,"login"])->name("login");
    route::post("checkvar", [WebauthnController::class,"checkvar"])->name("checkvar");
    Route::post("action", [WebauthnController::class,"action"])->name("action");

});
