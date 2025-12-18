<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return Auth::user()->role === 'admin' 
            ? redirect('/admin') 
            : redirect('/app');
    }
    return redirect('/app/login'); // Default login user
});

// Jika ada yang ngetik /login manual
Route::get('/login', function () {
    return redirect('/app/login');
})->name('login');
