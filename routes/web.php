<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ClientController;
use App\Http\Controllers\TokenController;

Route::get("/", function()
{

    return view("welcome");

});

Route::get("/dashboard", function()
{

    return view("dashboard");

})->middleware(["auth"])->name("dashboard");

require __DIR__."/auth.php";

Route::get("clients", [ClientController::class, "index"])->name("clients.index");
Route::get("tokens", [TokenController::class, "index"])->name("tokens.index");