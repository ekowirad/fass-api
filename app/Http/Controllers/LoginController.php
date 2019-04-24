<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Resources\User as UserResource;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            $this->username() => ['required', 'string', 'max:255'],
            'password' => ['required', 'min:3', 'string']
        ]);
        

        $credential = $request->only($this->username($request), 'password');
        
        if (!$this->guard()->attempt($credential)) {
            return response()->json([
                "error" => "unauthorized"
            ], 401);
        }

        $user = $this->guard()->user();
        $user->generateToken();

        $response = new UserResource($user);        
        return response()->json($response, 200);

    }

    public function username()
    {
        // request() is laravel helpers method to get current request
        $login = request()->input('login');
        // determine request input is email or username
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        // add data to request object with validate field and request value before by merging
        request()->merge([$field => $login]);
        return $field;
    }

    public function logout()
    {
        //get current authenticated user in api guard by passing their token
        $user = Auth::guard('api')->user();
        
        if ($user) {
            //give token null for forbiden access to current user
            $user->api_token = null;
            $user->save();
            return response()->json(['message' => 'user logout'], 200);
            // logout
            $this->logout();
        }
    }

    public function guard()
    {
        return Auth::guard();
    }

    //
}
