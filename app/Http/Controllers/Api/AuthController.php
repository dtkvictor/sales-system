<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends ApiController
{
    public function login(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255|exists:users,email',
            'password' => 'required|min:8|max:255'
        ]);
    
        if($validator->fails()) {
            return response()->json([
                "data" => [
                    "errors" => $validator->errors()
                ]
            ], 422);
        }
    
        $credentials = $request->only(['email', 'password']);
        $remember = $request->has('remember') ? true : false;
    
        if(!Auth::attempt($credentials, $remember)) {
            return $this->response('Invalid credentials please review and try again.', 401);
        }

        $user = Auth::user();
        return $this->response('Authorized', 200, [
            'accessToken' => $user->createToken('accessToken')->plainTextToken
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->response('Logged out successfully', 200);
    }

}
