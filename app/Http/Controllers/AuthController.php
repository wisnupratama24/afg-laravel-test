<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(),[
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                "message" => "failed",
                "errors" => $validator->errors(),
            ], 400);       
        }

        $user = User::where('email', $request->email)->first();
        if(empty($user)) {
             return response()->json([
                'status' => 400,
                "message" => "email not registered",
            ], 400);  
        }

        $password = $request->password;

        if(Hash::check($password,$user->password)) {
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => 200,
                'message' => 'success',
                'access_token' => $token
            ], 200);

        } else {
            return response()->json([
                "status" => 400,
                "message" => "Password not match",
            ], 400);  
        }
    }
}
