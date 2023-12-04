<?php

use App\Http\Controllers\Client\PayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(PayController::class)->group(function () {
    Route::group([
        'prefix'     => '/pay',
        'as'         => 'pay.',
    ], function () {
        Route::any('create', 'create')->name('create');
        Route::any('capture', 'capture')->name('capture');

        Route::get('invoice/{id}', 'invoice')->name('invoice');
        // Route::get('invoice1/{id}', 'invoicep')->name('invoicep');
    });
});
