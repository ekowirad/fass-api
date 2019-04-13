<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
