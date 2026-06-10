<?php

namespace Database\Seeders;

use App\Models\KategoriEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            'Musik & Konser',
            'Olahraga',
            'Seni & Budaya',
            'Teknologi',
            'Seminar & Workshop',
            'Festival',
            'Pameran',
            'Pertandingan',
        ];

        foreach ($kategori as $kat) {
            KategoriEvent::firstOrCreate(['nama_kategori' => $kat]);
        }
    }
}
