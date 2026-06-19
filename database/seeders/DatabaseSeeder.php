<?php

namespace Database\Seeders;

use App\Models\Layanan;
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
        foreach ([
            ['nama_layanan' => 'Cuci Kering', 'harga_perkg' => 7000],
            ['nama_layanan' => 'Cuci Setrika', 'harga_perkg' => 10000],
            ['nama_layanan' => 'Setrika Saja', 'harga_perkg' => 6000],
            ['nama_layanan' => 'Express', 'harga_perkg' => 15000],
        ] as $layanan) {
            Layanan::firstOrCreate(
                ['nama_layanan' => $layanan['nama_layanan']],
                ['harga_perkg' => $layanan['harga_perkg']]
            );
        }

        User::firstOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'password' => bcrypt('password'),
        ]);
    }
}
