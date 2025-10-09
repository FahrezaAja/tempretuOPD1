<?php

use Illuminate\Support\Facades\Route;

//home
Route::get('/', function () {
    return view('umum.home');
})->name('dashboard');

//sambutan
Route::get('/sambutan', function () {
    return view('umum.sambutan');
})->name('sambutan');

//profil OPD
Route::get('/profilOPD', function () {
    return view('umum.profilOPD');
})->name('profilOPD');

//tupoksi
Route::get('/tupoksi', function () {
    return view('umum.tupoksi');
})->name('tupoksi');

//struktur organisasi
Route::get('/strukturOrganisasi', function () {
    return view('umum.struktur-organisasi');
})->name('strukturOrganisasi');

//sekretariat
Route::get('/sekretariat', function () {
    return view('umum.sekretariat');
})->name('sekretariat');

//bidang politik
Route::get('/bidangPolitik', function () {
    return view('umum.bidang-politik');
})->name('bidangPolitik');

//bidang kesatuan bangsa
Route::get('/bidangKesatuanBangsa', function () {
    return view('umum.bidang-kesatuan-bangsa');
})->name('bidangKesatuanBangsa');

//program kegiatan
Route::get('/programKegiatan', function () {
    return view('umum.program-kegiatan');
})->name('programKegiatan');

//galeri
Route::get('/galeri', function () {
    return view('umum.galeri');
})->name('galeri');

//kontak
Route::get('/kontak', function () {
    return view('umum.kontak');
})->name('kontak');

//berita
Route::get('berita-terbaru', function () {
    return view('umum.berita-terbaru');
})->name('berita-terbaru');

//kategori
Route::get('/kategori', function () {
    return view('umum.kategori');
})->name('kategori');

Route::get('/navbar', function () {
    return view('partials.navbar');
})->name('navbar');

Route::get('/address', function () {
    return 'Address Book Page';
})->name('address');

Route::get('/components', function () {
    return 'Components Page';
})->name('components');

Route::get('/calendar', function () {
    return 'Calendar Page';
})->name('calendar');

Route::get('/charts', function () {
    return 'Charts Page';
})->name('charts');

Route::get('/documents', function () {
    return 'Documents Page';
})->name('documents');
