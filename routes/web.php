<?php
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DebtController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\UtangController;
use App\Http\Controllers\CapitalController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\GeneralJournalController;
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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');
Route::get('home', 'App\Http\Controllers\HomeController@index')->middleware('auth');


Route::resource('jurnal-umum', GeneralJournalController::class)->middleware('auth');
Route::resource('asset', AssetController::class)->middleware('auth');
Route::resource('utang', DebtController::class)->middleware('auth');
Route::resource('modal', CapitalController::class)->middleware('auth');
Route::resource('transaksi', TransactionController::class)->middleware('auth');
Route::get('buku-besar', 'App\Http\Controllers\HomeController@buku_besar')->middleware('auth');
Route::get('neraca_awal','App\Http\Controllers\NeracaController@index');
Route::get('neraca_saldo','App\Http\Controllers\NeracaController@NeracaSaldo');

Route::get('/login', 'App\Http\Controllers\LoginController@index')->name('login')->middleware('guest');
Route::post('/login', 'App\Http\Controllers\LoginController@authenticate');
Route::post('/logout', 'App\Http\Controllers\LoginController@logout');
Route::get('/logout', 'App\Http\Controllers\LoginController@logout');

Route::get('/register', 'App\Http\Controllers\RegisterController@index')->middleware('guest');
Route::post('/register', 'App\Http\Controllers\RegisterController@store');
// 404 for undefined routes
Route::any('/{page?}',function(){
    return View::make('404');
})->where('page','.*');

Route::get('/cetakpdf','App\Http\Controllers\NeracaController@printpdf')->name('cetakpdf');