<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'type' => 'required|string', // Add validation for type
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 422);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'type' => $request->type, // Save type
            ]);

            $token = JWTAuth::fromUser($user);

            $user->api_token = $token;

            return response()->json(compact('user', 'token'), 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to create user'], 500);
        }
    }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     Log::info('Credentials:', $credentials);

    //     // $user = User::where('email', $request->email)->first();
    //     $email = trim($request->email);
    //     $user = User::where('email', $email)->first();
    //     if (!$user) {
    //         return response()->json(['error' => 'User not found'], 404);
    //     }

    //     // if (!Hash::check($request->password, $user->password)) {
    //     //     return response()->json(['error' => 'Invalid password'], 401);
    //     // }

    //     // $token = JWTAuth::fromUser($user);

    //     // return response()->json([
    //     //     'message' => 'Login successful',
    //     //     'data' => $user,
    //     //     'token' => $token, // Include token if generated
    //     // ], 200);

    //     if (!Hash::check($request->password, $user->password)) {
    //         return response()->json(['error' => 'Invalid password'], 401);
    //     }

    //     $token = JWTAuth::fromUser($user);

    //     return response()->json([
    //         'message' => 'Login successful',
    //         'data' => $user,
    //         'token' => $token,
    //     ], 200);
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = Auth::user();
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'essage' => 'Login successful',
            'data' => $user,
            'token' => $token,
        ], 200);
    }

    // public function validateToken(Request $request)
    // {
    //     try {
    //         $token = JWTAuth::parseToken($request->header('Authorization'));
    //         $user = JWTAuth::authenticate($token);
    //         return response()->json(['message' => 'Token is valid']);
    //     } catch (JWTException $e) {
    //         return response()->json(['error' => 'Invalid token'], 401);
    //     }
    // }

    public function validateToken(Request $request)
    {
        try {
            $token = JWTAuth::parseToken($request->header('Authorization'));
            JWTAuth::authenticate($token);
            return response()->json(['message' => 'Token is valid']);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Invalid token'], 401);
        }
    }
}