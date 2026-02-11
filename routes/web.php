<?php

use App\Http\Controllers\pemasukanMasjidController;
use App\Http\Controllers\PemasukanSosialController;
use App\Http\Controllers\PengeluaranMasjidController;
use App\Http\Controllers\PengeluaranSosialController;
use App\Http\Controllers\RekapKasController;
use App\Http\Controllers\RekapKasSosialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Auth::routes(['login' => false]);

Route::get('/kasmasjid/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/kasmasjid/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// pemasukan kasmasjid
Route::get('/pemasukan-masjid', [pemasukanMasjidController::class, 'index'])
    ->name('pemasukan_masjid.index');

Route::post('/pemasukan-masjid', [pemasukanMasjidController::class, 'store'])
    ->name('pemasukan_masjid.store');

Route::put('/pemasukan-masjid/{id}', [pemasukanMasjidController::class, 'update'])
    ->name('pemasukan_masjid.update');

Route::delete('/pemasukan-masjid/{id}', [pemasukanMasjidController::class, 'destroy'])
    ->name('pemasukan_masjid.destroy');


// pengeluaran kasmasjid

Route::get('/pengeluaran-masjid', [PengeluaranMasjidController::class, 'index'])->name('pengeluaran_masjid.index');
Route::post('/pengeluaran-masjid', [PengeluaranMasjidController::class, 'store']);
Route::put('/pengeluaran-masjid/{id}', [PengeluaranMasjidController::class, 'update']);
Route::delete('/pengeluaran-masjid/{id}', [PengeluaranMasjidController::class, 'destroy']);

// rekap kas
Route::get('/rekap-kas/cetak', [RekapKasController::class, 'cetak'])->name('rekap_kas.cetak');
Route::get('/rekap-kas/export-excel', [RekapKasController::class, 'exportExcel'])->name('rekap_kas.export_excel');
Route::get('/rekap-kas', [RekapKasController::class, 'index'])->name('rekap_kas.index');

// Old routes kept for safety or can be removed if unused
Route::post('/rekap/cetak-periode', [RekapKasController::class, 'cetakPeriode'])
    ->name('rekap.cetak_periode');

Route::get('/rekap/cetak-semua', [RekapKasController::class, 'cetakSemua'])
    ->name('rekap.cetak_semua');
Route::get('/rekap/cetak-bulan', [RekapKasController::class, 'cetakPerBulan'])
    ->name('rekap.cetak_per_bulan');


// pemasukan sosial
Route::prefix('pemasukan-sosial')->group(function () {
    Route::get('/', [PemasukanSosialController::class, 'index'])->name('pemasukan_sosial.index');
    Route::get('/create', [PemasukanSosialController::class, 'create'])->name('pemasukan_sosial.create');
    Route::post('/store', [PemasukanSosialController::class, 'store'])->name('pemasukan_sosial.store');
    Route::get('/{pemasukanSosial}/edit', [PemasukanSosialController::class, 'edit'])->name('pemasukan_sosial.edit');
    Route::put('/{pemasukanSosial}', [PemasukanSosialController::class, 'update'])->name('pemasukan_sosial.update');
    Route::delete('/{pemasukanSosial}', [PemasukanSosialController::class, 'destroy'])->name('pemasukan_sosial.destroy');
});



Route::resource('pengeluaran-sosial', PengeluaranSosialController::class)->only(['index', 'store', 'update', 'destroy', 'show']);


Route::get('/rekap-kas-sosial/cetak', [RekapKasSosialController::class, 'cetak'])
    ->name('rekap_kas_sosial.cetak');

Route::get('/rekap-kas-sosial', [RekapKasSosialController::class, 'index'])
    ->name('rekap_kas_sosial.index');

Route::get('/rekap-kas-sosial/create', [RekapKasSosialController::class, 'create'])
    ->name('rekap_kas_sosial.create');

Route::post('/rekap-kas-sosial', [RekapKasSosialController::class, 'store'])
    ->name('rekap_kas_sosial.store');

Route::delete('/rekap-kas-sosial/{id}', [RekapKasSosialController::class, 'destroy'])
    ->name('rekap_kas_sosial.destroy');

// Laporan Keuangan - Public access
Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'index'])
    ->name('laporan.index');

