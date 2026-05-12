<?php

namespace App\Http\Controllers;

use App\Models\KategoriEvent;
use Illuminate\Http\Request;

class KategoriEventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result  = KategoriEvent::all();
        return view('admin.kategori.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'nama_kategori' => 'required|unique:kategori_events',
        ]);

        KategoriEvent::create($input);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriEvent $kategoriEvent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriEvent $kategoriEvent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, KategoriEvent $kategoriEvent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriEvent $kategoriEvent)
    {
        //
    }
}
