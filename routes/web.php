<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\HistoriController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\VerifikasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/get-chart-data', [HomeController::class, 'getChartData'])->name('get.chart.data');
Route::get('pengaduan', [PengaduanController::class, 'index'])->name('pengaduan');
Route::post('pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::post('pengaduan/komentar/{id}', [KomentarController::class, 'store'])->name('pengaduan.komentar');
Route::post('pengaduan/{id}/like', [PengaduanController::class, 'like'])->name('pengaduan.like');
Route::get('artikel', [HomeController::class, 'indexBerita'])->name('all.berita');
Route::get('artikel/{id}', [HomeController::class, 'detailBerita'])->name('detail.berita');
Route::get('pemasukans', [HomeController::class, 'indexPemasukan'])->name('all.pemasukan');
Route::get('pengeluarans', [HomeController::class, 'indexPengeluaran'])->name('all.pengeluaran');
Route::get('pengeluarans/{id}', [HomeController::class, 'detailPengeluaran'])->name('detail.pengeluaran');
Route::get('laporan-akhir', [HomeController::class, 'indexLaporanAkhir'])->name('all.lap.akhir');
Route::get('/show-map/{latitude}/{longitude}', [MapController::class, 'showMap'])->name('show.map');

// for guest
Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

// for authenticated user
Route::group(['middleware' => 'auth'], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    // cuma admin yang bisa
    Route::middleware(['can:admin'])->group(function () {
        Route::resource('berita', BeritaController::class);
        Route::get('verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi.index');

        Route::post('verifikasi/pemasukan', [VerifikasiController::class, 'pemasukanStore'])->name('pemasukan.store');
        Route::post('verifikasi/pengeluaran', [VerifikasiController::class, 'pengeluaranStore'])->name('pengeluaran.store');

        Route::get('pemasukan', [PemasukanController::class, 'index'])->name('pemasukan.index');
        Route::get('pemasukan/{id}', [PemasukanController::class, 'show'])->name('pemasukan.show');

        Route::get('pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
        Route::get('pengeluaran/{id}', [PengeluaranController::class, 'show'])->name('pengeluaran.show');
        Route::get('pengeluaran/{id}/edit', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
        Route::put('pengeluaran/{id}', [PengeluaranController::class, 'updateGambar'])->name('pengeluaran.update');
        Route::get('pengeluaran/{id}/laporan-akhir', [PengeluaranController::class, 'laporanAkhir'])->name('pengeluaran.laporan.akhir.update');

        // histori
        Route::get('histori', [HistoriController::class, 'index'])->name('histori.index');
        Route::get('histori/{id}', [HistoriController::class, 'show'])->name('histori.show');
        Route::get('histori/{id}/edit', [HistoriController::class, 'edit'])->name('histori.edit');
        Route::put('histori/{id}', [HistoriController::class, 'updateGambar'])->name('histori.update');
        Route::get('histori/{id}/laporan-akhir', [HistoriController::class, 'laporanAkhir'])->name('histori.laporan.akhir.update');
    });

    // cuma keuchik yang bisa
    Route::middleware(['can:keuchik'])->group(function () {
        Route::get('keuchik/verifikasi', [VerifikasiController::class, 'indexKeuchik'])->name('verifikasi.keuchik.index');
        Route::get('keuchik/verifikasi/pemasukan/{id}', [VerifikasiController::class, 'showPemasukan'])->name('keuchik.pemasukan.show');
        Route::get('keuchik/verifikasi/pengeluaran/{id}', [VerifikasiController::class, 'showPengeluaran'])->name('keuchik.pengeluaran.show');

        Route::put('keuchik/verifikasi/pemasukan/{id}', [VerifikasiController::class, 'updatePemasukan'])->name('keuchik.pemasukan.update');
        Route::put('keuchik/verifikasi/pengeluaran/{id}', [VerifikasiController::class, 'updatePengeluaran'])->name('keuchik.pengeluaran.update');

        // pengaduan
        Route::get('keuchik/pengaduan', [PengaduanController::class, 'indexKeuchik'])->name('pengaduan.keuchik.index');
        Route::get('keuchik/pengaduan/{id}', [PengaduanController::class, 'showKeuchik'])->name('pengaduan.keuchik.show');
        // Route::put('keuchik/pengaduan/{id}', [PengaduanController::class, 'updateKeuchik'])->name('pengaduan.keuchik.update');
    });
});
