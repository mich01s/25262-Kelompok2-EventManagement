<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $categoryStats = DB::select("SELECT ke.nama_kategori, COUNT(e.event_id) AS events_count
            FROM kategori_events ke
            LEFT JOIN events e ON e.kategori_id = ke.kategori_id
            GROUP BY ke.nama_kategori");

        $organizerStats = DB::select("SELECT po.nama_organizer, COUNT(e.event_id) AS events_count
            FROM profil_organizers po
            LEFT JOIN events e ON e.organizer_id = po.organizer_id
            GROUP BY po.nama_organizer");

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
            ORDER BY tr.created_at DESC");

        return view('admin.dashboard.index', compact('categoryStats', 'organizerStats', 'registrations'));
    }
}
