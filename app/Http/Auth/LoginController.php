<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);

        // Login admin jika ID admin numeric
        if (is_numeric($request->email)) {
            $admin = Admin::where('id_admin', $request->email)->first();
            if ($admin && Hash::check($request->password, $admin->password)) {
                Auth::guard('admin')->login($admin);
                session(['admin_id' => $admin->id_admin]);
                return redirect('/adminDashboard');
            }
        }

        // Login user biasa
        $user = User::where('email_user', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password_user)) {
            Auth::login($user);
            session(['user_id' => $user->id_user]);
            return redirect('/home');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function profile(Request $request)
    {
        return response()->json($request->user());
    }
}

