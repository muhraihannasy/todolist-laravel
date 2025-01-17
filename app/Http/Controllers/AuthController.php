<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class AuthController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware(middleware: 'auth:api', except: ['login', 'register', 'forgot_password']),
        ];
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
                'data' => null,

            ], 401);
        }

        return $this->respondWithToken($token);
    }

    public function register()
    {
        try {
            $validatedData = request()->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:6',
            ]);

            $credentials = [
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
            ];

            $validatedData['password'] = bcrypt($validatedData['password']);

            $data = User::create($validatedData);

            $token = Auth::attempt($credentials);

            return response()->json([
                'success' => true,
                'message' => 'User created successfully',
                'data' => [
                    'access_token' => $token,
                    'token_type' => 'bearer',
                    'user' => $data,
                ]
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                "data" => null,
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'data' => null,
            ], 500);
        }
    }

    public function me()
    {
        return response()->json(Auth::user());
    }

    public function logout()
    {
        Auth::logout();

        return response()->json(['success' => true, 'message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
