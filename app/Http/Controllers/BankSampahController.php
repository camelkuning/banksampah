<?php

namespace App\Http\Controllers;

use App\Models\BanksampahTransaksi;
use App\Models\PenggunaBankSampah;
use App\Models\PenggunaTransaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankSampahController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function petugas()
    {
        return view('clients.banksampah.petugas', [
            config(['app.title' => "Petugas"])
            // 'datas' => PenggunaBankSampah::where('UserID', Auth::user()->id)->paginate(15),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function penerimaan(Request $request)
    {
        return view('clients.banksampah.penerimaan', [
            config(['app.title' => "Penerimaan"]),
            'datas' => PenggunaBankSampah::where('status_terima', 0)->paginate(15),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = PenggunaBankSampah::with('user')->where('id', $request->id)->firstOrFail();

        return view('clients.banksampah.show', [
            config(['app.title' => "Penerimaan"]),
            'data' => $data,
            'user' => $data->user,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $data = PenggunaBankSampah::with('user')->where('id', $request->id)->firstOrFail();
        $data->status_terima = 1;
        $data->save();

        $transaksi = BanksampahTransaksi::create([
            'transaksi_id' => $data->id,
            'UserID'       => Auth::user()->id,
        ]);

        // return back()->with('status', 'Berhasil di terima!, Menunggu user untuk membayar.');

        return redirect()->route('banksampah.histori')->with([
            'status' => 'Berhasil di terima!, Menunggu user untuk membayar.',
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function histori(Request $request)
    {
        // $user = User::where('id', Auth::user()->id)->firstOrFail();
        // $user->histori = BanksampahTransaksi::with('transaksi')->where('UserID', $user->id)->get();

        $data = BanksampahTransaksi::with('transaksi')->where('UserID', Auth::user()->id)->get();

        return view('clients.banksampah.histori', [
            config(['app.title' => "Penerimaan"]),
            'datas' => $data,
        ]);
    }
}
