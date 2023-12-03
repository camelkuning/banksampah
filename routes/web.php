<?php

use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Client\MainController;
use App\Http\Controllers\Client\PenggunaController;
use App\Http\Controllers\BankSampahController;
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

        Route::any('logout', 'destroy');
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

                //tes

            });
        });

        Route::group([
            'prefix'     => '/banksampah',
            'as'         => 'banksampah.',
            // 'middleware' => ['banksampah']
        ], function () {
            Route::controller(BankSampahController::class)->group(function () {
                Route::get('petugas', 'petugas')->name('petugas');
                Route::post('petugas', 'petugas')->name('postPetugas');

                Route::get('penerimaan', 'penerimaan')->name('penerimaan');
                Route::post('penerimaan', 'penerimaan')->name('penerimaan');

            });
        });

    });
});
