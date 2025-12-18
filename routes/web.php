<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DisplayController; // Pastikan Controller ini diimport

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

    // Admin masuk ke Panel Filament
    if ($user->role === 'admin') {
        return redirect('/dashboard'); 
    } 

    // User biasa langsung diarahkan ke halaman DISPLAY PORTRAIT
    if ($user->role === 'user') {
        return redirect('/display-portal'); 
    }

    Auth::logout();
    return redirect('/login')->with('error', 'Role tidak dikenali.');
})->middleware(['auth']);

// 4. Rute Halaman Display (Portrait)
// Ini adalah URL tujuan untuk User biasa
Route::get('/display-portal', [DisplayController::class, 'index'])->middleware(['auth'])->name('user.display');

// Rute Logout agar kembali ke halaman login awal
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');