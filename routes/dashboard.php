<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\AdminController;
use App\Http\Controllers\dashboard\RolesController;
use App\Http\Controllers\dashboard\BlogController;
use App\Http\Controllers\dashboard\SettingController;
use App\Http\Controllers\dashboard\WelcomeController;
use App\Http\Controllers\dashboard\auth\AuthController;
use App\Http\Controllers\dashboard\NotificationController;
use App\Http\Controllers\dashboard\auth\ResetPasswordController;
use App\Http\Controllers\dashboard\auth\ForgetPasswordController;
use App\Http\Controllers\dashboard\SpotDifferenceImageController;
use App\Http\Controllers\dashboard\UsersController;
use App\Http\Controllers\dashboard\ArabicLettersController;
use App\Http\Controllers\dashboard\ArabicVocabularyController;
use App\Http\Controllers\dashboard\ArabicReadingController;
use App\Http\Controllers\dashboard\ProductCategoryController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\PageContentController;

Route::group([
    'prefix' => '/dashboard',
    'as' => 'dashboard.',
], function () {

    ##################### Auth Login Controller  ########################
    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'show_login')->name('login.show');
        Route::post('register_login', 'register_login');
        Route::post('logout', 'logout')->name('logout');
    });

    ############################### End Auth Login Controller ###############
    ################### Reset Password #############
    Route::controller(ForgetPasswordController::class)->group(function () {
        Route::get('password/email', 'showemailform')->name('password.email');
        Route::post('password/email', 'sendotp')->name('password.email.post');
        Route::get('password/verify/{email}', 'showotpform')->name('password.otp.show');
        Route::get('password/verify', 'otpverify')->name('password.otp.post');
        Route::match(['post', 'get'], 'forget-password', 'forget_password')->name('forget_password');
        Route::match(['post', 'get'], 'change-forget-password/{code}', 'change_forget_password');
        Route::post('user/update_forget_password', 'update_forget_password')->name('update_forget_password');
    });
    Route::controller(ResetPasswordController::class)->group(function () {
        Route::get('password/reset/{email}', 'ShowResetForm')->name('password.reset');
        Route::post('password/reset', 'resetpassword')->name('password.reset.post');
    });

    ############################### Start Admin Auth Route  ###############
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::controller(AuthController::class)->group(function () {
            Route::match(['post', 'get'], 'update_profile', 'update_profile')->name('update_profile');
            Route::match(['post', 'get'], 'update_password', 'update_password')->name('update_password');
        });

        ############################### Start Welcome  Controller ###############

        Route::controller(WelcomeController::class)->group(function () {
            Route::get('welcome', 'index')->name('welcome');
        });

        ############################### End  Welcome  Controller ###############


        ##################### Start Role Permissions ####################
        Route::group(['middleware' => 'can:roles', 'prefix' => 'role', 'as' => 'roles.'], function () {
            Route::controller(RolesController::class)->group(function () {
                Route::get('index', 'index')->name('index');
                Route::match(['get', 'post'], 'create', 'create')->name('create');
                // Route::post('store', 'store')->name('store')->middleware('can:roles');
                Route::match(['get', 'post'], 'update/{id}', 'update')->name('update');
                Route::match(['post', 'get'], 'destroy/{id}', 'destroy')->name('destroy');
            });
        });

        ##################### End Role Permissions #########################

        ################ Start Notification Controller ############
        Route::controller(NotificationController::class)->group(function () {
            Route::get('all_read', 'AllRead')->name('all_read');
        });
        ################ End Notification Controller ##############
        ################# Start Setting Controller ###############
        Route::controller(SettingController::class)->group(function () {
            Route::get('setting', 'index')->name('setting.index');
            Route::post('setting/update', 'update')->name('setting.update');
        });
        ################# End Setting Controller ###############

        ################################# Start Users Controller #################
        Route::controller(UsersController::class)->group(function () {
            Route::get('users', 'index')->name('users.index');
        });

        ##################### Start Product Categories ####################
        Route::group(['prefix' => 'product-categories', 'as' => 'product-categories.'], function () {
            Route::controller(ProductCategoryController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
            });
        });
        ##################### End Product Categories ####################

        ##################### Start Products ####################
        Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
            Route::controller(ProductController::class)->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/update/{id}', 'update')->name('update');
                Route::get('/destroy/{id}', 'destroy')->name('destroy');
                Route::post('/delete-image/{id}', 'deleteImage')->name('delete-image');
                Route::post('/set-main-image/{id}', 'setMainImage')->name('set-main-image');
            });
        });
        ##################### End Products ####################

        ##################### Start Page Contents ####################
        Route::group(['prefix' => 'page-contents', 'as' => 'page-contents.'], function () {
            Route::controller(PageContentController::class)->group(function () {
                Route::get('/', 'index')->name('index');

                // Home Page
                Route::get('/home', 'home')->name('home');
                Route::post('/home/update', 'updateHome')->name('home.update');

                // About Page
                Route::get('/about', 'about')->name('about');
                Route::post('/about/update', 'updateAbout')->name('about.update');

                // Contact Page
                Route::get('/contact', 'contact')->name('contact');
                Route::post('/contact/update', 'updateContact')->name('contact.update');

                // Product Page
                Route::get('/product', 'product')->name('product');
                Route::post('/product/update', 'updateProduct')->name('product.update');

                // Search Page
                Route::get('/search', 'search')->name('search');
                Route::post('/search/update', 'updateSearch')->name('search.update');

                // Favorites Page
                Route::get('/favorites', 'favorites')->name('favorites');
                Route::post('/favorites/update', 'updateFavorites')->name('favorites.update');
            });
        });
        ##################### End Page Contents ####################
    });
});
