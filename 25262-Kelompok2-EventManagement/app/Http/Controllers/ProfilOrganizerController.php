<?php

namespace App\Http\Controllers;

use App\Models\ProfilOrganizer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilOrganizerController extends Controller
{
    /**
     * Display organizer dashboard.
     */
    public function dashboard()
    {
        $organizer = ProfilOrganizer::where('user_id', Auth::id())->first();
        $registrations = [];

        if ($organizer) {
            $registrations = DB::select("SELECT dt.id AS detail_id,
                e.nama_event,
                po.nama_organizer,
                u.username AS pembeli,
                t.nama_tiket,
                dt.nama_peserta,
                dt.jumlah,
                dt.total_detail_harga,
                tr.status_pembayaran,
                tr.metode_pembayaran,
                tr.created_at AS tanggal_pembelian
                FROM detail_transaksis dt
                JOIN transaksis tr ON dt.transaksi_id = tr.transaksi_id
                JOIN tikets t ON dt.tiket_id = t.tiket_id
                JOIN events e ON t.event_id = e.event_id
                JOIN profil_organizers po ON e.organizer_id = po.organizer_id
                JOIN users u ON tr.user_id = u.user_id
                WHERE e.organizer_id = ?
                ORDER BY tr.created_at DESC", [$organizer->organizer_id]);
        }

        return view('event_organizer.dashboard.index', compact('registrations'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result  = ProfilOrganizer::all();
        return view('admin.organizer.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.organizer.create');
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
