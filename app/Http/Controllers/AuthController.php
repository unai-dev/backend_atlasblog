<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(StoreUserRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => bcrypt($validated["password"])
        ]);

        return response()->json(["data" => $user], Response::HTTP_CREATED);
    }

    public function login(LoginUserRequest $request)
    {
        $validated = $request->validated();

        try {
            $token = JWTAuth::attempt($validated);
            if (!$token) {
                return response()->json(["error" => "Invalid credentials"], Response::HTTP_FORBIDDEN);
            }

            return response()->json(["token" => $token]);
        } catch (JWTException $ex) {
            return response()->json(["error" => $ex->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
