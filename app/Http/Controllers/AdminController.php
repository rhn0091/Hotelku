<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('admin.login-admin');
    }

    // Proses login
    public function login(Request $request)
    {
        $admin = \App\Models\Admin::where('email', $request->email)->first();

        if ($admin && $admin->password === $request->password) {
            Auth::guard('admin')->login($admin);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Email atau password salah.');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login.form')->with('success', 'Anda telah logout.');
    }
}
