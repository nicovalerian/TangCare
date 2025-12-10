<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Homepage - Public
Route::get('/', function () {
    return view('home');
})->name('home');

// Guest Routes (only accessible when NOT logged in)
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

// Auth Routes (only accessible when logged in)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        
        return redirect()->route('home');
    })->name('logout');
    
    // Donor Dashboard
    Route::get('/dashboard', function () {
        // Redirect non-donors to their correct dashboard
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        if (auth()->user()->isYayasan()) {
            return redirect()->route('yayasan.dashboard');
        }
        return view('dashboard');
    })->name('dashboard');
});

// Yayasan Routes
Route::middleware('auth')->prefix('yayasan')->name('yayasan.')->group(function () {
    Route::get('/dashboard', function () {
        if (!auth()->user()->isYayasan()) {
            abort(403, 'Unauthorized: Yayasan access only');
        }
        return view('yayasan.dashboard');
    })->name('dashboard');
});

// Admin Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized: Admin access only');
        }
        return view('admin.dashboard');
    })->name('dashboard');
});
