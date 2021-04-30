<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function checkLogin(Request $request)
    {
        # Diberikan max password length supaya hash tdk terlalu lambat
        #  apabila ada yang iseng password diisi panjang.
        $requestData = $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required|max:16',
        ]);

        if (!Auth::attempt($requestData)) {
            return \redirect()->route('auth.login')->with("err", "Incorrect username/password!");
        }

        return \redirect()->route('admin.barang');
    }
}
