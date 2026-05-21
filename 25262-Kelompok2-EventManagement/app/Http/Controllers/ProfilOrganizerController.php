<?php

namespace App\Http\Controllers;

use App\Models\ProfilOrganizer;
use Illuminate\Http\Request;

class ProfilOrganizerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result  = ProfilOrganizer::all();
        return view('profilOrganizer.index',compact(('result')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProfilOrganizer $profilOrganizer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProfilOrganizer $profilOrganizer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProfilOrganizer $profilOrganizer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProfilOrganizer $profilOrganizer)
    {
        //
    }
}
