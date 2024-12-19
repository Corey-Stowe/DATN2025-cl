<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\App\Http\Controllers\DashboardController;
use Modules\Admin\App\Http\Controllers\TagController;
use Modules\Admin\App\Http\Controllers\PostController;
use Modules\Admin\App\Http\Controllers\UserController;
use Modules\Admin\App\Http\Controllers\AdminController;
use Modules\Admin\App\Http\Controllers\OrderController;
use Modules\Admin\App\Http\Controllers\BannerController;
use Modules\Admin\App\Http\Controllers\CouponController;
use Modules\Admin\App\Http\Controllers\AccountController;
use Modules\Admin\App\Http\Controllers\CommentController;
use Modules\Admin\App\Http\Controllers\InvoiceController;
use Modules\Admin\App\Http\Controllers\ProductController;
use Modules\Admin\App\Http\Controllers\SupportController;
use Modules\Admin\App\Http\Controllers\CategoryController;
use Modules\Admin\App\Http\Controllers\AttributeController;
use Modules\Admin\App\Http\Controllers\StatisticalController;
use Modules\Admin\App\Http\Controllers\NotificationController;
use Modules\Admin\App\Http\Controllers\ForgotPasswordController;
use Modules\Admin\App\Http\Controllers\AuthenticateController;
use Modules\Admin\App\Http\Controllers\ProfileController;
use Modules\Admin\App\Http\Controllers\WalletController;


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

// Route::group([], function () {
//     Route::resource('admin', AdminController::class)->names('admin');
// });






Route::get('login-admin', [AuthenticateController::class, 'showLoginForm'])->name('login.admin');
Route::post('post-login-admin', [AuthenticateController::class, 'PostLogin'])->name('loginAdmin');
Route::get('logout-admin', [AuthenticateController::class, 'logout'])->name('logout.admin');


