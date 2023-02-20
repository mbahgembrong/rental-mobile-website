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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('users', App\Http\Controllers\UserController::class);

Route::resource('pelanggans', App\Http\Controllers\PelangganController::class);

Route::resource('roles', App\Http\Controllers\RoleController::class);

Route::resource('sopirs', App\Http\Controllers\SopirController::class);

Route::resource('kategoriMobils', App\Http\Controllers\KategoriMobilController::class);

Route::resource('mobils', App\Http\Controllers\MobilController::class);

Route::resource('detailMobils', App\Http\Controllers\DetailMobilController::class);

Route::resource('rentals', App\Http\Controllers\RentalController::class);