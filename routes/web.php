<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// 1. Halaman Utama
Route::get('/', function () {
    return redirect('/check-role');
});

// 2. Pintu masuk tunggal
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/check-role');
    }
    return redirect('/dashboard/login');
})->name('login');

// 3. Polisi Lalu Lintas (Pemisah Role)
Route::get('/check-role', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }

    $user = Auth::user();

    // Pastikan diarahkan berdasarkan role ke PATH panel masing-masing
    if ($user->role === 'admin') {
        return redirect('/dashboard'); // Path Admin
    } 

    if ($user->role === 'user') {
        return redirect('/app'); // Path User
    }

    Auth::logout();
    return redirect('/login')->with('error', 'Role tidak dikenali.');
})->middleware(['auth']);