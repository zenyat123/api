<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([

            "email" => "required|email",
            "password" => "required|min:8"

        ]);

        $data = [

            "email" => $request->email,
            "password" => $request->password

        ];

        if(auth()->attempt($data))
        {

            $token = auth()->user()->createToken("Personal Access Token")->accessToken;

            return response()->json(["token" => $token], 200);

        }
        else
        {

            return response()->json(["message" => "These credentials do not match our records"], 404);

        }

    }

    public function logout(Request $request)
    {

        $token = auth()->user()->token();

        $token->revoke();

        return response()->json(["message" => "loggetout"]);

    }

}