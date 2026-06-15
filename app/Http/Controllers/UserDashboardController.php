<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $events = Event::with('tiket')->orderBy('tanggal_mulai', 'desc')->paginate(6);
        return view('user.dashboard.index', compact('events'));
    }

    public function show($event_id)
    {
        $event = Event::with(['tiket', 'organizer', 'kategori'])->findOrFail($event_id);
        return view('user.dashboard.show', compact('event'));
    }
}
