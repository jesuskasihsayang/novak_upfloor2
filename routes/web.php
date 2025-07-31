<?php

use Illuminate\Support\Facades\Route;

// CONTROLLERS UNTUK FRONTEND
use App\Http\Controllers\Home;
use App\Http\Controllers\Login;
use App\Http\Controllers\Berita;
use App\Http\Controllers\Listing;
use App\Http\Controllers\Download;
use App\Http\Controllers\Galeri;
use App\Http\Controllers\Video;
use App\Http\Controllers\Proyek;
// Note: Controller 'Aksi' dan 'Akreditasi' belum ada, kita akan buat di bawah.
use App\Http\Controllers\Aksi; 
// use App\Http\Controllers\Akreditasi; // Sementara dikomentari karena belum ada

// CONTROLLERS UNTUK BACKEND (ADMIN)
use App\Http\Controllers\Admin\Dasbor;
use App\Http\Controllers\Admin\Pemesanan;
use App\Http\Controllers\Admin\User;
use App\Http\Controllers\Admin\Konfigurasi;
use App\Http\Controllers\Admin\Berita as AdminBerita;
use App\Http\Controllers\Admin\Agenda as AdminAgenda;
use App\Http\Controllers\Admin\Rekening;
use App\Http\Controllers\Admin\Kategori;
// use App\Http\Controllers\Admin\Status_site; // Perlu dibuat jika digunakan
// use App\Http\Controllers\Admin\Status_proyek; // Perlu dibuat jika digunakan
use App\Http\Controllers\Admin\Heading;
use App\Http\Controllers\Admin\Video as AdminVideo;
use App\Http\Controllers\Admin\Kategori_download;
use App\Http\Controllers\Admin\Kategori_galeri;
use App\Http\Controllers\Admin\Kategori_staff;
use App\Http\Controllers\Admin\Kategori_property;
use App\Http\Controllers\Admin\Kategori_agenda;
// use App\Http\Controllers\Admin\Kategori_akreditasi; // Perlu dibuat jika digunakan
use App\Http\Controllers\Admin\Galeri as AdminGaleri;
use App\Http\Controllers\Admin\Staff as AdminStaff;
use App\Http\Controllers\Admin\Property as AdminProperty;
// use App\Http\Controllers\Admin\Site; // Perlu dibuat jika digunakan
use App\Http\Controllers\Admin\Proyek as AdminProyek;
// use App\Http\Controllers\Admin\Akreditasi as AdminAkreditasi; // Perlu dibuat jika digunakan
use App\Http\Controllers\Admin\Download as AdminDownload;
use App\Http\Controllers\Admin\Dataset;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// FRONT END ROUTES
Route::get('/', [Home::class, 'index']);
Route::get('home', [Home::class, 'index']);
Route::get('search/{par1}', [Home::class, 'search']);
Route::get('search2/{par1}', [Home::class, 'search_kontraktor']);
Route::get('properti/{par1}/{slug?}', [Home::class, 'properti']);
Route::get('proyek/{par1}/{slug?}', [Home::class, 'proyek']);
Route::get('agent/{par1}', [Home::class, 'agent']);
Route::get('kontak', [Home::class, 'kontak']);
Route::get('pemesanan', [Home::class, 'pemesanan']);
Route::get('konfirmasi', [Home::class, 'konfirmasi']);
Route::get('pembayaran', [Home::class, 'pembayaran']);
Route::post('proses_pemesanan', [Home::class, 'proses_pemesanan']);
Route::get('berhasil/{par1}', [Home::class, 'berhasil']);
Route::get('cetak/{par1}', [Home::class, 'cetak']);
Route::get('about', [Home::class, 'about']);
Route::get('about_project', [Home::class, 'about_project']);
Route::get('aksi', [Aksi::class, 'index']);
Route::get('aksi/status/{par1}', [Aksi::class, 'status']);

Route::get('listing/location', [Listing::class, 'location']);

// Login
Route::get('login', [Login::class, 'index'])->name('login');
Route::post('login/check', [Login::class, 'check']);
Route::get('login/lupa', [Login::class, 'lupa']);
Route::get('login/logout', [Login::class, 'logout']);

// Berita
Route::get('berita', [Berita::class, 'index']);
Route::get('berita/read/{par1}', [Berita::class, 'read']);
Route::get('berita/layanan/{par1}', [Berita::class, 'layanan']);
Route::get('berita/terjadi/{par1}', [Berita::class, 'terjadi']);
Route::get('berita/kategori/{par1}', [Berita::class, 'kategori']);

