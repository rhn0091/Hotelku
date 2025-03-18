<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReceptionistController extends Controller
{
    public function showLoginForm()
    {
        return view('receptionists.login-receptionists');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $receptionist = \App\Models\receptionist::where('email', $request->email)->first();

        if ($receptionist && $receptionist->password === $request->password) {
            Auth::guard('receptionist')->login($receptionist);
            return redirect()->route('receptionists.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function logout()
    {
        Auth::guard('receptionist')->logout();
        return redirect()->route('receptionist.login');
    }
}
