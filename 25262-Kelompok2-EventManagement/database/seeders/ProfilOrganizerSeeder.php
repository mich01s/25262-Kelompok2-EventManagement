<?php

namespace Database\Seeders;

use App\Models\ProfilOrganizer;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilOrganizerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buat user organizer terlebih dahulu
        $organizers = [
            [
                'username' => 'organizer1',
                'email' => 'organizer1@example.com',
                'password' => bcrypt('password'),
                'role' => 'event_organizer',
            ],
            [
                'username' => 'organizer2',
                'email' => 'organizer2@example.com',
                'password' => bcrypt('password'),
                'role' => 'event_organizer',
            ],
            [
                'username' => 'organizer3',
                'email' => 'organizer3@example.com',
                'password' => bcrypt('password'),
                'role' => 'event_organizer',
            ],
        ];

        $organizerNames = [
            'PT Event Management Indonesia',
            'Creative Arts Production',
            'Global Event Organizer',
        ];

        foreach ($organizers as $index => $org) {
            $user = User::create($org);
            ProfilOrganizer::create([
                'user_id' => $user->user_id,
                'nama_organizer' => $organizerNames[$index],
            ]);
        }
    }
}
