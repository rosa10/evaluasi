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

//laporan
Route::get('/cetak/{kategori}', 'CetakController@index');
Route::get('/cetak/cetak_pdf', 'CetakController@cetak_pdf');

Route::resource('/kategori', 'KategoriController')->except('show','index','create','store');
Route::resource('/soal', 'SoalController');
Route::resource('/pilihan', 'PilihanController');

// evaluasi mahasiswa
Route::get('/jawaban','JawabanController@home');
Route::post('/jawaban/index','JawabanController@index');
Route::post('/jawaban/store','JawabanController@store');

//excel
// Route::get('/user/export_excel', 'Admin\UsersController@export_excel');
Route::post('/user/import_excel', 'Admin\UsersController@import_excel');