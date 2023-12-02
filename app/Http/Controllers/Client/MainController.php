<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        switch (strtolower(Auth::user()->role)) {
            case "banksampah":
                return view('clients.banksampah.index', [
                    config(['app.title' => "Bank Sampah"]),
                ]);

            default:
                return view('clients.pengguna.index', [
                    config(['app.title' => "Pengguna"]),
                ]);
        }
    }
}
