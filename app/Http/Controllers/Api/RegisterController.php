<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class RegisterController extends Controller
{

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [

            "name" => "required|string",
            "email" => "required|email|unique:users",
            "password" => "required|min:8"

        ]);

        if($validator->fails())
        {

            return response()->json(["mensaje" => $validator->errors()], 422);

        }

        $user = User::create([

            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)

        ]);

        $response = Http::asForm()->post(config("services.passport.endpoint"), [

            "grant_type" => "password",
            "client_id" => config("services.passport.client_id"),
            "client_secret" => config("services.passport.client_secret"),
            "username" => $request->email,
            "password" => $request->password

        ]);

        if($response->failed())
        {

            return response()->json(["mensaje" => "Sin autenticar"], 401);

        }

        return response()->json([

            "user" => $user,
            "token_type" => $response["token_type"],
            "expires_in" => $response["expires_in"],
            "access_token" => $response["access_token"],
            "refresh_token" => $response["refresh_token"]

        ], 200);

    }

}