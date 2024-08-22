<?php
use App\Http\Controllers\LaporanPenjualanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', 'HomeController@index')->name('home');
//User
Route:: resource('/user','userController' );
Route:: get('/user/hapus/{id}' , 'userController@destroy' );
//menu
Route::resource('/menu','menuController')->middleware('role:user');;
Route::get('/menu/hapus/{id}','menuController@destroy');
//pelanggan
Route::resource('/pelanggan','pelangganController')->middleware('role:user');
Route::get('/pelanggan/hapus/{id}','pelangganController@destroy');
//akun
Route::resource('/akun','AkunController')->middleware('role:user');;
Route::get('/akun/edit/{id}','AkunController@edit');
Route::get('/akun/hapus/{id}','AkunController@destroy');
//setting
Route::get('/setting','SettingController@index')->name('setting.transaksi')->middleware('role:user');
Route::get('/setting','SettingController@index')->name('setting.transaksi')->middleware('role:user');
Route::post('/setting/simpan','SettingController@simpan');
//Pemesanan
Route::get('/transaksi', 'PemesananController@index')->name('pemesanan.transaksi');
Route::post('/sem/store', 'PemesananController@store');
Route::get('/transaksi/hapus/{kd_brg}','PemesananController@destroy');
//Detail Pesan
Route::post('/detail/store', 'DetailPesanController@store');
Route::post('/detail/simpan', 'DetailPesanController@simpan');
//Penjualan
Route::get('/penjualan', 'PenjualanController@index')->name('penjualan.transaksi');
Route::get('/daftar-penjualan', 'PenjualanController@invoice')->name('penjualan.invoice');
Route::get('/penjualan-jual/{id}', 'PenjualanController@edit');
Route::post('/penjualan/simpan', 'PenjualanController@simpan');
//Cetak Nota
Route::get('/laporan/faktur/{invoice}', 'PenjualanController@pdf')->name('cetak.order_pdf');
//Laporan
Route::resource( '/laporan' , 'LaporanController');
//laporan cetak
Route::get('/laporancetak/cetak_pdf', 'LaporanController@cetak_pdf');
//laporan Penjualan
Route::resource( '/laporan' , 'LaporanController');

Route::resource('metodepembayaran', MetodePembayaranController::class);

Route::get('/laporanpenjualan', [LaporanPenjualanController::class, 'index'])->name('laporan.penjualan');

Route::get('/laporanpenjualancetak', [LaporanPenjualanController::class, 'generatePDF'])->name('laporan.penjualancetak');



