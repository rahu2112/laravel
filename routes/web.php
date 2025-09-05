<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

//login first
Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [LoginController::class, 'loginform'])->name('loginform');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
// Protected (only after login)
Route::middleware('auth')->group(function () {
    Route::get('/index', function () {
        return view('index'); // aa tamaro expense index page
    })->name('index');
});


// index page
Route::get('/index', function () {
    return view('index');
});

// register 



// Show 
Route::get('/register', [RegisterController::class, 'register'])->name('register ');
//  submit
Route::post('/register', [RegisterController::class, 'register'])->name('register');