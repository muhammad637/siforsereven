<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetPassword;

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

use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MasterUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\notifikasiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\OutletMapController;
use App\Http\Controllers\OutletController;



Route::get('/', function () {
	return redirect('/login');
})->middleware('auth');
Route::get('/home', function () {
	return redirect('/dashboard');
})->middleware('auth');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');

Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('pages/order', [OrderController::class, 'index'])->name('order');
Route::post('pages/order', [OrderController::class, 'store'])->name('store.order');
Route::get('/outlets/map', [OutletMapController::class,'index']);



Route::group(['middleware' => 'auth'], function () {

	Route::get('/pages/history', [HistoryController::class, 'index'])->name('history');
	Route::get('pages/order', [OrderController::class, 'index'])->name('order');

	// notifikasi
	Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi');
	Route::get('/notifikasi/mark', [NotifikasiController::class, 'mark'])->name('notifi.mark');

	Route::get('/our_outlets', [OutletMapController::class, 'index'])->name('outlet_map.index');
	Route::resource('outlets', OutletController::class);

	// history
	Route::post('/pages/history/bulan', [HistoryController::class, 'historyBulan'])->name('history.bulan');
	Route::post('/pages/history/barang', [HistoryController::class, 'historyBarang'])->name('history.barang');
	Route::post('/pages/history/jenis_barang', [HistoryController::class, 'historyJenisBarang'])->name('history.jenis.barang');
	Route::post('/pages/history/status', [HistoryController::class, 'historyStatus'])->name('history.status');
	Route::get('/our_outlets', [OutletMapController::class, 'index'])->name('outlet_map.index');


	

	Route::group(['middleware' => 'cekLevel:admin'], function () {

		// export
		Route::get('/pages/history/exportAll', [HistoryController::class, 'exportAll'])->name('history.exportAll');
		Route::post('/pages/history/exportBulan', [HistoryController::class, 'exportBulan'])->name('history.exportBulan');
		Route::post('/pages/history/exportBarang', [HistoryController::class, 'exportBarang'])->name('history.exportBarang');
		Route::post('/pages/history/exportJenisBarang', [HistoryController::class, 'exportJenisBarang'])->name('history.exportJenisBarang');

		Route::post('pages/order', [OrderController::class, 'store'])->name('store.order');
		Route::get('/pages/order/{order:id}', [OrderController::class, 'printout'])->name('order.print');

		Route::get('/coba', function () {
			return 'ini buat admin';
		});

		// master user
		Route::resource('/master/user', MasterUserController::class);
		Route::get('/master/user/1/edit',[MasterUserController::class,'syalal']);
		Route::get('/master/user/{user:id}/nonaktif', [MasterUserController::class, 'nonaktif'])->name('user.nonaktif');
		Route::get('/master/user/{user:id}/aktif', [MasterUserController::class, 'aktif'])->name('user.aktif');

		// barang
		Route::get('master/barang', [BarangController::class, 'index'])->name('barang');
		Route::post('master/barang', [BarangController::class, 'store'])->name('store.barang');
		

		Route::put('master/barang/{barang:id}/update', [BarangController::class, 'update'])->name('update.barang');
		Route::put('master/barang/{barang:id}/aktif', [BarangController::class, 'aktif'])->name('aktif.barang');
		Route::put('master/barang/{barang:id}/nonaktif', [BarangController::class, 'nonaktif'])->name('nonaktif.barang');


		// ruangan
		Route::get('master/ruangan', [RuanganController::class, 'index'])->name('ruangan');
		Route::post('master/ruangan', [RuanganController::class, 'store'])->name('store.ruangan');
		Route::put('master/ruangan/{ruangan:id},/aktif', [RuanganController::class, 'ruanganAktif'])->name('ruangan.aktif');
		Route::put('master/ruangan/{ruangan:id},/update', [RuanganController::class, 'update'])->name('update.ruangan');
		Route::put('master/ruangan/{ruangan:id}/nonaktif', [RuanganController::class, 'ruanganNonaktif'])->name('ruangan.nonaktif');


		Route::resource('outlets', OutletController::class);
	});

	Route::put('pages/history/{order:id}/update', [OrderController::class, 'update'])->name('update.history');
	
	Route::group(['middleware' => 'cekLevel:teknisi'], function () {
		Route::put('pages/order/{order:id}/update', [OrderController::class, 'update'])->name('update.order');
		
	});



	// Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	// Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/pages/profile', [UserProfileController::class, 'index'])->name('profile');
	Route::post('/pages/profile/{user:id}', [UserProfileController::class, 'update'])->name('profile.update');
	Route::post('/pages/profile/{user:id}/resetPassword', [UserProfileController::class, 'resetPassword'])->name('profile.resetPassword');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	// Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
	Route::post('logcek', function () {
		return auth()->user();
	})->name('logcek');
});
