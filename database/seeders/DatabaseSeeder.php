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
        // User::factory(10)->create();

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'role' => 'admin', 'password' => bcrypt('password')]
        );

        User::updateOrCreate(
            ['email' => 'petugas@example.com'],
            ['name' => 'Petugas User', 'role' => 'petugas', 'password' => bcrypt('password')]
        );

        User::updateOrCreate(
            ['email' => 'anggota@example.com'],
            ['name' => 'Anggota User', 'role' => 'anggota', 'password' => bcrypt('password')]
        );

        $this->call(BukuSeeder::class);
    }
}
