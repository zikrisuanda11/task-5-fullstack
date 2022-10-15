<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validate = Validator::make($request->only('email', 'password'), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if(!$validate->errors())
        {
            return response()->json(['errors'], 401);
        }
        $credential = $request->only('email', 'password');
        if(!Auth::attempt($credential))
        {
            return response()->json([
                'message' => 'unauthorized'
            ]);
        }
        $user = Auth::user();
        $token = $user->createToken('accessToken')->accessToken;

        return response()->json([
            'message' => 'success login',
            'data' => $user,
            'token' => $token
        ]);
    }

    public function register(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('accessToken')->accessToken;

        return response()->json([
            'message' => 'success register user',
            'data' => $user,
            'token' => $token
        ]);
    }
}
