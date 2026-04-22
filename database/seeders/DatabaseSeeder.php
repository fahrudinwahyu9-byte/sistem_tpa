<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Santri;
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
        // Admin account
        User::create([
            'username' => 'admin_tpa',
            'password' => 'password123',
            'role' => User::ROLE_ADMIN,
        ]);

        // Sample Santri 1
        $u1 = User::create([
            'username' => 'wahyu',
            'password' => 'santri123',
            'role' => User::ROLE_SANTRI,
        ]);
        Santri::create([
            'user_id' => $u1->id,
            'nama_santri' => 'Wahyu Hidayat',
            'umur' => 10,
            'nama_wali' => 'Bapak Slamet',
            'jilid_bacaan' => 'Iqro 5',
        ]);

        // Sample Santri 2
        $u2 = User::create([
            'username' => 'annisa',
            'password' => 'santri123',
            'role' => User::ROLE_SANTRI,
        ]);
        Santri::create([
            'user_id' => $u2->id,
            'nama_santri' => 'Annisa Putri',
            'umur' => 11,
            'nama_wali' => 'Ibu Siti',
            'jilid_bacaan' => 'Al-Qur\'an',
        ]);
    }
}
