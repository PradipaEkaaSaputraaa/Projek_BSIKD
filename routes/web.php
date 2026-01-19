<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DisplayController;

// 1. HALAMAN UTAMA (Langsung Display)
// Sekarang masyarakat cukup buka alamat IP atau localhost:8000 langsung muncul poster
Route::get('/', [DisplayController::class, 'index'])->name('user.display');

// 2. URL SPESIFIK DISPLAY (Tanpa Login)
// Masyarakat bisa akses ini langsung tanpa diminta password
Route::get('/display-portal', [DisplayController::class, 'index']);

// 3. AKSES ADMIN (Pintu Masuk Login)
// Ketik: localhost:8000/login untuk masuk ke panel admin
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/check-role');
    }
    return redirect('/dashboard/login');
})->name('login');

// 4. POLISI LALU LINTAS (Pemisah Role)
// Digunakan setelah Admin berhasil login
Route::get('/check-role', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }

    $user = Auth::user();

    // Jika admin, masuk ke Dashboard Filament
    if ($user->role === 'admin') {
        return redirect('/dashboard'); 
    } 

    // Jika user biasa login, arahkan ke display (meskipun sekarang sudah bisa diakses tanpa login)
    return redirect('/display-portal'); 
})->middleware(['auth']);

// 5. LOGOUT
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

set_time_limit(300);