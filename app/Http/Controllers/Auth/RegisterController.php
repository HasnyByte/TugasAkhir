<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email=' => 'required|email|unique:users,email',
            'password_user' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password_user' => Hash::make($request->password_user),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }
}
