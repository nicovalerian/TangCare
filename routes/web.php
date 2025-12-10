<?php

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\EventsMap;
use App\Livewire\DonationForm;
use App\Livewire\DonationSuccess;
use App\Livewire\Yayasan\Profile as YayasanProfile;
use App\Livewire\Yayasan\EventIndex;
use App\Livewire\Yayasan\EventForm;
use App\Livewire\Admin\YayasanList;
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

// Events Map - Public (find events on map)
Route::get('/events', EventsMap::class)->name('events.map');

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
    
    // Donation Routes (for donors)
    Route::get('/donate/{event?}', DonationForm::class)->name('donations.create');
    Route::get('/donate/success', DonationSuccess::class)->name('donations.success');
});

// Yayasan Routes
Route::middleware('auth')->prefix('yayasan')->name('yayasan.')->group(function () {
    Route::get('/dashboard', function () {
        if (!auth()->user()->isYayasan()) {
            abort(403, 'Unauthorized: Yayasan access only');
        }
        return view('yayasan.dashboard');
    })->name('dashboard');
    
    Route::get('/profile', YayasanProfile::class)->name('profile');
    Route::get('/events', EventIndex::class)->name('events');
    Route::get('/events/create', EventForm::class)->name('events.create');
    Route::get('/events/{id}/edit', EventForm::class)->name('events.edit');
});

// Admin Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized: Admin access only');
        }
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::get('/yayasans', YayasanList::class)->name('yayasans');
});
