<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\ApiKey;

class ApiKeyController extends Controller
{
    public function register(Request $request){
        $name = $request->name;

        if(!empty($name)) {

            $key = Hash::make($name.Str::random(40));
            $apiKey = ApiKey::create([
                'name' => $name,
                'key' => $key
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'api key created',
                'data' => [
                    'key' => $key
                ]
            ],200);

        } else {

            return response()->json([
                'status' => 400,
                'message' => "Nama tidak boleh kosong"
            ], 400);

        }
    }
}
