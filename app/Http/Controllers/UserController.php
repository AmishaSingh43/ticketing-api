<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->get();
        return response()->json(['status' => 200, 'users' => $users]); 
    }   

    public function create(Request $request)
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
                'can_assign_ticket' => $request->can_assign_ticket,
                'can_change_status' => $request->can_change_status,
                'is_staff_free' => $request->is_staff_free,
            ]);
        }
        if($user){
            return response()->json([
                'status' => 200,
                'message' => "User created successfully",
            ], 200);
        }else{
            return response()->json([
                'status' => 500,
                'message' => "Something went wrong",
            ], 500);
        }
        
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

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|max:13|min:10',
            'role' => 'required',
            'password' => 'required|min:6',

         ]);
 
        if ($validator->fails())
        {
             return response()->json([
                 'status' => 422,
                 'errors' => $validator->errors(),
             ], 422);
 
        }else {
           $user = User::find($id);
           if($user) {
              $user->name = $request->input('name');
              $user->email = $request->input('email');
              $user->phone = $request->input('phone');
              $user->address = $request->input('address');
              $user->role = $request->input('role');
              $user->expertise = $request->input('expertise');
              $user->can_assign_ticket = $request->input('can_assign_ticket');
              $user->can_change_status = $request->input('can_change_status');
              $user->is_staff_free = $request->input('is_staff_free');
              $user->update();

              return response()->json([
                'status' => 200,
                'message' => 'User updated successfully',
              ], 200);
            }
            else{
                return response()->json([
                    'status' => 404,
                    'message' => "User not found with this ID",
                ], 404);
            }
        }
    }

    public function staffs()
    {
        $staffUsers = User::where('role', 'staff')->orderBy('id', 'DESC')->get();
        return response()->json(['status' => 200, 'staffs' => $staffUsers]); 
    }   
}
