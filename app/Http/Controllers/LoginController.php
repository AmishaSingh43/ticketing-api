<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;

class LoginController extends Controller
{
    public function check(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials))
        {
            $user = Auth::user();
            $token = $user->createToken('token')->plainTextToken;
            return response()->json(['status' => 200,
                                     'message' => 'Successfully login',
                                     'user' => $user,
                                     'token' => $token
            ], 200);
        }else{
           return response()->json(['status' => 422, 'message' => 'Failed to login'], 422);
        }  
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
    }

    public function show($id)
    {
        $user = User::find($id);
        if($user){
            return response()->json([
                'status' => 200,
                'user' => $user,
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "User not found with this ID",
            ], 404);
        }
    }
}
