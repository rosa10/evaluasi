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

// Route::get('/cetak/cetak_pdf/{kategori}', 'CetakController@cetak_pdf');

//chart
Route::get('/chart', 'ChartController@index');
Route::get('/chart2', 'ChartController@chart');
Route::get('/chart-data/{kategori}', 'ChartController@chartData');
Route::get('/layanan/{layanan}/kategori', 'ChartController@getKategori');

Route::resource('/kategori', 'KategoriController')->except('show', 'index', 'create', 'store');
Route::resource('/soal', 'SoalController');
Route::resource('/pilihan', 'PilihanController');

// evaluasi mahasiswa
Route::get('/jawaban', 'JawabanController@home');
Route::get('/jawaban/index/{kategori}', 'JawabanController@index');
Route::post('/jawaban/store/{kategori}', 'JawabanController@store');

//excel
Route::get('/user/export_excel', 'Admin\UsersController@export_excel');
Route::post('/user/import_excel', 'Admin\UsersController@import_excel');

//status
Route::get('/status', 'ChartController@status');
Route::get('/hasil', 'ChartController@hasil');
Route::get('/pdf', 'ChartController@pdf');
