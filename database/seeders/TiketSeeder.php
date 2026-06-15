<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Tiket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TiketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ticketTemplates = [
            ['nama_tiket' => 'Reguler', 'harga' => 125000, 'jumlah_tiket' => 100],
            ['nama_tiket' => 'VIP', 'harga' => 250000, 'jumlah_tiket' => 35],
            ['nama_tiket' => 'VVIP', 'harga' => 500000, 'jumlah_tiket' => 15],
        ];

        $events = Event::all();
        if ($events->isEmpty()) {
            return;
        }

        foreach ($events as $event) {
            foreach ($ticketTemplates as $template) {
                Tiket::firstOrCreate([
                    'event_id' => $event->event_id,
                    'nama_tiket' => $template['nama_tiket'],
                ], [
                    'harga' => $template['harga'],
                    'jumlah_tiket' => $template['jumlah_tiket'],
                ]);
            }
        }
    }
}
