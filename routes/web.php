<?php

use App\Http\Controllers\LangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\Auth\VerifyController;
use App\Http\Controllers\Web\HomeController;
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

    Route::group(['middleware' => ['guest']], function () {

        // HOME //
        Route::get('/', [HomeController::class, 'Home'])->name('index');

        // VERIFY //
        Route::get('/verify/account/{email}', [VerifyController::class, 'verify'])->name('verify');
    });

    // AUTHORIZED AUTH //
    Route::group(['middleware' => ['auth']], function () {
    });
});
