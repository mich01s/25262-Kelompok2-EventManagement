<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\KategoriEvent;
use App\Models\ProfilOrganizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('event_organizer.event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = KategoriEvent::all();
        return view('event_organizer.event.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'kategori_id' => 'required|exists:kategori_events,kategori_id',
            'nama_event' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'google_maps' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        if ($user->role !== 'event_organizer') {
            abort(403, 'Hanya event organizer yang dapat membuat event.');
        }

        $organizer = ProfilOrganizer::firstOrCreate(
            ['user_id' => $user->user_id],
            ['nama_organizer' => $user->username]
        );

        Event::create([
            'organizer_id' => $organizer->organizer_id,
            'kategori_id' => $input['kategori_id'],
            'nama_event' => $input['nama_event'],
            'tanggal_mulai' => $input['tanggal_mulai'],
            'lokasi' => $input['lokasi'],
            'google_maps' => $input['google_maps'] ?? null,
        ]);

        return redirect()->route('events.index')->with('success', 'Event berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $categories = KategoriEvent::all();
        return view('event_organizer.event.edit', compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $input = $request->validate([
            'kategori_id' => 'required|exists:kategori_events,kategori_id',
            'nama_event' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'google_maps' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        if ($event->organizer->user_id !== $user->user_id) {
            abort(403, 'Anda tidak berhak mengubah event ini.');
        }

        $event->update([
            'kategori_id' => $input['kategori_id'],
            'nama_event' => $input['nama_event'],
            'tanggal_mulai' => $input['tanggal_mulai'],
            'lokasi' => $input['lokasi'],
            'google_maps' => $input['google_maps'] ?? null,
        ]);

        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Remove the specified resource in storage.
     */
    public function destroy(Event $event)
    {
        //
    }
}
