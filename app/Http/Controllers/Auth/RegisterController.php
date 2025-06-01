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
            'nama_user' => 'required|string|max:255',
            'email_user' => 'required|email|unique:users,email_user',
            'password_user' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'nama_user' => $request->nama_user,
            'email_user' => $request->email_user,
            'password_user' => Hash::make($request->password_user),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil!');
    }
}
