<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersController extends Controller
{
    // Middleware auth hanya untuk logout dan get users
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only(['logout', 'index']);
    }

    // REGISTER
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email_user',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'nama_user' => $validated['name'],
            'email_user' => $validated['email'],
            'password_user' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Registrasi berhasil',
            'data' => [
                'user' => $user,
                'token' => $token,
            ]
        ], 201);
    }

    // LOGIN
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $user = User::where('email_user', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password_user)) {
            return response()->json([
                'status' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login berhasil',
            'data' => [
                'user' => $user,
                'token' => $token,
            ]
        ], 200);
    }

    // LOGOUT
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logout berhasil'
        ], 200);
    }

    // GET ALL USERS (Jika dibutuhkan oleh admin)
    public function index()
    {
        $users = User::all();

        return response()->json([
            'status' => true,
            'message' => 'Daftar pengguna',
            'data' => $users
        ], 200);
    }
}
