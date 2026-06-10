<?php

namespace Database\Seeders;

use App\Models\DetailTransaksi;
use App\Models\Event;
use App\Models\Tiket;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('username', 'testuser')->first();
        if (! $user) {
            return;
        }

        $event = Event::where('nama_event', 'Futsal Championship Southeast Asia')->first();
        if (! $event) {
            return;
        }

        $tiket = Tiket::where('event_id', $event->event_id)
            ->where('nama_tiket', 'Reguler')
            ->first();

        if (! $tiket) {
            return;
        }

        if (DetailTransaksi::where('kode_qr', 'TEST-QR-12345')->exists()) {
            return;
        }

        $transaksi = Transaksi::create([
            'user_id' => $user->user_id,
            'total_tagihan' => $tiket->harga * 2,
            'total_id' => 0,
            'total_pembayaran' => 0,
            'bukti_pembayaran' => '',
            'metode_pembayaran' => 'manual',
            'status_pembayaran' => 'pending',
        ]);

        DetailTransaksi::create([
            'transaksi_id' => $transaksi->transaksi_id,
            'tiket_id' => $tiket->tiket_id,
            'jumlah' => 2,
            'harga_satuan' => $tiket->harga,
            'total_detail_harga' => $tiket->harga * 2,
            'nama_peserta' => 'Andi Pratama',
            'kode_qr' => 'TEST-QR-12345',
        ]);

        $tiket->decrement('jumlah_tiket', 2);
    }
}
