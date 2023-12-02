<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BankSampahController extends Controller
{
    public function petugas()
    {
        return view('clients.banksampah.petugas', [
            config(['app.title' => "Petugas"])
           // 'datas' => PenggunaBankSampah::where('UserID', Auth::user()->id)->paginate(15),
        ]);
    }
    public function penerimaan()
    {
        return view('clients.banksampah.penerimaan', [
            config(['app.title' => "penerimaan"])
           // 'datas' => PenggunaBankSampah::where('UserID', Auth::user()->id)->paginate(15),
        ]);
    }
}
