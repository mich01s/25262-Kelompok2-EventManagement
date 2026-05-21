<?php

use App\Http\Controllers\KategoriEventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\ProfilOrganizerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('profilOrganizer', [ProfilOrganizerController::class, 'index'])->name('profilOrganizer.index');
Route::get('Tiket', [TiketController::class, 'index'])->name('Tiket.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/admin/kategori', KategoriEventController::class)->names([
        'index' => 'admin.kategori' 
    ]);
});

require __DIR__.'/auth.php';
