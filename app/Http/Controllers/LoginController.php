<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginform()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $user = $request->only('email', 'password');

        if (Auth::attempt($user)) {
            $request->session()->regenerate();
            return redirect()->intended('index');
        }
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
        }
        public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}