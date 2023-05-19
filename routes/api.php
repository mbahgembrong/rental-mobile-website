<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('users', \UserAPIController::class);

Route::resource('pelanggans', \PelangganAPIController::class);

Route::resource('roles', \RoleAPIController::class);

Route::resource('sopirs', \SopirAPIController::class);

Route::resource('kategori_mobils', \KategoriMobilAPIController::class);

Route::resource('mobils', \MobilAPIController::class);

Route::resource('detail_mobils', \DetailMobilAPIController::class);

Route::resource('rentals', \RentalAPIController::class);
