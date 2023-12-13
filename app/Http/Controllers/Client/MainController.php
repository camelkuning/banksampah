<?php

namespace App\Http\Controllers\Client;

use App\Charts\PenggunaBankSampahChart;
use App\Http\Controllers\Controller;
use App\Models\BankSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function dashboard(PenggunaBankSampahChart $chart)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $banksampah = BankSampah::all();

        switch (strtolower(Auth::user()->role)) {
            case "banksampah":

                return view('clients.banksampah.index', [
                    config(['app.title' => "Bank Sampah"]),
                    'banksampah' => $banksampah,
                ]);

            default:
                return view('clients.pengguna.index', [
                    config(['app.title' => "Pengguna"]),
                    'banksampah' => $banksampah,
                    'chart'      => $chart->build(),
                ]);
        }
    }
}
