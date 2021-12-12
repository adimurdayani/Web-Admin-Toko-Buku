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

Route::post('login', 'Api\UserController@Login');
Route::post('register', 'Api\UserController@register');
Route::get('produk', 'Api\ProdukController@index');
Route::post('checkout', 'Api\TransaksiController@store');
Route::get('produk/{kategori}', 'Api\ProdukController@index');
Route::get('produk/kategori_terbaru/{kategori}', 'Api\ProdukController@terbaru');
Route::get('produk/kategori_terlaris/{kategori}', 'Api\ProdukController@terlaris');
Route::get('checkout/user/{id}', 'Api\TransaksiController@history');
Route::post('checkout/batal/{id}', 'Api\TransaksiController@batal');
Route::post('checkout/upload/{id}', 'Api\TransaksiController@upload');
Route::get('user/{id}', 'Api\UserController@index');
Route::post('user/ubahpassword/{id}', 'Api\UserController@ubahpassword');
Route::post('user/ubahprofile/{id}', 'Api\UserController@ubahprofil');
