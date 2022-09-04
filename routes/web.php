<?php

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
Route::get('locale/{locale}', [\App\Http\Controllers\MainController::class, 'changeLocale'])->name('locale');

Route::middleware(['set_locale'])->group(function ($language) {

    Route::get('/', [\App\Http\Controllers\MainController::class, 'index'])->name('home');

    Route::middleware(['auth'])->prefix('/personal')->group(function () {
        Route::get('/', [\App\Http\Controllers\PersonalController::class, 'index'])->name('personal');
    });

    Route::resource('order', \App\Http\Controllers\OrdersController::class);

    Route::get('/get_calculate', [\App\Http\Controllers\CurrencieController::class, 'ajaxCalculate'])->name('ajaxCalc');
    Route::get('/get_carrency_to', [\App\Http\Controllers\CurrencieController::class, 'ajaxGetCurrencyTo'])->name('ajaxCurTo');
    Route::get('/get_direction', [\App\Http\Controllers\ExchangeController::class, 'ajaxGetDirection'])->name('ajaxGetDirection');
    Route::post('/create_order', [\App\Http\Controllers\OrdersController::class, 'ajaxCreate'])->name('ajaxCreateOrder');
//    Route::get('/exchange-{code}', [\App\Http\Controllers\ExchangeController::class, 'showDerection']);

    Auth::routes();

    Route::middleware(['role:admin'])->prefix('/administrator')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin');
        Route::resource('pages', \App\Http\Controllers\Admin\AdminPageController::class);
        Route::resource('currency', \App\Http\Controllers\Admin\AdminCurrencieController::class);
        Route::resource('exchanges', \App\Http\Controllers\Admin\AdminExchangeController::class);
        Route::resource('banners', \App\Http\Controllers\Admin\AdminBannerController::class);
        Route::resource('orders', \App\Http\Controllers\Admin\AdminOrdersController::class);
        Route::resource('users', \App\Http\Controllers\Admin\AdminUserController::class);
        Route::get('courses', [\App\Http\Controllers\CourseController::class, 'adminList'])->name('adminCoursesList');
        Route::get('langs', [\App\Http\Controllers\Admin\AdminLanguageController::class, 'index'])->name('adminLangs');
    });

    Route::get('{code}', [\App\Http\Controllers\PageController::class, 'showPage']);

    //Route::get('/personal', [App\Http\Controllers\HomeController::class, 'index']);

});
