<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        $request->validate([

            "email" => "required|email",
            "password" => "required|min:8"

        ]);

        $user = User::where("email", $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password))
        {

            return response()->json(["mensaje" => "Correo o contraseña incorrectos"], 401);

        }

        $response = Http::asForm()->post(config("services.passport.endpoint"), [

            "grant_type" => "password",
            "client_id" => config("services.passport.client_id"),
            "client_secret" => config("services.passport.client_secret"),
            "username" => $request->email,
            "password" => $request->password

        ]);

        if($response->failed())
        {

            return response()->json(["mensaje" => "Sin obtención de token"], 401);

        }

        return response()->json([

            "user" => $user,
            "token_type" => $response["token_type"],
            "expires_in" => $response["expires_in"],
            "access_token" => $response["access_token"],
            "refresh_token" => $response["refresh_token"]

        ], 200);

    }

    public function refresh(Request $request)
    {

        $request->validate([

            "refresh_token" => "required"

        ]);

        $response = Http::asForm()->post(config("services.passport.endpoint"), [

            "grant_type" => "refresh_token",
            "client_id" => config("services.passport.client_id"),
            "client_secret" => config("services.passport.client_secret"),
            "refresh_token" => $request->refresh_token

        ]);

        if($response->failed())
        {

            return response()->json(["mensaje" => "Token de actualización inválido"], 401);

        }

        return $response->json();

    }

    public function logout(Request $request)
    {

        $token = $request->user()->token();

        $token->revoke();

        DB::table("oauth_refresh_tokens")
            ->where("access_token_id", $token->id)
            ->update(["revoked" => true]);

        return response()->json(["mensaje" => "Sesión cerrada correctamente"]);

    }

}