<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Langganan;
use App\Models\PenggunaBankSampah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Exception;

class PenggunaController extends Controller
{
    protected $provider;
    protected $token;

    public function __construct()
    {
        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials(config('paypal'));
        $this->token = $this->provider->getAccessToken();
        $this->provider->setAccessToken($this->token);
    }

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

        if ($request->BeratSampah > 5) {
            if (Auth::user()->LanggananExpire->isPast()) {
                return back()->withErrors([
                    'error' => 'Tidak bisa buang sampah lebih dari 5kg. Berlangganan cepat!'
                ]);
            }
        }

        $data = PenggunaBankSampah::create([
            'UserID'            => Auth::user()->id,
            'berat_sampah'      => $request->BeratSampah,
            'jenis_sampah'      => $request->JenisSampah,
            'lokasi_pembuangan' => $request->lokasi,
            'jam'               => $request->jam,
        ]);

        return redirect()->route('pengguna.transaksi.show', ['id' => $data->id])->with([
            'status' => 'Order berhasil! Menunggu Petugas untuk menerima order.',
        ]);
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function langganan(Request $request)
    {
        if (Auth::user()->LanggananExpire->isPast()) {
            $data = Langganan::all();
        } else {
            $data = Langganan::where('id', Auth::user()->LanggananType)->first();
        }

        return view('clients.pengguna.langganan', [
            config(['app.title' => "Langganan"]),
            'datas' => $data,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function showLangganan(Request $request)
    {
        $data = Langganan::where('id', $request->id)->first();

        return view('clients.pengguna.langganan-show', [
            config(['app.title' => "Langganan"]),
            'data' => $data,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function langganan_create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'langganan_id' => 'required',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                return back()->withErrors([
                    'message' => $message,
                ])->onlyInput();
            }
        }

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('pengguna.langganan.capture', ['langganan_id' => $request->langganan_id]),
                "cancel_url" => route('dashboard'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "100.00"
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('pengguna.langganan')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('pengguna.langganan')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function langganan_capture(Request $request)
    {
        // dd($request->langganan_id);

        $response = $this->provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $d = Langganan::where('id', $request->langganan_id)->first();

            $user = User::find(Auth::user()->id);
            $user->LanggananType = $d->id;
            $user->LanggananExpire = \Carbon\Carbon::now()->addDays(30);
            $user->save();

            return redirect()
                ->route('pengguna.langganan')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('pengguna.langganan')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}
