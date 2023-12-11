<?php

use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\MainController;
use App\Http\Controllers\Client\PenggunaController;
use App\Http\Controllers\BankSampahController;
use App\Http\Controllers\Client\ProfileController;
use Illuminate\Support\Facades\Route;

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



Route::get('/', function () {
    return view('clients.landingpage.landinghome');
});

Route::group([
    'prefix' => '/',
], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('register', 'register')->name('register');
        Route::post('register', 'postRegister');

        Route::get('login', 'login')->name('login');
        Route::post('login', 'postLogin');

        Route::any('logout', 'destroy')->name('logout');
    });

    Route::group([
        'prefix'     => '/profile',
        'as'         => 'profile.',
        'middleware' => ['auth']
    ], function () {
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('/update-username', 'update_username')->name('update.username');
            Route::post('/update-email', 'update_email')->name('update.email');
            Route::post('/update-password', 'update_password')->name('update.password');
            Route::post('/update-alamat', 'update_alamat')->name('update.alamat');

            Route::post('/update', 'update')->name('update');
        });
    });

    Route::group([
        'prefix' => '/dashboard',
    ], function () {
        Route::controller(MainController::class)->group(function () {
            Route::get('/', 'dashboard')->name('dashboard');
        });

        Route::group([
            'prefix'     => '/pengguna',
            'as'         => 'pengguna.',
            'middleware' => ['pengguna']
        ], function () {
            Route::controller(PenggunaController::class)->group(function () {
                Route::get('buangsampah', 'buangsampah')->name('buangsampah');
                Route::post('buangsampah', 'postbuangsampah')->name('postBuangSampah');

                Route::get('transaksi', 'transaksi')->name('transaksi');
                Route::get('transaksi/{id}', 'show')->name('transaksi.show');

                Route::get('langganan', 'langganan')->name('langganan');
                Route::post('langganan', 'postLangganan')->name('langganan.post');
                Route::get('langganan-success', 'langganan_success')->name('langganan.success');
            });
        });

        Route::group([
            'prefix'     => '/banksampah',
            'as'         => 'banksampah.',
            // 'middleware' => ['banksampah']
        ], function () {
            Route::controller(BankSampahController::class)->group(function () {
                Route::get('petugas', 'petugas')->name('petugas');
                Route::post('petugas', 'petugas');

                Route::get('penerimaan', 'penerimaan')->name('penerimaan');
                Route::get('penerimaan/{id}', 'show')->name('penerimaan.show');
                Route::post('penerimaan', 'add')->name('penerimaan.add');

                Route::get('histori', 'histori')->name('histori');
            });
        });

    });
});
