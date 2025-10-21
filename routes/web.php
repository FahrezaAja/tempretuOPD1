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
use App\Http\Controllers\ProgramKegiatanController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriVideoController;
use App\Http\Controllers\GaleriFotoController;
use App\Http\Controllers\GaleriUmumController;
use App\Http\Controllers\SampulController;
use App\Http\Controllers\HomeController;


//home
Route::get('/', [HomeController::class, 'index'])->name('home');


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
Route::get('program-kegiatan', [ProgramKegiatanController::class, 'show'])->name('program-kegiatan');
Route::get('/program-kegiatan/download/{id}', [ProgramKegiatanController::class, 'download'])->name('program-kegiatan.download');

//produk hukum
Route::get('/produk-hukum', [ProdukHukumController::class, 'show'])->name('produk-hukum');
Route::get('/produk-hukum/download/{id}', [ProdukHukumController::class, 'download'])->name('produk-hukum.download');

//galeri
Route::get('/galeri', [GaleriUmumController::class, 'index'])->name('galeri');

//kontak
Route::get('/kontak', [KontakController::class, 'show'])->name('kontak');

//berita
Route::get('/berita-terbaru', [BeritaController::class, 'show'])->name('berita-terbaru');

//kategori
Route::get('/kategori', [KategoriController::class, 'show'])->name('kategori');

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

        //program kegiatan Admin
        Route::get('programKegiatanAdmin', [ProgramKegiatanController::class, 'index'])->name('admin.programKegiatanAdmin');
        Route::post('programKegiatanAdmin', [ProgramKegiatanController::class, 'store'])->name('admin.programKegiatanAdmin.store');
        Route::put('programKegiatanAdmin/{id}', [ProgramKegiatanController::class, 'update'])->name('admin.programKegiatanAdmin.update');
        Route::delete('programKegiatanAdmin/{id}', [ProgramKegiatanController::class, 'destroy'])->name('admin.programKegiatanAdmin.destroy');
        Route::get('/programKegiatanAdmin/download/{id}', [ProgramKegiatanController::class, 'download'])->name('admin.programKegiatanAdmin.download');

        //kontak admin
        Route::get('kontakAdmin', [KontakController::class, 'index'])->name('admin.kontakAdmin');
        Route::post('kontakAdmin', [KontakController::class, 'store'])->name('admin.kontakAdmin.store');
        Route::put('kontakAdmin/{id}', [KontakController::class, 'update'])->name('admin.kontakAdmin.update');
        Route::delete('kontakAdmin/{id}', [KontakController::class, 'destroy'])->name('admin.kontakAdmin.destroy');

        //kategori admin
        Route::get('/kategoriAdmin', [KategoriController::class, 'index'])->name('admin.kategoriAdmin');
        Route::post('/kategoriAdmin', [KategoriController::class, 'store'])->name('kategoriAdmin.store');
        Route::put('/kategoriAdmin/{id}', [KategoriController::class, 'update'])->name('kategoriAdmin.update');
        Route::delete('/kategoriAdmin/{id}', [KategoriController::class, 'destroy'])->name('kategoriAdmin.destroy');

        //berita admin
        Route::get('/beritaAdmin', [BeritaController::class, 'index'])->name('admin.beritaAdmin');
        Route::post('/beritaAdmin', [BeritaController::class, 'store'])->name('beritaAdmin.store');
        Route::put('/beritaAdmin/{id}', [BeritaController::class, 'update'])->name('beritaAdmin.update');
        Route::delete('/beritaAdmin/{id}', [BeritaController::class, 'destroy'])->name('beritaAdmin.destroy');

        //galeri video admin
        Route::match(['get', 'post'], 'videos', [GaleriVideoController::class, 'index'])->name('admin.galeriVideoAdmin');
        Route::delete('videos/{video}', [GaleriVideoController::class, 'destroy'])->name('galeriVideoAdmin.destroy');
    });

    //galeri foto admin
    Route::get('galeri/foto', [GaleriFotoController::class, 'index'])->name('admin.galeriFotoAdmin');
    Route::post('galeri/foto', [GaleriFotoController::class, 'store'])->name('admin.galeriFotoAdmin.store');
    Route::put('galeri/foto/{id}', [GaleriFotoController::class, 'update'])->name('admin.galeriFotoAdmin.update');
    Route::delete('galeri/foto/{id}', [GaleriFotoController::class, 'destroy'])->name('admin.galeriFotoAdmin.destroy');

    //sampul admin
    Route::get('/sampulAdmin', [SampulController::class, 'index'])->name('admin.sampulAdmin');
    Route::post('/sampulAdmin', [SampulController::class, 'store'])->name('admin.sampulAdmin.store');
    Route::put('/sampulAdmin/{id}', [SampulController::class, 'update'])->name('admin.sampulAdmin.update');
    Route::delete('/sampulAdmin/{id}', [SampulController::class, 'destroy'])->name('admin.sampulAdmin.destroy');

});