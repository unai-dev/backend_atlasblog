<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get("/", fn() => ["message" => "AtlasBlog is running!"]);

Route::apiResource("/categories", CategoryController::class);

Route::apiResource("/messages", MessageController::class);

Route::apiResource("/posts", PostController::class);

Route::apiResource("/likes", LikeController::class);


Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"])->name("login");
