<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    
    public function login(Request $request)
    {
        
        $this->validate($request, [
            $this->username() => ['required', 'string', 'max:255'],
            'password' => ['required', 'min:3', 'string']
        ]);
        // $credentials = $request->only('email', 'password');

        // if ($this->guard()->attempt($credentials)) {
        //     return response()->json([ 'status' => 'success'], 200);
        // } 

        // return response()->json(['status' => 'login_error'], 401);
        
        // cek apakah ada user dengan email dan password yang di input
        if(!Auth::attempt([
            // email bisa ganti dengan username, sesuaikan dengan keperluan
            'email'     => $request->email,
            "password"  => $request->password,
        ])) {
            return response()->json([
                "error" => "unauthorized"
            ], 401);
        }

        // kalau user ada, cari data usernya
        $user = User::find(Auth::user()->id);
        return response()->json([
            "data"  => $user
        ], 200);
    }

    public function username()
    {
        return 'email';
    }


    public function guard()
    {
        return Auth::guard();
    }

    //
}