// Download
Route::get('download', [Download::class, 'index']);
Route::get('download/unduh/{par1}', [Download::class, 'unduh']);
Route::get('download/kategori/{par1}', [Download::class, 'kategori']);
Route::get('dokumen', [Download::class, 'index']);
Route::get('dokumen/unduh/{par1}', [Download::class, 'unduh']);
Route::get('dokumen/detail/{par1}/{par2}', [Download::class, 'detail']);
Route::get('download/detail/{par1}/{par2}', [Download::class, 'detail']);

// Galeri & Video
Route::get('galeri', [Galeri::class, 'index']);
Route::get('galeri/detail/{par1}', [Galeri::class, 'detail']);
Route::get('video', [Video::class, 'index']);
Route::get('video/detail/{par1}', [Video::class, 'detail']);
Route::get('webinar', [Video::class, 'index']);
Route::get('webinar/detail/{par1}/{par2}', [Video::class, 'detail']);

// Proyek
Route::get('proyek', [Proyek::class, 'index']);
Route::get('proyek/kategori/{par1}', [Proyek::class, 'kategori']);
Route::get('proyek/detail/{par1}', [Proyek::class, 'detail']);
Route::get('proyek/cetak/{par1}', [Proyek::class, 'cetak']);


// ADMIN ROUTES (disatukan dalam grup agar lebih rapi)
Route::prefix('admin')->group(function () {
    Route::get('/dasbor', [Dasbor::class, 'index']);
    Route::get('/dasbor/konfigurasi', [Dasbor::class, 'konfigurasi']);
    
    // User
    Route::resource('user', User::class); // Menggunakan resource controller untuk CRUD standar

    // Konfigurasi
    Route::prefix('konfigurasi')->group(function() {
        Route::get('/', [Konfigurasi::class, 'index']);
        Route::get('/logo', [Konfigurasi::class, 'logo']);
        Route::get('/profil', [Konfigurasi::class, 'profil']);
        Route::get('/profil_kontraktor', [Konfigurasi::class, 'profil_kontraktor']);
        Route::get('/icon', [Konfigurasi::class, 'icon']);
        Route::get('/email', [Konfigurasi::class, 'email']);
        Route::get('/gambar', [Konfigurasi::class, 'gambar']);
        Route::get('/pembayaran', [Konfigurasi::class, 'pembayaran']);
        Route::post('/proses', [Konfigurasi::class, 'proses']);
        Route::post('/proses_logo', [Konfigurasi::class, 'proses_logo']);
        Route::post('/proses_icon', [Konfigurasi::class, 'proses_icon']);
        Route::post('/proses_email', [Konfigurasi::class, 'proses_email']);
        Route::post('/proses_gambar', [Konfigurasi::class, 'proses_gambar']);
        Route::post('/proses_pembayaran', [Konfigurasi::class, 'proses_pembayaran']);
        Route::post('/proses_profil', [Konfigurasi::class, 'proses_profil']);
        Route::post('/proses_profil_kontraktor', [Konfigurasi::class, 'proses_profil_kontraktor']);
    });

    // Berita, Agenda, Galeri, Dll.
    Route::resource('berita', AdminBerita::class);
    Route::resource('agenda', AdminAgenda::class);
    Route::resource('rekening', Rekening::class);
    Route::resource('kategori', Kategori::class);
    Route::resource('heading', Heading::class);
    Route::resource('video', AdminVideo::class);
    Route::resource('kategori_download', Kategori_download::class);
    Route::resource('kategori_galeri', Kategori_galeri::class);
    Route::resource('kategori_staff', Kategori_staff::class);
    Route::resource('kategori_property', Kategori_property::class);
    Route::resource('kategori_agenda', Kategori_agenda::class);
    Route::resource('galeri', AdminGaleri::class);
    Route::resource('staff', AdminStaff::class);
    Route::resource('property', AdminProperty::class);
    Route::resource('proyek', AdminProyek::class);
    Route::resource('download', AdminDownload::class);
    
    // Dataset
    Route::get('dataset/kabupaten/{provinsiId}', [Dataset::class, 'kabupaten']);
    Route::get('dataset/kecamatan/{kabupatenId}', [Dataset::class, 'kecamatan']);
});