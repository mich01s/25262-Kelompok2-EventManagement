<?php

namespace App\Http\Controllers;

use App\Models\PengisiAcara;
use App\Models\ProfilOrganizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PengisiAcaraController extends Controller
{
    private function routeFor(string $action): string
    {
        return Auth::user()->role === 'admin'
            ? "pengisi.{$action}"
            : "organizer.pengisi.{$action}";
    }

    private function viewFor(string $view): string
    {
        return Auth::user()->role === 'admin'
            ? "admin.list pengisi.{$view}"
            : "event_organizer.pengisi acara.{$view}";
    }

    private function authorizeOrganizerAccess(): void
    {
        $user = Auth::user();

        if (! in_array($user->role, ['admin', 'event_organizer'], true)) {
            abort(403, 'Anda tidak memiliki izin akses halaman ini.');
        }
    }

    private function authorizePengisiAccess(PengisiAcara $pengisiAcara): bool
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return true;
        }

        return $pengisiAcara->organizer?->user_id === $user->user_id;
    }

    private function baseQuery()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return PengisiAcara::query();
        }

        return PengisiAcara::whereHas('organizer', function ($query) use ($user) {
            $query->where('user_id', $user->user_id);
        });
    }

    private function currentOrganizer(): ProfilOrganizer
    {
        $user = Auth::user();

        return ProfilOrganizer::firstOrCreate(
            ['user_id' => $user->user_id],
            ['nama_organizer' => $user->username]
        );
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorizeOrganizerAccess();

        $result = $this->baseQuery()
                    ->withCount('eventPengisiAcara')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        return view($this->viewFor('index'), compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorizeOrganizerAccess();

        return view($this->viewFor('create'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorizeOrganizerAccess();

        $user = Auth::user();
        $rules = [
            'nama_pengisi_acara' => ['required', 'string', 'max:255'],
        ];

        if ($user->role === 'admin') {
            $rules['nama_pengisi_acara'][] = Rule::unique('pengisi_acaras', 'nama_pengisi_acara');
        } else {
            $organizer = $this->currentOrganizer();

            $rules['nama_pengisi_acara'][] = Rule::unique('pengisi_acaras', 'nama_pengisi_acara')
                ->where(function ($query) use ($organizer) {
                    $query->where('organizer_id', $organizer->organizer_id);
                });
        }

        $input = $request->validate($rules, [
            'nama_pengisi_acara.required' => 'Nama pengisi acara harus diisi',
            'nama_pengisi_acara.unique' => 'Nama pengisi acara sudah terdaftar',
        ]);

        $input['organizer_id'] = $user->role === 'admin'
            ? null
            : $this->currentOrganizer()->organizer_id;

        PengisiAcara::create($input);
        return redirect()->route($this->routeFor('index'))->with('success', 'Pengisi acara berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengisiAcara $pengisi)
    {
        $pengisiAcara = $pengisi;
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengisiAcara $pengisi)
    {
        $this->authorizeOrganizerAccess();

        $pengisiAcara = $pengisi;

        if (! $this->authorizePengisiAccess($pengisiAcara)) {
            abort(403, 'Anda tidak berhak mengubah pengisi acara ini.');
        }

        return view($this->viewFor('edit'), compact('pengisiAcara'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengisiAcara $pengisi)
    {
        $this->authorizeOrganizerAccess();

        $pengisiAcara = $pengisi;

        if (! $this->authorizePengisiAccess($pengisiAcara)) {
            abort(403, 'Anda tidak berhak mengubah pengisi acara ini.');
        }

        $user = Auth::user();
        $rules = [
            'nama_pengisi_acara' => ['required', 'string', 'max:255'],
        ];

        if ($user->role === 'admin') {
            $rules['nama_pengisi_acara'][] = Rule::unique('pengisi_acaras', 'nama_pengisi_acara')
                ->ignore($pengisiAcara->pengisi_acara_id, 'pengisi_acara_id');
        } else {
            $organizer = $this->currentOrganizer();

            $rules['nama_pengisi_acara'][] = Rule::unique('pengisi_acaras', 'nama_pengisi_acara')
                ->ignore($pengisiAcara->pengisi_acara_id, 'pengisi_acara_id')
                ->where(function ($query) use ($organizer) {
                    $query->where('organizer_id', $organizer->organizer_id);
                });
        }

        $input = $request->validate($rules, [
            'nama_pengisi_acara.required' => 'Nama pengisi acara harus diisi',
            'nama_pengisi_acara.unique' => 'Nama pengisi acara sudah terdaftar',
        ]);

        $pengisiAcara->update($input);
        return redirect()->route($this->routeFor('index'))->with('success', 'Pengisi acara berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengisiAcara $pengisi)
    {
        $this->authorizeOrganizerAccess();

        $pengisiAcara = $pengisi;

        if (! $this->authorizePengisiAccess($pengisiAcara)) {
            abort(403, 'Anda tidak berhak menghapus pengisi acara ini.');
        }

        $pengisiAcara->delete();
        return redirect()->route($this->routeFor('index'))->with('success', 'Pengisi acara berhasil dihapus.');
    }
}
