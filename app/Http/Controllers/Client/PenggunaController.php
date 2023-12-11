<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Langganan;
use App\Models\PenggunaBankSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Exception;

class PenggunaController extends Controller
{
    protected $provider;

    public function __construct()
    {
        $this->provider = new PayPalClient;
        $this->provider->setApiCredentials(config('paypal'));
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
        $data = Langganan::all();

        return view('clients.pengguna.langganan', [
            config(['app.title' => "Langganan"]),
            'datas' => $data,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function postLangganan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'langganan' => 'required',
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
        // $provider->setAccessToken($token);

        // $response = $provider->createOrder([
        //     "intent" => "CAPTURE",
        //     "application_context" => [
        //         "return_url"   => route('pengguna.langganan.success'),
        //         "cancel_url"   => route('dashboard'),
        //         "langganan_id" => $request->langganan,
        //     ],
        //     "purchase_units" => [
        //         0 => [
        //             "amount" => [
        //                 "currency_code" => "USD",
        //                 "value" => "100.00"
        //             ]
        //         ]
        //     ]
        // ]);

        $data = json_decode('{
            "plan_id": "P-5ML4271244454362WXNWU5NQ",
            "start_time": "2018-11-01T00:00:00Z",
            "quantity": "20",
            "shipping_amount": {
              "currency_code": "USD",
              "value": "10.00"
            },
            "subscriber": {
              "name": {
                "given_name": "John",
                "surname": "Doe"
              },
              "email_address": "customer@example.com",
              "shipping_address": {
                "name": {
                  "full_name": "John Doe"
                },
                "address": {
                  "address_line_1": "2211 N First Street",
                  "address_line_2": "Building 17",
                  "admin_area_2": "San Jose",
                  "admin_area_1": "CA",
                  "postal_code": "95131",
                  "country_code": "US"
                }
              }
            },
            "application_context": {
              "brand_name": "walmart",
              "locale": "en-US",
              "shipping_preference": "SET_PROVIDED_ADDRESS",
              "user_action": "SUBSCRIBE_NOW",
              "payment_method": {
                "payer_selected": "PAYPAL",
                "payee_preferred": "IMMEDIATE_PAYMENT_REQUIRED"
              },
              "return_url": "https://example.com/returnUrl",
              "cancel_url": "https://example.com/cancelUrl"
            }
          }', true);

        $response = $provider->createSubscription($data);

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
    public function langganan_success(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $token = $this->provider->getAccessToken();
        $this->provider->setAccessToken($token);
        $response = $this->provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            // try {
            //     DB::beginTransaction();
            //     if ($response['status'] == 'COMPLETED') {
            //         DB::commit();
            //     }
            // } catch (Exception $e) {
            //     DB::rollBack();
            //     dd($e);
            // }

            dd($data);

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
