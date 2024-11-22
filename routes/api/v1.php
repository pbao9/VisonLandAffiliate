<?php

use Illuminate\Support\Facades\Route;

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

// Dành cho khách vãng lai


Route::controller(App\Api\V1\Http\Controllers\CustomerRegistrations\CustomerRegistrationsController::class)
    ->prefix('/article-register')
    ->as('articleRegister.')
    ->middleware('api.guest')
    ->group(function () {
        Route::post('/add', 'add')->name('add');
    });

Route::prefix('/address')->middleware('api.guest')->group(function () {
    Route::controller(App\Api\V1\Http\Controllers\Address\ProvinceController::class)
        ->prefix('/province')
        ->as('province.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });

    Route::controller(App\Api\V1\Http\Controllers\Address\DistrictController::class)
        ->prefix('/district')
        ->as('district.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });

    Route::controller(App\Api\V1\Http\Controllers\Address\WardController::class)
        ->prefix('/ward')
        ->as('ward.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });
});

Route::middleware('api.guest')->group(function () {
    Route::controller(App\Api\V1\Http\Controllers\HouseType\HouseTypeController::class)
        ->prefix('/house-types')
        ->as('house-types.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });


    Route::controller(App\Api\V1\Http\Controllers\Area\AreaController::class)
        ->prefix('/areas')
        ->as('areas.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });
});

//***** -- Articles -- ******* //
Route::controller(App\Api\V1\Http\Controllers\Articles\ArticlesController::class)
    ->prefix('/articles')
    ->as('articles.')
    ->group(function () {
        Route::middleware('api.guest')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/search', 'search')->name('search');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/view-article/{article_id}/{referal_code}', 'viewArticle')->name('viewArticle');
        });
        Route::middleware('auth:api')->group(function () {
            Route::post('/add', 'add')->name('add');
            Route::post('/edit', 'edit')->name('edit');
            Route::post('/payment', 'payment')->name('payment');
            Route::delete('/delete', 'delete')->name('delete');
            Route::get('/search-my-article', 'searchMyArticle')->name('searchMyArticle');
        });
        Route::get('/status-article', 'statusArticle')->name('status-article');
        Route::get('/type', 'typeArticle')->name('type-article');
    });
//***** -- Articles -- ******* //


Route::controller(App\Api\V1\Http\Controllers\Collaboration\CollaborationController::class)
    ->prefix('/collaboration')
    ->as('collaborations.')
    ->group(function () {
        Route::middleware('auth:api')->group(function () {
            Route::post('/add', 'add')->name('add');
            Route::get('/', 'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
            Route::get('/all', 'all')->name('all');
        });
    });



//***** -- Customers -- ******* //
Route::controller(App\Api\V1\Http\Controllers\Customers\CustomersController::class)
    ->prefix('/customers')
    ->as('customers.')
    ->group(function () {
        Route::middleware('auth:api')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show/{id}', 'show')->name('show');
            Route::delete('/delete', 'delete')->name('delete');
            Route::post('/add', 'add')->name('add');
            Route::put('/edit', 'edit')->name('edit');
        });
        Route::middleware('api.guest')->group(function () {
            Route::post('/contact', 'contact')->name('contact');
        });
    });
//***** -- Customers -- ******* //



Route::middleware('auth:api')->group(function () {

    Route::controller(App\Api\V1\Http\Controllers\CustomerRegistrations\CustomerRegistrationsController::class)
        ->prefix('/article-register')
        ->as('articleRegister.')
        ->group(function () {
            Route::post('/add-has-token', 'addHasToken')->name('addHasToken');
            Route::get('/list', 'list')->name('list');
        });

    //***** -- Setting -- ******* //
    Route::controller(App\Api\V1\Http\Controllers\Setting\SettingController::class)
        ->prefix('/settings')
        ->as('setting.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
        });
    // //***** -- Setting -- ******* //

    //***** -- Notification -- ******* //
    Route::controller(App\Api\V1\Http\Controllers\Notification\NotificationController::class)
        ->prefix('/notifications')
        ->as('notification.')
        ->group(function () {
            Route::middleware('auth:api')->prefix('/notifications')->as('notification.')->group(function () {
                Route::put('/update-device-token', 'updateDeviceToken')->name('updateToken');
            });
            Route::get('/read/{id}', 'read')->name('read');
            Route::put('/readAll', 'readAll')->name('readAll');
            Route::get('/', 'index')->name('index');
            Route::delete('/delete', 'delete')->name('delete');
            Route::post('/add', 'add')->name('add');
            Route::put('/edit', 'edit')->name('edit');
        });
    //***** -- Notification -- ******* //
});


// //auth
Route::controller(App\Api\V1\Http\Controllers\Auth\AuthController::class)
    ->group(function () {
        Route::middleware('auth:api')->prefix('/auth')->as('auth.')->group(function () {
            Route::get('/', 'show')->name('show');
            Route::post('/', 'update')->name('update');
            Route::post('/CCCD', 'UpdateCCCd')->name('UpdateCCCd');
            Route::put('/update-password', 'updatePassword')->name('update_password');
            Route::get('/show/child/{id}', 'showChild')->name('showChild');
            Route::get('/show/child-all', 'showChildAll')->name('showChildAll');
            // Bank
            Route::post('/add-bank', 'addBank')->name('addBank');
            Route::put('/edit-bank', 'editBank')->name('editBank');
            Route::delete('/delete-bank', 'deleteBank')->name('deleteBank');
            Route::get('/show-bank/{id}', 'showBank')->name('showBank');
        });
        Route::post('/CheckOtp', 'CheckOtp')->name('CheckOtp');
        Route::post('/resendOtp', 'ResendOtp')->name('ResendOtp');
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
        Route::post('logout', 'logout')->name('logout');
    });

Route::controller(App\Api\V1\Http\Controllers\Auth\ResetPasswordController::class)
    ->prefix('/reset-password')
    ->as('reset_password.')
    ->group(function () {
        Route::post('/', 'checkAndSendMail')->name('check_and_send_mail');
    });

Route::fallback(function () {
    return response()->json([
        'status' => 404,
        'message' => __('Không tìm thấy đường dẫn.')
    ], 404);
});
