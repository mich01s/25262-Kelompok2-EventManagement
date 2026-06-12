<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\KategoriEventController;
use App\Http\Controllers\PengisiAcaraController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TiketController;
use App\Http\Controllers\ProfilOrganizerController;
use App\Http\Controllers\UserDashboardController;
use App\Models\Event;
use App\Models\ProfilOrganizer;
use Illuminate\Http\Request;
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

Route::get('profilOrganizer', [ProfilOrganizerController::class, 'index'])->name('profilOrganizer.index');
Route::get('Tiket', [TiketController::class, 'index'])->name('Tiket.index');

Route::get('/dashboard', function () {
    $user = Auth::user();
    
    // Redirect berdasarkan role
    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($user->role === 'event_organizer') {
        return redirect()->route('organizer.dashboard');
    }
    
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/show', [ProfileController::class, 'show'])->name('profile.show');
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

    Route::get('/admin/users', [AdminUserController::class, 'index'])->name('users.index');

    Route::resource('/admin/pengisi', PengisiAcaraController::class)->names([
        'index' => 'pengisi.index',
        'create' => 'pengisi.create',
        'store' => 'pengisi.store',
        'show' => 'pengisi.show',
        'edit' => 'pengisi.edit',
        'update' => 'pengisi.update',
        'destroy' => 'pengisi.destroy'
    ]);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/organizer/dashboard', [ProfilOrganizerController::class, 'dashboard'])->name('organizer.dashboard');
    Route::resource('/event', EventController::class)->names([
        'index' => 'events.index',
        'create' => 'events.create',
        'store' => 'events.store',
        'show' => 'events.show',
        'edit' => 'events.edit',
        'update' => 'events.update',
        'destroy' => 'events.destroy',
    ]);

    Route::resource('/organizer/pengisi', PengisiAcaraController::class)->names([
        'index' => 'organizer.pengisi.index',
        'create' => 'organizer.pengisi.create',
        'store' => 'organizer.pengisi.store',
        'show' => 'organizer.pengisi.show',
        'edit' => 'organizer.pengisi.edit',
        'update' => 'organizer.pengisi.update',
        'destroy' => 'organizer.pengisi.destroy'
    ]);

});

Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/organizer', function () {
        $organizers = ProfilOrganizer::withCount('events')->get();
        return view('user.organizer.index', compact('organizers'));
    })->name('user.organizer.index');

    Route::get('/user/organizer/{organizer}', function (ProfilOrganizer $organizer) {
        $events = $organizer->events()->orderBy('tanggal_mulai')->get();
        return view('user.organizer.show', compact('organizer', 'events'));
    })->name('user.organizer.show');

    Route::get('/user/events/{event_id}', [UserDashboardController::class, 'show'])->name('user.events.show');
    Route::get('/user/events', function (Request $request) {
        $q = $request->query('q');

        $events = Event::when($q, function ($query, $q) {
            return $query->where('nama_event', 'like', "%{$q}%");
        })->orderBy('tanggal_mulai')->get();

        return view('user.events', compact('events', 'q'));
    })->name('user.events');
    // User ticket routes
    Route::get('/user/tickets', [\App\Http\Controllers\TransaksiController::class, 'index'])->name('user.tickets.index');
    Route::post('/user/tickets/purchase', [\App\Http\Controllers\TransaksiController::class, 'store'])->name('user.tickets.purchase');
    Route::get('/user/tickets/{transaksi}/pay', [\App\Http\Controllers\TransaksiController::class, 'paymentForm'])->name('user.tickets.pay.form');
    Route::post('/user/tickets/{transaksi}/pay', [\App\Http\Controllers\TransaksiController::class, 'pay'])->name('user.tickets.pay');
    Route::delete('/user/tickets/{transaksi}', [\App\Http\Controllers\TransaksiController::class, 'destroy'])->name('user.tickets.cancel');
    // Tambahkan routes lainnya untuk user biasa di sini
});

require __DIR__.'/auth.php';
