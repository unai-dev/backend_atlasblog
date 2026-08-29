<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get("/", fn() => ["message" => "AtlasBlog is running!"]);

Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"])->name("login");

Route::middleware("jwt.auth")->group(function () {

    Route::apiResource("/posts", PostController::class);

    Route::apiResource("/likes", LikeController::class);

    Route::apiResource("/categories", CategoryController::class);

    Route::apiResource("/messages", MessageController::class);

    Route::get("/who", [AuthController::class, "who"]);
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::post("/refresh", [AuthController::class, "refresh"]);
});
