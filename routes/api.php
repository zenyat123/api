<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;

Route::post("register", [RegisterController::class, "store"])->name("api.register");
Route::post("login", [LoginController::class, "store"])->name("api.login");
Route::apiResource("categories", CategoryController::class)->names("api.categories");
Route::apiResource("posts", PostController::class)->names("api.posts");