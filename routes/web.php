<?php
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GeneralJournalController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\UtangController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\SuperBookController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\LabaRugiController;
use App\Http\Controllers\PerubahanModalController;
use App\Http\Controllers\LaporanNeracaController;
use App\Http\Controllers\NeracaController;

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
Route::resource('buku-besar', SuperBookController::class)->middleware('auth');
Route::resource('buku-besar.accounts', AccountController::class)->scoped([
    'account' => 'nama_akun',
])->middleware('auth');
Route::resource('neraca_saldo',NeracaController::class)->middleware('auth');
Route::resource('neraca_laporan',LaporanNeracaController::class)->middleware('auth');

Route::resource('laba-rugi', LabaRugiController::class)->middleware('auth');
Route::resource('perubahan-modal', PerubahanModalController::class)->middleware('auth');

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
