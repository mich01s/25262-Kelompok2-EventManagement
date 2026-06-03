<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\KategoriEventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilOrganizerController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'event_organizer') {
            return redirect()->route('organizer.dashboard');
        }

        return redirect()->route('user.dashboard');
    }

    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    
    // Redirect berdasarkan role
    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($user->role === 'event_organizer') {
        return redirect()->route('organizer.dashboard');
    }
    
    return view('user.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/admin/kategori', KategoriEventController::class)->names([
        'index' => 'kategori.index',
        'create' => 'kategori.create',
        'store' => 'kategori.store',
        'show' => 'kategori.show',
        'edit' => 'kategori.edit',
        'update' => 'kategori.update',
        'destroy' => 'kategori.destroy'
    ]);
    Route::resource('/admin/dashboard', AdminDashboardController::class)->names([
        'index' => 'admin.dashboard',
        'create' => 'admin.dashboard.create',
        'store' => 'admin.dashboard.store',
        'show' => 'admin.dashboard.show',
        'edit' => 'admin.dashboard.edit',
        'update' => 'admin.dashboard.update',
        'destroy' => 'admin.dashboard.destroy'
    ]);
    
    Route::resource('/admin/organizer', ProfilOrganizerController::class)->names([
        'index' => 'organizer.index',
        'create' => 'organizer.create',
        'store' => 'organizer.store',
        'show' => 'organizer.show',
        'edit' => 'organizer.edit',
        'update' => 'organizer.update',
        'destroy' => 'organizer.destroy'
    ]);
});

Route::middleware(['auth', 'event_organizer'])->group(function () {
    Route::get('/organizer/dashboard', [ProfilOrganizerController::class, 'dashboard'])->name('organizer.dashboard');
    Route::get('/event-organizer/events', function () {
        return view('event_organizer.events');
    })->name('event-organizer.events');
    // Tambahkan routes lainnya untuk event organizer di sini
});

Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/events', function () {
        return view('user.events');
    })->name('user.events');
    // Tambahkan routes lainnya untuk user biasa di sini
});

require __DIR__.'/auth.php';
