<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\SambutanController;
use App\Http\Controllers\ProfilOPDController;
use App\Http\Controllers\TupoksiController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\SekretariatController;
use App\Http\Controllers\BidangPolitikController;
use App\Http\Controllers\BidangKesatuanBangsaController;
use App\Http\Controllers\ProdukHukumController;

//home
Route::get('/', function () {
    return view('umum.home');
})->name('dashboard');

//sambutan
Route::get('sambutan', [SambutanController::class, 'show'])->name('sambutan');

//profil OPD
Route::get('profilOPD', [ProfilOPDController::class, 'show'])->name('profilOPD');

//tupoksi
Route::get('tupoksi', [TupoksiController::class, 'show'])->name('tupoksi');

//struktur organisasi
Route::get('struktur-organisasi', [StrukturOrganisasiController::class, 'show'])->name('struktur-organisasi');

//sekretariat
Route::get('sekretariat', [SekretariatController::class, 'show'])->name('sekretariat');

//bidang politik
Route::get('bidang-politik', [BidangPolitikController::class, 'show'])->name('bidang-politik');

//bidang kesatuan bangsa
Route::get('bidang-kesatuan-bangsa', [BidangKesatuanBangsaController::class, 'show'])->name('bidang-kesatuan-bangsa');

//program kegiatan
Route::get('/programKegiatan', function () {
    return view('umum.program-kegiatan');
})->name('programKegiatan');

//produk hukum
Route::get('/produk-hukum', [ProdukHukumController::class, 'show'])->name('produk-hukum');
Route::get('/produk-hukum/download/{id}', [ProdukHukumController::class, 'download'])->name('produk-hukum.download');


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

Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        // Sambutan Kepala Badan Admin
        Route::get('sambutanAdmin', [SambutanController::class, 'index'])->name('admin.sambutanAdmin');
        Route::post('katasambutanAdmin', [SambutanController::class, 'store'])->name('katasambutan.store');
        Route::put('katasambutanAdmin/{id}', [SambutanController::class, 'update'])->name('katasambutan.update');
        Route::delete('katasambutanAdmin/{id}', [SambutanController::class, 'destroy'])->name('katasambutan.destroy');

        //Profil OPD Admin
        Route::get('profilOPDAdmin', [ProfilOPDController::class, 'index'])->name('admin.profilOPDAdmin');
        Route::post('profilOPDAdmin', [ProfilOPDController::class, 'store'])->name('profilOPDAdmin.store');
        Route::put('profilOPDAdmin/{id}', [ProfilOPDController::class, 'update'])->name('profilOPDAdmin.update');
        Route::delete('profilOPDAdmin/{id}', [ProfilOPDController::class, 'destroy'])->name('profilOPDAdmin.destroy');

        //Tugas Pokok & Fungsi Admin
        Route::get('tupoksiAdmin', [TupoksiController::class, 'index'])->name('admin.tupoksiAdmin');
        Route::post('tupoksiAdmin', [TupoksiController::class, 'store'])->name('tupoksiAdmin.store');
        Route::put('tupoksiAdmin/{id}', [TupoksiController::class, 'update'])->name('tupoksiAdmin.update');
        Route::delete('tupoksiAdmin/{id}', [TupoksiController::class, 'destroy'])->name('tupoksiAdmin.destroy');

        //Struktur Organisasi Admin
        Route::get('strukturOrganisasiAdmin', [StrukturOrganisasiController::class, 'index'])->name('admin.strukturOrganisasiAdmin');
        Route::post('strukturOrganisasiAdmin', [StrukturOrganisasiController::class, 'store'])->name('strukturOrganisasiAdmin.store');
        Route::put('strukturOrganisasiAdmin/{id}', [StrukturOrganisasiController::class, 'update'])->name('strukturOrganisasiAdmin.update');
        Route::delete('strukturOrganisasiAdmin/{id}', [StrukturOrganisasiController::class, 'destroy'])->name('strukturOrganisasiAdmin.destroy');

        //Sekretariat Admin
        Route::get('sekretariatAdmin', [SekretariatController::class, 'index'])->name('admin.sekretariatAdmin');
        Route::post('sekretariatAdmin', [SekretariatController::class, 'store'])->name('sekretariatAdmin.store');
        Route::put('sekretariatAdmin/{id}', [SekretariatController::class, 'update'])->name('sekretariatAdmin.update');
        Route::delete('sekretariatAdmin/{id}', [SekretariatController::class, 'destroy'])->name('sekretariatAdmin.destroy');

        //Bidang Politik Admin
        Route::get('bidangPolitikAdmin', [BidangPolitikController::class, 'index'])->name('admin.bidangPolitikAdmin');
        Route::post('bidangPolitikAdmin', [BidangPolitikController::class, 'store'])->name('bidangPolitikAdmin.store');
        Route::put('bidangPolitikAdmin/{id}', [BidangPolitikController::class, 'update'])->name('bidangPolitikAdmin.update');
        Route::delete('bidangPolitikAdmin/{id}', [BidangPolitikController::class, 'destroy'])->name('bidangPolitikAdmin.destroy');

        //Bidang Kesatuan Bangsa Admin
        Route::get('bidangKesatuanBangsaAdmin', [BidangKesatuanBangsaController::class, 'index'])->name('admin.bidangKesatuanBangsaAdmin');
        Route::post('bidangKesatuanBangsaAdmin', [BidangKesatuanBangsaController::class, 'store'])->name('bidangKesatuanBangsaAdmin.store');
        Route::put('bidangKesatuanBangsaAdmin/{id}', [BidangKesatuanBangsaController::class, 'update'])->name('bidangKesatuanBangsaAdmin.update');
        Route::delete('bidangKesatuanBangsaAdmin/{id}', [BidangKesatuanBangsaController::class, 'destroy'])->name('bidangKesatuanBangsaAdmin.destroy');

        //Produk Hukum Admin
        Route::get('produkHukumAdmin', [ProdukHukumController::class, 'index'])->name('admin.produkHukumAdmin');
        Route::post('produkHukumAdmin', [ProdukHukumController::class, 'store'])->name('admin.produkHukumAdmin.store');
        Route::put('produkHukumAdmin/{id}', [ProdukHukumController::class, 'update'])->name('admin.produkHukumAdmin.update');
        Route::delete('produkHukumAdmin/{id}', [ProdukHukumController::class, 'destroy'])->name('admin.produkHukumAdmin.destroy');
        Route::get('/produkHukumAdmin/download/{id}', [ProdukHukumController::class, 'download'])->name('admin.produkHukumAdmin.download');

    });

});