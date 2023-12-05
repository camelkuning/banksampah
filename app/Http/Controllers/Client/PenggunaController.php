<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\PenggunaBankSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function buangsampah()
    {
        return view('clients.pengguna.buangsampah', [
            config(['app.title' => "Buang Sampah"]),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postbuangsampah(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'BeratSampah' => 'required',
            'JenisSampah' => 'required',
            'lokasi'      => 'required',
            'jam'         => 'required',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                return back()->withErrors([
                    'message' => $message,
                ])->onlyInput();
            }
        }

        $data = PenggunaBankSampah::create([
            'UserID'            => Auth::user()->id,
            'berat_sampah'      => $request->BeratSampah,
            'jenis_sampah'      => $request->JenisSampah,
            'lokasi_pembuangan' => $request->lokasi,
            'jam'               => $request->jam,
        ]);

        return redirect()->route('pengguna.transaksi.show', ['id' => $data->id]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function transaksi()
    {
        return view('clients.pengguna.transaksi', [
            config(['app.title' => "Transaksi"]),
            'datas' => PenggunaBankSampah::where('UserID', Auth::user()->id)->paginate(15),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = PenggunaBankSampah::with('transaksi')->where('id', $request->id)->firstOrFail();


        if ($data->UserID !== Auth::user()->id) {
            return redirect()->route('dashboard');
        }

        return view('clients.pengguna.show', [
            config(['app.title' => "Transaksi"]),
            'data' => $data,
        ]);
    }
}
