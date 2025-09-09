<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ExpenseController;

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

Route::get('/', [ExpenseController::class, 'index'])->name('home');
// register

Route::get('/register', [RegisterController::class, 'showform']);
Route::post('/register', [RegisterController::class, 'store'])->name('register');

//expence

Route::middleware(['auth'])->group(function () {
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
});