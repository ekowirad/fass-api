<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\User as UserResource;
use App\User;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:100'],
            'username' => ['required', 'string', 'unique:users'],
            'phone' => ['required', 'string', 'max:12'],
            'address' => ['required','string'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
       ]);

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            return new UserResource($user);
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($user->save()) {
            return new UserResource($user);
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if ($user->delete()) {
            return new UserResource($user);
        }
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    public function index()
    {
        // search for list of user where id doesn't equals to user login
        $user = User::where('id', '!=', auth()->id())->orderBy('created_at', 'desc')->paginate(5);
        return UserResource::collection($user);
    }
}
