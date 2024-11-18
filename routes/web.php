<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class, 'home'])->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// kategori
Route::get('/kategori_brg',[HomeController::class, 'kategori_brg'])->name('kategori_brg');
Route::get('/tb_kategori',[HomeController::class, 'tb_kategori'])->name('tb_kategori');
Route::post('/kategori_brg/submit',[HomeController::class, 'submitKategori'])->name('kategori.submit');


Route::get('/data-brg',[HomeController::class, 'data_brg'])->name('data_brg');
Route::get('/data-brg/tambah-barang',[HomeController::class, 'tb_barang'])->name('tb_barang');


Route::get('/stok-brg',[HomeController::class, 'stok_brg'])->name('stok_brg');
Route::get('/stok-brg/tambah-stok',[HomeController::class, 'tb_stok'])->name('tb_stok');


Route::get('/penjualan',[HomeController::class, 'penjualan'])->name('penjualan');

Route::get('/laporan-pb',[HomeController::class, 'laporan_pb'])->name('laporan_pb');
