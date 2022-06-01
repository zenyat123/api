<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\UserResource;
use App\Models\User;

class RegisterController extends Controller
{

    public function store(Request $request)
    {

        $request->validate([

            "name" => "required|string",
            "email" => "required|email|unique:users",
            "password" => "required|min:8|confirmed"

        ]);

        $user = User::create([

            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password)

        ]);

        return UserResource::make($user);

    }

}