// Informasi Masjid - Public access
Route::get('/informasi', [App\Http\Controllers\InformasiController::class, 'index'])
    ->name('informasi.index');

// Kegiatan - Public access
Route::get('/kegiatan', [App\Http\Controllers\PublicActivityController::class, 'index'])
    ->name('kegiatan.index');

// Donasi Online - Public access
Route::get('/donasi', [App\Http\Controllers\DonasiController::class, 'index'])
    ->name('donasi.index');
Route::post('/donasi', [App\Http\Controllers\DonasiController::class, 'store'])
    ->name('donasi.store');
Route::get('/donasi/konfirmasi/{id}', [App\Http\Controllers\DonasiController::class, 'konfirmasi'])
    ->name('donasi.konfirmasi');

// Admin - Donation List
Route::get('/cek-donasi', [App\Http\Controllers\DonasiController::class, 'list'])
    ->name('donasi.list')->middleware('auth');

Route::post('/cek-donasi/{id}/status', [App\Http\Controllers\DonasiController::class, 'checkStatus'])
    ->name('donasi.check_status')->middleware('auth');

// Admin - Rekap Donasi Report
Route::get('/rekap-donasi', [App\Http\Controllers\RekapDonasiController::class, 'index'])
    ->name('rekap_donasi.index')->middleware('auth');
Route::get('/rekap-donasi/cetak', [App\Http\Controllers\RekapDonasiController::class, 'cetak'])
    ->name('rekap_donasi.cetak')->middleware('auth');

// Midtrans Notification - Callback
Route::post('/payment/notification', [App\Http\Controllers\NotificationController::class, 'handle']);

// User Management - Only for Admin
Route::middleware(['auth'])->group(function () {
    Route::resource('users', UserController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    
    // Web Settings
    Route::get('/settings', [App\Http\Controllers\Admin\LandingSettingController::class, 'index'])->name('admin.settings.index');
    Route::put('/settings', [App\Http\Controllers\Admin\LandingSettingController::class, 'update'])->name('admin.settings.update');

    // Activities
    Route::resource('activities', App\Http\Controllers\Admin\ActivityController::class);
});

// Laporan Kas Unified
Route::get('/laporan-kas/export-excel', [App\Http\Controllers\LaporanKasController::class, 'exportExcel'])->name('laporan_kas.export_excel')->middleware('auth');
Route::get('/laporan-kas/cetak', [App\Http\Controllers\LaporanKasController::class, 'cetak'])->name('laporan_kas.cetak')->middleware('auth');
Route::get('/laporan-kas', [App\Http\Controllers\LaporanKasController::class, 'index'])->name('laporan_kas.index')->middleware('auth');

// Profile Management - For all authenticated users
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

// Temporary Debug Route
Route::get('/debug-storage', function () {
    $debug = [
        'APP_URL' => env('APP_URL'),
        'public_path' => public_path(),
        'storage_path' => storage_path(),
        'storage_path_public' => storage_path('app/public'),
        'public_storage_exists' => file_exists(public_path('storage')),
        'public_storage_is_link' => is_link(public_path('storage')),
        'public_storage_target' => is_link(public_path('storage')) ? readlink(public_path('storage')) : 'N/A',
        'files_in_storage_activities' => [],
    ];

    if (file_exists(storage_path('app/public/activities'))) {
        $files = scandir(storage_path('app/public/activities'));
        $debug['files_in_storage_activities'] = array_slice($files, 0, 10);
    } else {
        $debug['files_in_storage_activities'] = 'Directory not found';
    }

    // Try to write a test file
    try {
        \Illuminate\Support\Facades\Storage::disk('public')->put('debug_test.txt', 'This is a test file ' . now());
        $debug['write_test'] = 'Success, check if debug_test.txt exists in public/storage';
    } catch (\Exception $e) {
        $debug['write_test'] = 'Failed: ' . $e->getMessage();
    }

    return response()->json($debug);
});