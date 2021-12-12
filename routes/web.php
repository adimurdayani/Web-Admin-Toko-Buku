<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'AuthController@index')->name('auth');

Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/user', 'UsersController');
    Route::resource('/produk', 'ProduksController');
    Route::resource('/seller', 'SellerController');
    Route::get('/costumer', 'CostumerController@index')->name('costumer');
    Route::get('/transaksi', 'TransaksiController@index')->name('transaksi');
    Route::get('/transaksi/batal/{id}', 'TransaksiController@batal')->name('transaksiBatal');
    Route::get('/transaksi/proses/{id}', 'TransaksiController@proses')->name('transaksiProses');
    Route::get('/transaksi/kirim/{id}', 'TransaksiController@kirim')->name('transaksiKirim');
    Route::get('/transaksi/selesai/{id}', 'TransaksiController@selesai')->name('transaksiSelesai');
    Route::delete('/transaksi/hapus/{id}', 'TransaksiController@hapus')->name('hapus');
    Route::get('/transaksi/detail/{id}', 'TransaksiController@detail')->name('detail');
});
