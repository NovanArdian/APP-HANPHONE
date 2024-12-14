<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;

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
route::middleware(['IsLogout'])->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('login');
    Route::post('/login', [UserController::class, 'loginProses'])->name('login.proses');
});


Route::middleware(['IsLogin'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    // Route::httpMethod('/path', [NamaController::class, 'namaFunc'])->name('identitas_route');
// httpMethod 
    Route::get('/landing-page', [LandingPageController::class, 'index'])->name('landing_page');



    route::middleware(['isAdmin'])->group(function () {
        Route::prefix('/order')->name('order.')->group(function () {
            Route::get('/data', [OrderController::class, 'data'])->name('data');
        });

        


        //untuk mengelola data obat
        Route::prefix('/data-handphone')->name('data_hp.')->group(function () {
            Route::get('/data', [PhoneController::class, 'index'])->name('data');
            Route::get('/tambah', [PhoneController::class, 'create'])->name('tambah');
            Route::post('/tambah/proses', [PhoneController::class, 'store'])->name('tambah.proses');
            Route::get('/ubah/{id}', [PhoneController::class, 'edit'])->name('ubah');
            Route::patch('ubah/{id}proses', [PhoneController::class, 'update'])->name('ubah.proses');
            Route::delete('/hapus/{id}', [PhoneController::class, 'destroy'])->name('hapus');
            Route::patch('/ubah/stock/{id}', [PhoneController::class, 'updateStock'])->name('ubah.stock');

        });


        //untuk mengelola kelola akun
        Route::prefix('kelola-akun')->name('kelola_akun.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('data');   // Display all users
            Route::get('/tambah', [UserController::class, 'create'])->name('tambah');  // Show create form
            Route::post('/tambah/proses', [UserController::class, 'store'])->name('tambah.proses');  // Process creation
            Route::get('/ubah/{id}', [UserController::class, 'edit'])->name('ubah');   // Show edit form
            Route::patch('/ubah/{id}/proses', [UserController::class, 'update'])->name('ubah.proses');  // Process update
            Route::delete('/hapus/{id}', [UserController::class, 'destroy'])->name('hapus');  // Process deletion
        });

        Route::get('/order/admin', [OrderController::class, 'indexadmin'])->name('order.admin');
        Route::get('/order/export/excel', [OrderController::class, 'exportExcel'])->name('order.export');
    });
});

Route::middleware(['isKasir'])->group(function () {
    Route::prefix('/kasir')->name('kasir.')->group(function () {
        Route::get('/order', [OrderController::class, 'index'])->name('order'); 
        Route::get('/create', [OrderController::class, 'create'])->name('order.create');
        Route::post('/store', [OrderController::class, 'store'])->name('order.store');
        Route::get('/print/{id}', [OrderController::class, 'show'])->name('order.print');
        Route::get('/download-pdf/{id}', [OrderController::class, 'downloadPDF'])->name('download');
    });
});





// get -> mengambil data/menampilkan halaman
// post -> mengirim data ke database (tambah data) 
// patch/put -> mengubah data di database
// delete -> menghapus data

