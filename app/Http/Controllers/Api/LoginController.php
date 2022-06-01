<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Http\Resources\UserResource;

class LoginController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([

            "email" => "required|email",
            "password" => "required|min:8"

        ]);

        $user = User::where("email", $request->email)->firstOrFail();

        if(Hash::check($request->password, $user->password))
        {

            return UserResource::make($user);

        }
        else
        {

            return response()->json(["message" => "These credentials do not match our records"], 404);

        }

    }

}