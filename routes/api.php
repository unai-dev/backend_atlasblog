<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;


Route::get("/", fn() => ["message" => "AtlasBlog is running!"]);

Route::apiResource("/categories", CategoryController::class);
