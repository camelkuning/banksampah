<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\PenggunaBankSampah;
use App\Models\PenggunaTransaksi;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Barryvdh\DomPDF\Facade\Pdf;

class PayController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = json_decode($request->getContent(), true);

        $orderId = $request->data_id;
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);

        $order = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('dashboard'),
                "cancel_url" => route('dashboard'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "15.00"
                    ]
                ]
            ]
        ]);

        return response()->json($order);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function capture(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $orderId = $data['orderId'];

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $token = $provider->getAccessToken();
        $provider->setAccessToken($token);
        $result = $provider->capturePaymentOrder($orderId);

        try {
            DB::beginTransaction();
            if ($result['status'] === "COMPLETED") {
                $flight = PenggunaBankSampah::find($data["bank_id"]);
                $flight->status = 'sudah';
                $flight->save();

                $log = PenggunaTransaksi::create([
                    'user_id'            => $data['user_id'],
                    'bank_id'            => $data['bank_id'],
                    'vendor_payment_id'  => $orderId,
                    'payment_gateway_id' => $result['id'],
                    'status'             => $result['status'],
                ]);

                DB::commit();
            }
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
        }

        return back()->with('status', 'Berhasil membayar!');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function invoice(Request $request)
    {
        // $data = PenggunaTransaksi::where("payment_gateway_id", $request->id)->firstOrfail();
        $data = PenggunaTransaksi::where("payment_gateway_id", $request->id)->firstOrfail();
        $bank = PenggunaBankSampah::where("id", $data->bank_id)->firstOrfail();

        $data1 = [
            'data' => $data,
            'bank' => $bank,
        ];

        $pdf = Pdf::loadView('pdf.invoice', $data1);

        return $pdf->download('invoice.pdf');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function invoicep(Request $request)
    {
        $data = PenggunaTransaksi::where("payment_gateway_id", $request->id)->firstOrfail();
        $bank = PenggunaBankSampah::where("id", $data->bank_id)->firstOrfail();

        $data1 = [
            "nama" => $data->vendor_payment_id,
        ];

        return view('pdf.invoice', [
            config(['app.title' => "Register"]),
            'data' => $data,
            'bank' => $bank,
        ]);
    }
}