Route::get('admin-forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('admin.forgot.password');
Route::post('admin-forgot-password', [ForgotPasswordController::class, 'postForgotPassword'])->name('admin.post.forgot.password');

Route::get('admin-reset-password/{token}', [ForgotPasswordController::class, 'resetPassword'])->name('admin.reset.password');
Route::post('admin-reset-password', [ForgotPasswordController::class, 'postResetPassword'])->name('admin.post.reset.password');

Route::get('admin-confirm-mail', [ForgotPasswordController::class, 'confirmMail'])->name('admin.confirm.mail');




Route::prefix('admin')
    ->as('admin.')
   ->middleware(['CheckAdmin'])
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::controller(BannerController::class)
            ->prefix('banner')->as('banner.')
            ->middleware(['role:super_admin|banner_manager'])
            ->group(function () {
                Route::get('slider', 'slider')->name('slider');
                Route::get('list', 'index')->name('list');
                Route::put('update/{banner}', 'update')->name('update');
                Route::put('cap-nhat/{banner}', 'cap_nhat')->name('cap_nhat');
                Route::get('delete/{id}', 'delete')->name('delete');
                Route::post('add/{position}', 'add')->name('add');
            });
        // Route quản lý categories
        Route::controller(CategoryController::class)->prefix('categories')->as('categories.')
        ->middleware(['role:super_admin|category_manager'])
        ->group(function () {
            Route::get('list', 'listCategories')->name('list');
            Route::get('edit-pl/{slug}', 'edit_pl')->name('edit_pl');
            Route::get('edit-dm/{slug}', 'edit_dm')->name('edit_dm');
            Route::post('add-phan-loai', 'phan_loai')->name('them_pl');
            Route::post('add-danh-muc', 'danh_muc')->name('them_dm');
            Route::put('update-pl/{category}', 'update_pl')->name('update_pl');
            Route::put('update-danh-muc/{subCategory}', 'update_dm')->name('update_dm');
            Route::delete('delete-danh-muc/{category}', 'destroy')->name('delete_pl');
            Route::delete('delete-sub-danh-muc/{subCategory}', 'destroySub')->name('delete_dm');
        });


        //walelt
        Route::controller(WalletController::class)->prefix('wallet')->as('wallet.')
        ->middleware(['role:super_admin|wallet_manager'])
        ->group(function () {
            Route::get('list-withdraw', 'index')->name('list');
            Route::get('withdraw/{id}', 'withdraw')->name('withdraw');
            Route::post('update-withdraw', 'updatepost')->name('updateupdatepost');
            Route::post('lock-wallet-withdraw', 'lockwallet')->name('lockwallet');
            Route::post('holdback', 'holdback')->name('holdback');
            Route::get('list-wallet', 'listallwallet')->name('listallwallet');
            Route::get('wallet-info/{id}', 'walletinfo')->name('walletinfo');
            Route::get('setActive/{id}', 'setActive')->name('setActive');
            Route::get('SetInActive/{id}', 'SetInActive')->name('SetInActive');
            Route::get('SetLevelBasic/{id}', 'SetBasicUser')->name('SetBasicUser');
            Route::get('SetLevelFull/{id}', 'SetFullUser')->name('SetFullUser');
            Route::post('lock-wallet', 'lockwalletUser')->name('lockwalletUser');
            Route::get('listUserPending', 'listUserPending')->name('listUserPending');
            Route::get('userpedDetail/{id}', 'userpedDetail')->name('userpedDetail');
            Route::post('userpedUpdate', 'userpedUpdate')->name('userpedUpdate');
            Route::post('search-withdraw', 'SeachWithdraw')->name('SeachWithdraw');
            Route::post('search-wallet', 'SeachWallet')->name('SeachWallet');
            Route::get('list-withdraw-ped', 'listwithdrawPed')->name('listwithdrawPed');
            Route::get('list-withdraw-approved', 'listwithdrawapp')->name('listwithdrawapp');
            Route::get('list-withdraw-reject', 'listwithdrawrej')->name('listwithdrawrej');
        });



        // Route quản lý products
        Route::controller(ProductController::class)->prefix('product')->as('product.')
        ->middleware(['role:super_admin|product_manager'])
        ->group(function () {
            Route::get('listProduct', 'listProduct')->name('list');
            Route::get('addProduct', 'showFormAdd')->name('addProduct');
            Route::post('createProduct', 'createProduct')->name('create');
            Route::get('edit/{slug}', 'showFormEdit')->name('edit');
            Route::put('update/{product}', 'updatePrd')->name('update');
            Route::get('{id}/delTag', 'delTag')->name('delTag');
            Route::get('{id}/delImg', 'delImg')->name('delImg');
            Route::delete('{product}/delete', 'destroy')->name('delP');
            Route::get('detail/{slug}', 'detail')->name('detailP');
            Route::get('{id}/delVariant', 'delete')->name('deleteVariant');
            // sản phẩm xóa mềm
            Route::get('listTrashed', 'trashed')->name('listTrashed');
            Route::get('restore-all', 'restoreAll')->name('restoreAll');
            Route::get('restore-one/{id}', 'restoreOne')->name('rtOne');
        });
        // Route quản lý comment
        Route::controller(CommentController::class)->prefix('comment')->as('comment.')
        ->middleware(['role:super_admin|comment_manager'])
        ->group(function () {

            Route::get('listComment', 'listComment')->name('listComment');
            Route::get('/{id}/editComment', 'editComment')->name('editComment');
            Route::put('{id}updateComment', 'updateComment')->name('updateComment');
            Route::post('bulk-action', 'bulkAction')->name('bulkAction');
        });

        // Route quản lý attributes
        Route::controller(AttributeController::class)->prefix('attributes')->as('attributes.')
        ->middleware(['role:super_admin|attribute_manager'])
        ->group(function () {
            Route::get('list', 'listAttr')->name('listAttr');
            Route::post('add', 'addAttr')->name('addAttr');
            Route::get('{id}/delValueC', 'delValueC')->name('delValueC');
            Route::get('{id}/delValueS', 'delValueS')->name('delValueS');
            Route::get('{atrr}/edit', 'showFormEdit')->name('edit');
            Route::put('{atrr}/update', 'update')->name('update');
        });

        // Route quản lý attributes
        Route::controller(AttributeController::class)->prefix('attributes')->as('attributes.')
        ->middleware(['role:super_admin|attribute_manager'])
        ->group(function () {
            Route::get('list', 'listAttr')->name('listAttr');
            Route::post('add', 'addAttr')->name('addAttr');
            Route::get('{id}/delValueC', 'delValueC')->name('delValueC');
            Route::get('{id}/delValueS', 'delValueS')->name('delValueS');
            Route::get('{atrr}/edit', 'showFormEdit')->name('edit');
            Route::put('{atrr}/update', 'update')->name('update');
        });

        // Route quản lý tags
        Route::controller(TagController::class)->prefix('tags')->as('tags.')
        ->middleware(['role:super_admin|tag_manager'])
        ->group(function () {
            Route::get('listTags', 'index')->name('list');
            Route::post('createTag', 'store')->name('create');
            Route::get('delTag/{slug}', 'destroy')->name('delete');
        });

        // Route quản lý orders
        Route::controller(OrderController::class)->prefix('orders')->as('orders.')
        ->middleware(['role:super_admin|order_manager'])
        ->group(function () {
            Route::get('listOrders', 'listOrder')->name('list');
            Route::get('{order}/orderDetail', 'orderDetail')->name('detail');
            Route::put('{order}/update', 'orderUpdate')->name('update');
            Route::post('cancelOrder', 'cancelOrder')->name('cancel');
            Route::post('cancelAndRefund', 'cancelAndRefund')->name('cancelAndRefund');
            Route::post('updateShip', 'updateShip')->name('updateShip');
            Route::get('createship/{id}', 'createship')->name('createship');
            Route::put('order-update/{order}', 'updatePayment')->name('udtPayment');
        });

        // Route quản lý in hóa đơn
        Route::controller(InvoiceController::class)->prefix('invoice')->as('invoice.')
        ->middleware(['role:super_admin|order_manager'])
        ->group(function () {
            Route::get('{order}/savePDF', 'savePDF')->name('save');
            Route::post('bulkActions', 'bulkActions')->name('bulkActions');
        });

        // thống kê
        Route::controller(StatisticalController::class)->prefix('statistical')->as('statistical.')
        ->middleware(['role:super_admin|statistical_viewer'])
        ->group(function () {
            Route::get('listStatistical', 'index')->name('listStatistical');
            Route::get('statisticalOrder', 'order')->name('statisticalOrder');
            Route::get('staticticalRevenue', 'revenue')->name('staticticalRevenue');
            Route::get('staticticalSuccess', 'success')->name('staticticalSuccess');
            Route::get('export', 'export')->name('export');
        });

        // Route quản lý accounts
        Route::controller(AccountController::class)->prefix('accounts')->as('accounts.')
        ->middleware(['role:super_admin'])
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('/{id}/show', 'show')->name('show');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('{id}/update', 'update')->name('update');
        });

        // Route quản lý users
        // Route::controller(AccountController::class)->prefix('account')->as('account.')->group(function(){
        //     Route::get('listAcc', 'listAccounts')->name('list');
        // });
    
        // thống kê
        Route::controller(StatisticalController::class)->prefix('statistical')->as('statistical.')
        ->middleware(['role:super_admin|statistical_viewer'])
        ->group(function () {
            Route::get('listStatistical', 'index')->name('listStatistical');
            Route::get('statisticalOrder', 'order')->name('statisticalOrder');
            Route::get('staticticalRevenue', 'revenue')->name('staticticalRevenue');
            Route::get('staticticalSuccess', 'success')->name('staticticalSuccess');
            Route::get('export', 'export')->name('export');
        });


        Route::controller(CouponController::class)
            ->prefix('coupons')
            ->as('coupons.')
            ->middleware(['role:super_admin|coupon_manager'])
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('/{id}/show', 'show')->name('show');
                Route::get('/{id}/edit', 'edit')->name('edit');
                Route::put('{id}/update', 'update')->name('update');
                // Route::delete('/{id}/destroy', 'destroy')->name('destroy');
            });

        // Route quản lý tài khoản khách hàng
        Route::controller(UserController::class)
            ->prefix('users')
            ->as('users.')
            ->middleware(['role:super_admin|customer_manager'])
            ->group(function () {
            Route::get('/', 'index')->name('index');
            // Route::get('create', 'create')->name('create');
            // Route::post('store', 'store')->name('store');
            Route::get('/{id}/show', 'show')->name('show');
            Route::put('{id}/updateStatus', 'updateStatus')->name('updateStatus');
            // Route::get('/{id}/edit', 'edit')->name('edit');
            // Route::put('{id}/update', 'update')->name('update');
            // Route::delete('/{id}/destroy', 'destroy')->name('destroy');
        });

        // Route quản lý posts
        Route::controller(PostController::class)->prefix('posts')
        ->middleware(['role:super_admin|post_manager'])
        ->as('posts.')
            ->group(function () {
            // Route::get('formPost', 'showForm')->name('show_form');
            Route::get('list', 'index')->name('list');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('/show/{slug}', 'show')->name('showPost');
            Route::get('/edit/{slug}', 'edit')->name('editPost');
            Route::put('{id}update', 'update')->name('update');
            Route::delete('/{id}/destroy', 'destroy')->name('destroy');
        });
        Route::controller(SupportController::class)
        ->middleware(['role:super_admin|ticket_manager'])
            ->prefix('tickets')
            ->as('ticket.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');
                Route::get('/{id}/{user_id}/show', 'show')->name('show');
                Route::get('/{id}/spam', 'setSpam')->name('setSpam');
                Route::get('/{id}/close', 'setComplete')->name('setComplete');
                Route::post('reply', 'updatemessage')->name('updatemessage');
                Route::get('open', 'showOpen')->name('open');
                Route::get('close', 'showClose')->name('close');
                Route::get('spam', 'showSpam')->name('spam');
                Route::post('search', 'search')->name('search');
            });
        Route::controller(NotificationController::class)
            ->prefix('notifications')
            ->as('notifications.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/read', 'read')->name('read');
            });

        Route::controller(ProfileController::class)
            ->prefix('profile')
            ->as('profile.')
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::put('/update/{id}', 'update')->name('update');
            });
    });
