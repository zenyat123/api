<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;

Route::post("register", [RegisterController::class, "register"])->name("api.register");

Route::post("login", [AuthController::class, "login"])->name("api.login");
Route::post("refresh", [AuthController::class, "refresh"])->name("api.refresh");
Route::middleware("auth:api")->post("logout", [AuthController::class, "logout"])->name("api.logout");

Route::apiResource("employees", EmployeeController::class)->names("api.employees");
Route::apiResource("categories", CategoryController::class)->names("api.categories");
Route::apiResource("posts", PostController::class)->names("api.posts");