<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\KategoriEvent;
use App\Models\ProfilOrganizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    private function viewFor(string $view)
    {
        return Auth::user()->role === 'admin'
            ? "admin.event.{$view}"
            : "event_organizer.event.{$view}";
    }

    private function authorizeOrganizerAccess()
    {
        $user = Auth::user();

        if (! in_array($user->role, ['admin', 'event_organizer'], true)) {
            abort(403, 'Anda tidak memiliki izin akses halaman ini.');
        }
    }

    private function authorizeEventAccess(Event $event)
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return true;
        }

        return $event->organizer->user_id === $user->user_id;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorizeOrganizerAccess();

        $user = Auth::user();
        $events = $user->role === 'admin'
            ? Event::all()
            : Event::whereHas('organizer', fn ($query) => $query->where('user_id', $user->user_id))->get();

        return view($this->viewFor('index'), compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorizeOrganizerAccess();

        $categories = KategoriEvent::all();
        return view($this->viewFor('create'), compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorizeOrganizerAccess();

        $input = $request->validate([
            'kategori_id' => 'required|exists:kategori_events,kategori_id',
            'nama_event' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'google_maps' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // upload file
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namafoto = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('event_fotos', $namafoto, 'public');
           
        } else {
            $namafoto = null;
        }
         $input['foto'] = $namafoto;


        $user = Auth::user();

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
            'foto' => $input['foto'] ?? null,   
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
        $this->authorizeOrganizerAccess();

        if (! $this->authorizeEventAccess($event)) {
            abort(403, 'Anda tidak berhak mengubah event ini.');
        }

        $categories = KategoriEvent::all();
        return view($this->viewFor('edit'), compact('event', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $this->authorizeOrganizerAccess();

        if (! $this->authorizeEventAccess($event)) {
            abort(403, 'Anda tidak berhak mengubah event ini.');
        }

        $input = $request->validate([
            'kategori_id' => 'required|exists:kategori_events,kategori_id',
            'nama_event' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'lokasi' => 'required|string|max:255',
            'google_maps' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // upload file
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $namafoto = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('event_fotos', $namafoto, 'public');
            $input['foto'] = $namafoto;
        }

        $event->update([
            'kategori_id' => $input['kategori_id'],
            'nama_event' => $input['nama_event'],
            'tanggal_mulai' => $input['tanggal_mulai'],
            'lokasi' => $input['lokasi'],
            'google_maps' => $input['google_maps'] ?? null,
            'foto' => $input['foto'] ?? null,
        ]);

        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui.');
    }

    /**
     * Remove the specified resource in storage.
     */
    public function destroy(Event $event)
    {
        $this->authorizeOrganizerAccess();

        if (! $this->authorizeEventAccess($event)) {
            abort(403, 'Anda tidak berhak menghapus event ini.');
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event berhasil dihapus.');
    }
}
