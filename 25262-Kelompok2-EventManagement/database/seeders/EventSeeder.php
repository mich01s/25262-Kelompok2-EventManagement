<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\KategoriEvent;
use App\Models\ProfilOrganizer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $events = [
            [
                'nama_event' => 'Concert Series: The Rising Stars',
                'tanggal_mulai' => '2026-06-15 19:00:00',
                'lokasi' => 'Jakarta International Expo Center',
                'google_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2184648088266!2d106.79939!3d-6.190793!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34ab9%3A0x5371bf0fdad9a3a!2sJakarta%20International%20Expo!5e0!3m2!1sen!2sid!4v1234567890',
                'kategori_id' => 1,
            ],
            [
                'nama_event' => 'National Esports Championship 2026',
                'tanggal_mulai' => '2026-06-20 10:00:00',
                'lokasi' => 'Indonesia Convention Center, BSD',
                'google_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.6203434599526!2d106.5402!3d-6.373!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1',
                'kategori_id' => 2,
            ],
            [
                'nama_event' => 'Indonesia Cultural Festival',
                'tanggal_mulai' => '2026-07-01 09:00:00',
                'lokasi' => 'Kota Tua Jakarta',
                'google_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.8!2d106.81!3d-6.135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1',
                'kategori_id' => 3,
            ],
            [
                'nama_event' => 'Tech Summit Asia 2026',
                'tanggal_mulai' => '2026-07-10 08:00:00',
                'lokasi' => 'Bali International Convention Centre',
                'google_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.2!2d115.237!3d-8.67!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1',
                'kategori_id' => 4,
            ],
            [
                'nama_event' => 'Digital Marketing Masterclass',
                'tanggal_mulai' => '2026-06-25 14:00:00',
                'lokasi' => 'Grand Indonesia, Jakarta',
                'google_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.15!2d106.82!3d-6.195!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1',
                'kategori_id' => 5,
            ],
            [
                'nama_event' => 'Summer Music Festival 2026',
                'tanggal_mulai' => '2026-08-05 16:00:00',
                'lokasi' => 'Taman Impian Jaya Ancol',
                'google_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.45!2d106.883!3d-6.122!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1',
                'kategori_id' => 6,
            ],
            [
                'nama_event' => 'Art & Photography Exhibition 2026',
                'tanggal_mulai' => '2026-07-15 10:00:00',
                'lokasi' => 'Museum Nasional Indonesia',
                'google_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.3!2d106.81!3d-6.19!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1',
                'kategori_id' => 7,
            ],
            [
                'nama_event' => 'Futsal Championship Southeast Asia',
                'tanggal_mulai' => '2026-08-10 09:00:00',
                'lokasi' => 'Bola Futsal Arena, Bandung',
                'google_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.1!2d107.6!3d-6.9!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1',
                'kategori_id' => 8,
            ],
            [
                'nama_event' => 'Web Development Workshop',
                'tanggal_mulai' => '2026-06-28 13:00:00',
                'lokasi' => 'Campus X, Jakarta Selatan',
                'google_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.9!2d106.75!3d-6.275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1',
                'kategori_id' => 5,
            ],
            [
                'nama_event' => 'Indonesia Fashion Week 2026',
                'tanggal_mulai' => '2026-08-01 18:00:00',
                'lokasi' => 'Jakarta Convention Center',
                'google_maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.2!2d106.8!3d-6.192!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1',
                'kategori_id' => 3,
            ],
        ];

        $organizers = ProfilOrganizer::all();
        if ($organizers->isEmpty()) {
            $this->call(ProfilOrganizerSeeder::class);
            $organizers = ProfilOrganizer::all();
        }

        foreach ($events as $index => $event) {
            $event['organizer_id'] = $organizers[$index % $organizers->count()]->organizer_id;
            Event::create($event);
        }
    }
}
