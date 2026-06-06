<?php

namespace App\Http\Controllers;

use App\Models\PengisiAcara;
use Illuminate\Http\Request;

class PengisiAcaraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = PengisiAcara::withCount('eventPengisiAcara')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
        return view('admin.list pengisi.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.list pengisi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'nama_pengisi_acara' => 'required|unique:pengisi_acaras',
        ], [
            'nama_pengisi_acara.required' => 'Nama pengisi acara harus diisi',
            'nama_pengisi_acara.unique' => 'Nama pengisi acara sudah terdaftar',
        ]);

        PengisiAcara::create($input);
        return redirect()->route('pengisi.index')->with('success', 'Pengisi acara berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PengisiAcara $pengisiAcara)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PengisiAcara $pengisiAcara)
    {
        return view('admin.list pengisi.edit', compact('pengisiAcara'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PengisiAcara $pengisiAcara)
    {
        $input = $request->validate([
            'nama_pengisi_acara' => 'required|unique:pengisi_acaras,nama_pengisi_acara,' . $pengisiAcara->pengisi_acara_id . ',pengisi_acara_id',
        ], [
            'nama_pengisi_acara.required' => 'Nama pengisi acara harus diisi',
            'nama_pengisi_acara.unique' => 'Nama pengisi acara sudah terdaftar',
        ]);

        $pengisiAcara->update($input);
        return redirect()->route('pengisi.index')->with('success', 'Pengisi acara berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PengisiAcara $pengisiAcara)
    {
        $pengisiAcara->delete();
        return redirect()->route('pengisi.index')->with('success', 'Pengisi acara berhasil dihapus.');
    }
}
