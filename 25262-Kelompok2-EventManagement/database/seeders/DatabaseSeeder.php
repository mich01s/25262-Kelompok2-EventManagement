<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user (regular user)
        User::firstOrCreate([
            'email' => 'user@example.com',
        ], [
            'username' => 'testuser',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // Create admin user
        User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'username' => 'admin',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Run other seeders
        $this->call([
            KategoriEventSeeder::class,
            ProfilOrganizerSeeder::class,
            EventSeeder::class,
            TiketSeeder::class,
            TransaksiSeeder::class,
        ]);
    }
}
