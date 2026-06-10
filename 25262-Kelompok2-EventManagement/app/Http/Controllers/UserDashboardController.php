<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('tanggal_mulai', 'desc')->paginate(6);
        return view('user.dashboard.index', compact('events'));
    }

    public function show($event_id)
    {
        $event = Event::with(['tikets', 'organizer', 'kategori'])->findOrFail($event_id);
        return view('user.dashboard.show', compact('event'));
    }
}
