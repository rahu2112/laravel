<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Register;


class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:100',
            'email'         => 'required|email|unique:register,email',
            'password'      => 'required|min:6',
            'phone'         => 'nullable|string|max:15',
            'address'       => 'nullable|string|max:255',
            'dob'           => 'nullable|date',
            'gender'        => 'nullable|in:male,female,other',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('profile_photo')) {
            $photoPath = $request->file('profile_photo')->store('profiles', 'public');
        }

        Register::create([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'phone'         => $request->phone,
            'address'       => $request->address,
            'dob'           => $request->dob,
            'gender'        => $request->gender,
            'profile_photo' => $photoPath,
        ]);

        return redirect()->back()->with('success', 'User Registered Successfully!');
    }
}