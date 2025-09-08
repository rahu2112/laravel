<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Show login form
    public function loginform()
    {
        return view('auth.login'); // login.blade.php
    }

    // Handle login
    public function login(Request $request)
    {
        // Validate inputs
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Credentials array
        $credentials = $request->only('email', 'password');

        // Attempt login
        if (Auth::attempt($credentials)) {
            // Regenerate session
            $request->session()->regenerate();

            // Redirect to intended page or dashboard
            return redirect()->intended('index');
        }

        // If login fails
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->onlyInput('email'); // preserve email input
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
