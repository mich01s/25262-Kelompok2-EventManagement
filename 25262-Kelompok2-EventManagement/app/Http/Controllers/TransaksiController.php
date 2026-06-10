<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Tiket;
use App\Models\DetailTransaksi;
use Carbon\Carbon;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $transaksis = Transaksi::with('details.tiket.event')
            ->where('user_id', $user->user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.tickets.index', compact('transaksis'));
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
        $data = $request->validate([
            'tiket_id' => 'required|integer|exists:tikets,tiket_id',
            'jumlah' => 'required|integer|min:1',
            'nama_peserta' => 'required|string|max:255'
        ]);

        $tiket = Tiket::findOrFail($data['tiket_id']);

        if ($data['jumlah'] > $tiket->jumlah_tiket) {
            return back()->withErrors(['jumlah' => 'Jumlah tiket tidak tersedia.']);
        }

        $user = Auth::user();

        DB::beginTransaction();
        try {
            $total = $tiket->harga * $data['jumlah'];

            $transaksi = Transaksi::create([
                'user_id' => $user->user_id,
                'total_tagihan' => $total,
                'total_id' => 0,
                'total_pembayaran' => 0,
                'bukti_pembayaran' => '',
                'metode_pembayaran' => 'manual',
                'status_pembayaran' => 'pending'
            ]);

            DetailTransaksi::create([
                'transaksi_id' => $transaksi->transaksi_id,
                'tiket_id' => $tiket->tiket_id,
                'jumlah' => $data['jumlah'],
                'harga_satuan' => $tiket->harga,
                'total_detail_harga' => $total,
                'nama_peserta' => $data['nama_peserta'],
                'kode_qr' => Str::uuid()
            ]);

            // Kurangi stok tiket
            $tiket->jumlah_tiket = $tiket->jumlah_tiket - $data['jumlah'];
            $tiket->save();

            DB::commit();
            return redirect()->route('user.tickets.index')->with('success', 'Tiket berhasil dipesan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memproses transaksi.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function paymentForm(Transaksi $transaksi)
    {
        $user = Auth::user();
        if ($transaksi->user_id !== $user->user_id) {
            abort(403);
        }

        $transaksi->load('details.tiket.event');

        return view('user.tickets.pay', compact('transaksi'));
    }

    public function pay(Request $request, Transaksi $transaksi)
    {
        $user = Auth::user();
        if ($transaksi->user_id !== $user->user_id) {
            abort(403);
        }

        if ($transaksi->status_pembayaran !== 'pending') {
            return back()->withErrors(['error' => 'Transaksi sudah dibayar.']);
        }

        $data = $request->validate([
            'metode_pembayaran' => 'required|string|in:Transfer Bank,Kartu Kredit,Cash',
            'total_pembayaran' => 'required|numeric|min:0',
            'bukti_pembayaran' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($data['total_pembayaran'] < $transaksi->total_tagihan) {
            return back()->withErrors(['total_pembayaran' => 'Pembayaran harus sama dengan total tagihan.']);
        }

        $bukti = 'Pembayaran langsung (' . $data['metode_pembayaran'] . ')';
        if ($request->hasFile('bukti_pembayaran')) {
            $bukti = $request->file('bukti_pembayaran')->store('payment-proofs', 'public');
        }

        $transaksi->update([
            'status_pembayaran' => 'paid',
            'total_pembayaran' => $data['total_pembayaran'],
            'metode_pembayaran' => $data['metode_pembayaran'],
            'bukti_pembayaran' => $bukti,
        ]);

        return redirect()->route('user.tickets.index')->with('success', 'Pembayaran berhasil diproses. Tiket kini resmi milik Anda.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $user = Auth::user();

        if ($transaksi->user_id !== $user->user_id) {
            abort(403);
        }

        // Cek setiap detail apakah event belum mulai
        foreach ($transaksi->details as $detail) {
            $event = $detail->tiket->event;
            if (!$event) {
                return back()->withErrors(['error' => 'Event tidak ditemukan untuk detail transaksi ini.']);
            }

            $start = Carbon::parse($event->tanggal_mulai);
            if ($start->isPast()) {
                return back()->withErrors(['error' => 'Tiket tidak bisa dibatalkan karena event sudah dimulai.']);
            }
        }

        // Restore tiket jumlah
        foreach ($transaksi->details as $detail) {
            $tiket = $detail->tiket;
            $tiket->jumlah_tiket = $tiket->jumlah_tiket + $detail->jumlah;
            $tiket->save();
        }

        $transaksi->delete();

        return redirect()->route('user.tickets.index')->with('success', 'Transaksi berhasil dibatalkan.');
    }
}
