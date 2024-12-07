<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

// Tambah untuk DomPDF (rute cetak menggunakan GET)
Route::get('kategori/cetak', [CategoryController::class, 'generateReport'])->name('kategori.cetak');
Route::get('kategori/report', [CategoryController::class, 'generateReport'])->name('kategori.report');
// Menggunakan resource controller untuk 'kategori', kecuali rute 'show'
Route::resource('kategori', CategoryController::class)->except(['show']);

Route::get('/categories/report', [CategoryController::class, 'generateReport'])->name('categories.report');


// Halaman utama
Route::get('/', function () {
    return view('welcome');
});