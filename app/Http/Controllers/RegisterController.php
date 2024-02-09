<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|max:13|min:10',
            'role' => 'required',
            'expertise' => 'required',
            'password' => 'required|min:6',
         ]);
 
         if ($validator->fails())
         {
             return response()->json([
                 'status' => 422,
                 'errors' => $validator->errors(),
             ], 422);
 
         }else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => $request->role,
                'expertise' => $request->expertise,
                'password' => Hash::make($request->password),
            ]);
         }
 
         if($user){
             return response()->json([
                 'status' => 200,
                 'message' => "Registration success",
             ], 200);
         }else{
             return response()->json([
                 'status' => 500,
                 'message' => "Something went wrong",
             ], 500);
         }
    }
}
