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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('admin/user', 'Admin\UsersController');
// Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
//     Route::resource('/admin/users', 'UsersController');
// });

//layanan
Route::get('/layanan/create-kategori/{layanan}', 'KategoriController@create');
Route::post('/layanan/create-kategori/{layanan}', 'KategoriController@store');
Route::resource('/layanan', 'LayananController')->except('show');



// Route::resource('/kategori', 'KategoriController');
Route::resource('/soal', 'SoalController');
Route::resource('/pilihan', 'PilihanController');