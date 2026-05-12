<?php

use App\Http\Controllers\KategoriEventController;
use App\Http\Controllers\ProfilOrganizerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/organizer',ProfilOrganizerController::class);
Route::resource('/admin/kategori',KategoriEventController::class);