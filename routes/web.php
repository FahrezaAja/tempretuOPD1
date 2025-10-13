<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BidangKesatuanBangsaController;
use App\Http\Controllers\BidangPolitikController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleriFotoController;
use App\Http\Controllers\GaleriOPDController;
use App\Http\Controllers\GaleriVideoController;
use App\Http\Controllers\KatasambutanController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\ProdukHukumController;
use App\Http\Controllers\ProfilbadanController;
use App\Http\Controllers\ProgramKegiatanController;
use App\Http\Controllers\SampulController;
use App\Http\Controllers\SekretariatController;
use App\Http\Controllers\StrukturOrganisasiController;
use App\Http\Controllers\TupoksiController;

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

//Produk Hukum
Route::get('/produkHukum', function () {
    return view('umum.produk-hukum');
})->name('produkHukum');

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

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        //sampul
        Route::get('sampulAdmin', [SampulController::class, 'index'])->name('admin.sampulAdmin');
        Route::post('sampulAdmin', [SampulController::class, 'store'])->name('sampul.store');
        Route::put('sampulAdmin/{id}', [SampulController::class, 'update'])->name('sampul.update');
        Route::delete('sampulAdmin/{id}', [SampulController::class, 'destroy'])->name('sampul.destroy');

        //sambutan kepala bagian (admin)
        Route::get('sambutanAdmin', [KatasambutanController::class, 'index'])->name('admin.sambutanAdmin');
        Route::post('katasambutanAdmin', [KatasambutanController::class, 'store'])->name('katasambutan.store');
        Route::put('katasambutanAdmin/{id}', [KatasambutanController::class, 'update'])->name('katasambutan.update');
        Route::delete('katasambutanAdmin/{id}', [KatasambutanController::class, 'destroy'])->name('katasambutan.destroy');

        //Profile Badan (Admin)
        Route::get('profil-badanAdmin', [ProfilbadanController::class, 'index'])->name('admin.profil-badanAdmin');
        Route::post('profil-badanAdmin', [ProfilbadanController::class, 'store'])->name('profil-badanAdmin.store');
        Route::put('profil-badanAdmin/{id}', [ProfilbadanController::class, 'update'])->name('profil-badanAdmin.update');
        Route::delete('profil-badanAdmin/{id}', [ProfilbadanController::class, 'destroy'])->name('profil-badanAdmin.destroy');

        //Berita (Admin)
        Route::get('beritaAdmin', [BeritaController::class, 'index'])->name('admin.beritaAdmin');
        Route::post('beritaAdmin', [BeritaController::class, 'store'])->name('beritaAdmin.store');
        Route::put('beritaAdmin/{id}', [BeritaController::class, 'update'])->name('beritaAdmin.update');
        Route::delete('beritaAdmin/{id}', [BeritaController::class, 'destroy'])->name('beritaAdmin.destroy');

        //Galeri Video (Admin)
        Route::get('galeri/video', [GaleriVideoController::class, 'index'])->name('admin.galeri-VideoAdmin');
        Route::post('galeri/video', [GaleriVideoController::class, 'store'])->name('admin.galeri-VideoAdmin.store');
        Route::delete('galeri/video/{id}', [GaleriVideoController::class, 'destroy'])->name('admin.galeri-VideoAdmin.destroy');

        Route::get('galeri/foto', [GaleriFotoController::class, 'index'])->name('admin.galeri-FotoAdmin');
        Route::post('galeri/foto', [GaleriFotoController::class, 'store'])->name('admin.galeri-FotoAdmin.store');
        Route::put('galeri/foto/{id}', [GaleriFotoController::class, 'update'])->name('admin.galeri-FotoAdmin.update');
        Route::delete('galeri/foto/{id}', [GaleriFotoController::class, 'destroy'])->name('admin.galeri-FotoAdmin.destroy');

        //tupoksi
        Route::get('tupoksiAdmin', [TupoksiController::class, 'index'])->name('admin.tupoksiAdmin');
        Route::post('tupoksiAdmin', [TupoksiController::class, 'store'])->name('tupoksiAdmin.store');
        Route::put('tupoksiAdmin/{id}', [TupoksiController::class, 'update'])->name('tupoksiAdmin.update');
        Route::delete('tupoksiAdmin/{id}', [TupoksiController::class, 'destroy'])->name('tupoksiAdmin.destroy');

        //struktur organisasi
        Route::get('strukturOrganisasiAdmin', [StrukturOrganisasiController::class, 'index'])->name('admin.strukturOrganisasiAdmin');
        Route::post('strukturOrganisasiAdmin', [StrukturOrganisasiController::class, 'store'])->name('strukturOrganisasiAdmin.store');
        Route::put('strukturOrganisasiAdmin/{id}', [StrukturOrganisasiController::class, 'update'])->name('strukturOrganisasiAdmin.update');
        Route::delete('strukturOrganisasiAdmin/{id}', [StrukturOrganisasiController::class, 'destroy'])->name('strukturOrganisasiAdmin.destroy');

        //sekretariat
        Route::get('sekretariatAdmin', [SekretariatController::class, 'index'])->name('admin.sekretariatAdmin');
        Route::post('sekretariatAdmin', [SekretariatController::class, 'store'])->name('sekretariatAdmin.store');
        Route::put('sekretariatAdmin/{id}', [SekretariatController::class, 'update'])->name('sekretariatAdmin.update');
        Route::delete('sekretariatAdmin/{id}', [SekretariatController::class, 'destroy'])->name('sekretariatAdmin.destroy');

        //bidang politik
        Route::get('bidangPolitikAdmin', [BidangPolitikController::class, 'index'])->name('admin.bidangPolitikAdmin');
        Route::post('bidangPolitikAdmin', [BidangPolitikController::class, 'store'])->name('bidangPolitikAdmin.store');
        Route::put('bidangPolitikAdmin/{id}', [BidangPolitikController::class, 'update'])->name('bidangPolitikAdmin.update');
        Route::delete('bidangPolitikAdmin/{id}', [BidangPolitikController::class, 'destroy'])->name('bidangPolitikAdmin.destroy');

        //bidang kesatuan bangsa
        Route::get('bidangKesatuanAdmin', [BidangKesatuanBangsaController::class, 'index'])->name('admin.bidangKesatuanAdmin');
        Route::post('bidangKesatuanAdmin', [BidangKesatuanBangsaController::class, 'store'])->name('bidangKesatuanAdmin.store');
        Route::put('bidangKesatuanAdmin/{id}', [BidangKesatuanBangsaController::class, 'update'])->name('bidangKesatuanAdmin.update');
        Route::delete('bidangKesatuanAdmin/{id}', [BidangKesatuanBangsaController::class, 'destroy'])->name('bidangKesatuanAdmin.destroy');

        //program kegiatan
        Route::get('program-kegiatan', [ProgramKegiatanController::class, 'index'])->name('admin.programKegiatan-AdminOPD');
        Route::post('program-kegiatan', [ProgramKegiatanController::class, 'store'])->name('admin.programKegiatan-AdminOPD.store');
        Route::put('program-kegiatan/{id}', [ProgramKegiatanController::class, 'update'])->name('admin.programKegiatan-AdminOPD.update');
        Route::delete('program-kegiatan/{id}', [ProgramKegiatanController::class, 'destroy'])->name('admin.programKegiatan-AdminOPD.destroy');
        Route::get('/program-kegiatan/download/{id}', [ProgramKegiatanController::class, 'download'])->name('admin.programKegiatan.download');


        // Produk Hukum
        Route::get('produk-hukum', [ProdukHukumController::class, 'index'])->name('admin.produkHukum-AdminOPD');
        Route::post('produk-hukum', [ProdukHukumController::class, 'store'])->name('admin.produkHukum-AdminOPD.store');
        Route::put('produk-hukum/{id}', [ProdukHukumController::class, 'update'])->name('admin.produkHukum-AdminOPD.update');
        Route::delete('produk-hukum/{id}', [ProdukHukumController::class, 'destroy'])->name('admin.produkHukum-AdminOPD.destroy');
        Route::get('/produk-hukum/download/{id}', [ProdukHukumController::class, 'download'])->name('admin.produkHukum.download');

        //kontak
        Route::get('kontakOPD-Admin', [KontakController::class, 'index'])->name('admin.kontakOPD-Admin');
        Route::post('kontakOPD-Admin', [KontakController::class, 'store'])->name('kontakOPD-Admin.store');
        Route::put('kontakOPD-Admin/{id}', [KontakController::class, 'update'])->name('kontakOPD-Admin.update');
        Route::delete('kontakOPD-Admin/{id}', [KontakController::class, 'destroy'])->name('kontakOPD-Admin.destroy');
    });

});