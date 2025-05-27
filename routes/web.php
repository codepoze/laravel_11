<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AkunController;
use App\Http\Controllers\Admin\SatuanController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\KendaraanController;
use App\Http\Controllers\Admin\MetodeController;
use App\Http\Controllers\Admin\PendaftaranController;
use App\Http\Controllers\Admin\AntreanController;
use App\Http\Controllers\Admin\DisplayController;
use App\Http\Controllers\Admin\PendaftaranProdukController;
use App\Http\Controllers\Admin\TPendaftaranProdukController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest', 'prevent.back.history')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('auth.login');

    Route::post('/check', [AuthController::class, 'check'])->name('auth.check');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware('auth.session', 'prevent.back.history')->prefix('admin')->as('admin.')->group(function () {
    Route::controller(DashboardController::class)->prefix('dashboard')->as('dashboard.')->group(function () {
        Route::get('/', 'index')->name('index');
    });

    // begin:: akun
    Route::controller(AkunController::class)->prefix('akun')->as('akun.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/save_picture', 'save_picture')->name('save_picture');
        Route::post('/save_account', 'save_account')->name('save_account');
        Route::post('/save_security', 'save_security')->name('save_security');
    });
    // end:: akun

    // begin:: satuan
    Route::controller(SatuanController::class)->prefix('satuan')->as('satuan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/list', 'list')->name('list');
        Route::post('/show', 'show')->name('show');
        Route::post('/save', 'save')->name('save');
        Route::post('/del', 'del')->name('del');
    });
    // end:: satuan

    // begin:: produk
    Route::controller(ProdukController::class)->prefix('produk')->as('produk.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/list', 'list')->name('list');
        Route::post('/show', 'show')->name('show');
        Route::post('/save', 'save')->name('save');
        Route::post('/del', 'del')->name('del');
    });
    // end:: produk

    // begin:: kendaraan
    Route::controller(KendaraanController::class)->prefix('kendaraan')->as('kendaraan.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/list', 'list')->name('list');
        Route::get('/all', 'all')->name('all');
        Route::post('/show', 'show')->name('show');
        Route::post('/save', 'save')->name('save');
        Route::post('/del', 'del')->name('del');
    });
    // end:: kendaraan

    // begin:: metode
    Route::controller(MetodeController::class)->prefix('metode')->as('metode.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/list', 'list')->name('list');
        Route::get('/all', 'all')->name('all');
        Route::post('/show', 'show')->name('show');
        Route::post('/save', 'save')->name('save');
        Route::post('/del', 'del')->name('del');
        Route::post('/aktif', 'aktif')->name('aktif');
    });
    // end:: metode

    // begin:: pendaftaran
    Route::controller(PendaftaranController::class)->prefix('pendaftaran')->as('pendaftaran.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::get('/print/{id}', 'print')->name('print');
        Route::get('/create', 'create')->name('create');
        Route::get('/list', 'list')->name('list');
        Route::post('/save', 'save')->name('save');
        Route::post('/approved', 'approved')->name('approved');
    });
    // end:: pendaftaran

    // begin:: antrean
    Route::controller(AntreanController::class)->prefix('antrean')->as('antrean.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/list', 'list')->name('list');
        Route::post('/memanggil', 'memanggil')->name('memanggil');
    });
    // end:: antrean

    // begin:: display
    Route::controller(DisplayController::class)->prefix('display')->as('display.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/list', 'list')->name('list');
    });
    // end:: display

    // begin:: pendaftaran_produk
    Route::controller(PendaftaranProdukController::class)->prefix('pendaftaran_produk')->as('pendaftaran_produk.')->group(function () {
        Route::get('/list/{id}', 'list')->name('list');
    });
    // end:: pendaftaran_produk

    // begin:: t_pendaftaran_produk
    Route::controller(TPendaftaranProdukController::class)->prefix('t_pendaftaran_produk')->as('t_pendaftaran_produk.')->group(function () {
        Route::get('/list', 'list')->name('list');
        Route::post('/show', 'show')->name('show');
        Route::post('/save', 'save')->name('save');
        Route::post('/del', 'del')->name('del');
    });
    // end:: t_pendaftaran_produk
});
