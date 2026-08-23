<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get("/", fn() => ["message" => "AtlasBlog is running!"]);

Route::apiResource("/categories", CategoryController::class);

Route::apiResource("/messages", MessageController::class);

Route::apiResource("/posts", PostController::class);
