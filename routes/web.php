<?php

use App\Http\Controllers\LangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\Auth\ForgotController;
use App\Http\Controllers\Web\Auth\VerifyController;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Web\LoginGoogleController;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\Web\RealtimeController;
use Illuminate\Support\Facades\Route;

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

Route::group(['middleware'  => 'LanguageManager'], function () {

    // // URL LANGUAGE //
    Route::get('/lang/{locale}', [LangController::class, 'changeLang'])->name('lang.switch');

    // ERROR //
    Route::get('/error', function () {
        return view('content');
    })->name('errors');

    // REALTIME //
    Route::post('/realtime/footer', [RealtimeController::class, 'RealtimeFooter'])->name('realtime.footer');
    Route::post('/realtime/cart', [RealtimeController::class, 'RealTimeCart'])->name('realtime.cart');
    Route::post('/realtime/banner', [RealtimeController::class, 'RealTimeBanner'])->name('realtime.banner');
    Route::post('/realtime/subscribe', [RealtimeController::class, 'RealTimeSubscribe'])->name('realtime.subscribe');

    Route::group(['middleware' => ['guest']], function () {

        // LOGIN GOOGLE //
        Route::get('/auth/google', [LoginGoogleController::class, 'redirectToGoogle'])->name('login.google');
        Route::get('/auth/google/callback', [LoginGoogleController::class, 'handleGoogleCallback']);

        // HOME //
        Route::get('/', [HomeController::class, 'Home'])->name('index');

        // LOGIN //
        Route::get('/login', function () {
            return redirect(route('index'));
        })->name('login.guest');
        Route::post('/login/post', [AuthController::class, 'sign'])->name('login.post');


        // VERIFY //
        Route::get('/verify/account/{email}', [VerifyController::class, 'verify'])->name('verify');

        // RESET //
        Route::get('/reset/{token}', [ForgotController::class, 'reset'])->name('reset');
        Route::post('/reset/post', [ForgotController::class, 'resetPost'])->name('reset.post');
        Route::post('/forgot/post', [ForgotController::class, 'forgotPost'])->name('forgot.post');

        // PRODUCT //
        Route::get('/product', [ProductController::class, 'index'])->name('product');
        Route::get('/product/{slug}', [ProductController::class, 'detail'])->name('product.detail');
    });

    // AUTHORIZED AUTH //
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/auth', [AuthController::class, 'index'])->name('client.auth');
        Route::get('/exit', [AuthController::class, 'logout'])->name('exit');

        // PRODUCT //
        Route::get('/product', [ProductController::class, 'index'])->name('product');
        Route::get('/product/{slug}', [ProductController::class, 'detail'])->name('product.detail');
    });
});
