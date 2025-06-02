<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('pages.home');
        }
        return view('auth.login');
    }

    // Menampilkan halaman register
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('pages.home');
        }
        return view('auth.register');
    }

    // Process login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/home')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    // Process register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_user' => 'required|string|max:255',
            'email_user' => 'required|string|email|max:255|unique:users,email',
            'password_user' => 'required|string|min:6|confirmed',
        ], [
            'nama_user.required' => 'Nama harus diisi',
            'email_user.required' => 'Email harus diisi',
            'email_user.email' => 'Format email tidak valid',
            'email_user.unique' => 'Email sudah terdaftar',
            'password_user.required' => 'Password harus diisi',
            'password_user.min' => 'Password minimal 6 karakter',
            'password_user.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::create([
                'name' => $request->nama_user,
                'email' => $request->email_user,
                'password' => Hash::make($request->password_user),
            ]);

            return back()->with('success', 'Registrasi berhasil! Silakan login dengan akun Anda.');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.'])->withInput();
        }
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Anda telah logout.');
    }

    // Dashboard (halaman setelah login)
    public function dashboard()
    {
        return view('pages.home');
    }
}
