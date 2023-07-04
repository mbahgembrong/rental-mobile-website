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

    Route::get('/car', [App\Http\Controllers\Landing\CarController::class, 'index'])->name('landing.car');
    Route::get('/service', [App\Http\Controllers\Landing\ServiceController::class, 'index'])->name('landing.service');
    Route::get('/contact', [App\Http\Controllers\Landing\ContactController::class, 'index'])->name('landing.contact');
});
Route::prefix('/pelanggan')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\PelangganLoginController::class, 'showLoginForm'])->name('landing.pelanggan.showLogin');
    Route::post('/login', [App\Http\Controllers\Auth\PelangganLoginController::class, 'login']);
    Route::get('/register', [App\Http\Controllers\Auth\PelangganRegisterController::class, 'showRegistrationForm']);
    Route::post('/register', [App\Http\Controllers\Auth\PelangganRegisterController::class, 'register']);
    Route::post('/logout', [App\Http\Controllers\Auth\PelangganLoginController::class, 'logout']);
    Route::middleware('auth:pelanggan')->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('pelanggan.home');
        Route::resource('rentals', App\Http\Controllers\RentalController::class, [
            // 'only' => ['index', 'create', 'store', 'show', 'destroy'],
            'names' => [
                'index' => 'pelangan.rentals.index',
                'create' => 'pelanggan.rentals.create',
                'store' => 'pelanggan.rentals.store',
                'show' => 'pelanggan.rentals.show',
                'destroy' => 'pelanggan.rentals.destroy',
            ]
        ]);
        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('pelanggan.profile');
        Route::post('/profile/update_foto', [App\Http\Controllers\ProfileController::class, 'updateFoto'])->name('pelanggan.profile.update_foto');
        Route::get('/profile/edit/{id}', [App\Http\Controllers\ProfileController::class, 'edit'])->name('pelanggan.profile.edit');
        Route::patch('/profile/update/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->name('pelanggan.profile.update');
    });
});

Route::prefix('rental')->group(function () {
    Route::get('bayar/{id}', [App\Http\Controllers\RentalController::class, 'bayar'])->name('rentals.bayar');
    Route::get('struk/{id}', [App\Http\Controllers\RentalController::class, 'struk'])->name('rentals.struk');
    Route::post('bayar/{id}', [App\Http\Controllers\RentalController::class, 'pembayaran'])->name('rentals.pembayaran');
    Route::post('validasi/{id}', [App\Http\Controllers\RentalController::class, 'validasi'])->name('rentals.validasi');
    Route::post('ulasan/{id}', [App\Http\Controllers\RentalController::class, 'ulasan'])->name('rentals.ulasan');
    Route::post('status', [App\Http\Controllers\RentalController::class, 'status'])->name('rentals.status');
    Route::get('cekKetersedianMobil', [App\Http\Controllers\RentalController::class, 'cekKetersediaanMobil'])->name('rentals.cekKetersediaanMobil');
    Route::get('cekKetersedianSopir', [App\Http\Controllers\RentalController::class, 'cekKetersediaanSopir'])->name('rentals.cekKetersediaanSopir');
});
Route::prefix('mobil')->group(function () {
    Route::get('/{idKategori}', [App\Http\Controllers\MobilController::class, 'getMobil'])->name('mobils.getmobil');
});


Auth::routes();

Route::prefix('/admin')->group(function () {
    Route::middleware('auth:web')->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::prefix('pelanggans')->group(function () {
            Route::post('/store_api', [App\Http\Controllers\PelangganController::class, 'store_api'])->name('pelanggans.store_api');
        });
        Route::resource('pelanggans', App\Http\Controllers\PelangganController::class);
        Route::resource('roles', App\Http\Controllers\RoleController::class);
        Route::resource('sopirs', App\Http\Controllers\SopirController::class);
        Route::resource('kategoriMobils', App\Http\Controllers\KategoriMobilController::class);
        Route::resource('mobils', App\Http\Controllers\MobilController::class);

        Route::resource('detailMobils', App\Http\Controllers\DetailMobilController::class);
        Route::resource('rentals', App\Http\Controllers\RentalController::class);

        Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'index'])->name('laporan');

    });
});