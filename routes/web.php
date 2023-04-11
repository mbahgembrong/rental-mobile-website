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

Route::prefix('/')->group(function () {
    Route::get('/', [App\Http\Controllers\Landing\IndexController::class, 'index'])->name('landing.index');
    Route::get('/about', [App\Http\Controllers\Landing\AboutController::class, 'index'])->name('landing.about');
    Route::get('/blog', [App\Http\Controllers\Landing\BlogController::class, 'index'])->name('landing.blog');
    Route::get('/car', [App\Http\Controllers\Landing\CarController::class, 'index'])->name('landing.car');
    Route::get('/service', [App\Http\Controllers\Landing\ServiceController::class, 'index'])->name('landing.service');
    Route::get('/contact', [App\Http\Controllers\Landing\ContactController::class, 'index'])->name('landing.contact');
});


Auth::routes();
Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::resource('users', App\Http\Controllers\UserController::class);

    Route::resource('pelanggans', App\Http\Controllers\PelangganController::class);

    Route::resource('roles', App\Http\Controllers\RoleController::class);

    Route::resource('sopirs', App\Http\Controllers\SopirController::class);

    Route::resource('kategoriMobils', App\Http\Controllers\KategoriMobilController::class);

    Route::resource('mobils', App\Http\Controllers\MobilController::class);
    Route::prefix('mobil')->group(function () {
        Route::get('getMobil/', [App\Http\Controllers\MobilController::class, 'getMobil'])->name('mobils.getmobil');
    });
    Route::resource('detailMobils', App\Http\Controllers\DetailMobilController::class);

    Route::resource('rentals', App\Http\Controllers\RentalController::class);
    Route::prefix('rental')->group(function () {
        Route::get('bayar/{id}', [App\Http\Controllers\RentalController::class, 'bayar'])->name('rentals.bayar');
        Route::post('bayar/{id}', [App\Http\Controllers\RentalController::class, 'pembayaran'])->name('rentals.pembayaran');
        Route::post('status', [App\Http\Controllers\RentalController::class, 'status'])->name('rentals.status');
        Route::get('cekKetersedianMobil', [App\Http\Controllers\RentalController::class, 'cekKetersediaanMobil'])->name('rentals.cekKetersediaanMobil');
        Route::get('cekKetersedianSopir', [App\Http\Controllers\RentalController::class, 'cekKetersediaanSopir'])->name('rentals.cekKetersediaanSopir');
    });
});