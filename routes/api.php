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


Route::resource('users', App\Http\Controllers\API\UserAPIController::class);

Route::resource('pelanggans', App\Http\Controllers\API\PelangganAPIController::class);

Route::resource('roles', App\Http\Controllers\API\RoleAPIController::class);

Route::resource('sopirs', App\Http\Controllers\API\SopirAPIController::class);

Route::resource('kategori_mobils', App\Http\Controllers\API\KategoriMobilAPIController::class);