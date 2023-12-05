<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    protected $user;

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index', [
            config(['app.title' => "Profile"]),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email'    => 'required|string|lowercase|email|max:255',
            'alamat'   => 'required|string',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                return back()->withErrors([
                    'message' => $message,
                ]);
            }
        }

        $user = User::find(Auth::user()->id);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->save();

        return back()->with([
            'message' => 'Data berhasil diubah!',
        ]);
    }

}
