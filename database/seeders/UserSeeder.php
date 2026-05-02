<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan tabel sebelum mengisi agar tidak ada duplikat
        DB::table('all_library_users')->truncate();

        DB::table('all_library_users')->insert([
            // Data dari tabel ADMIN (image_8869e8.png)
            [
                'username' => 'JawaJawa',
                'email' => 'jawa123@gmail.com',
                'password' => 'arara1038', // Password asli Anda
                'foto_profile' => null,
                'role' => 'admin',
                'created_at' => '2026-02-10 01:15:19',
                'updated_at' => '2026-02-10 01:15:19',
            ],
            // Data dari tabel SISWA (image_88671e.png)
            [
                'username' => 'Jeremy',
                'email' => 'jeremialintang4@gmail.com',
                'password' => 'harimau38', // Password asli Anda
                'foto_profile' => 'profile_photos/GnJDGjmzC16ffN62QeEgki7QiSj37QZLjne1ztkl.jpg',
                'role' => 'siswa',
                'created_at' => '2026-02-10 01:12:44',
                'updated_at' => '2026-03-26 23:35:21',
            ],
            [
                'username' => 'MasAnies',
                'email' => 'Anies123@gmail.com',
                'password' => 'kepuh123', // Password asli Anda
                'foto_profile' => 'profile_photos/ZecHfS5WediKXpslM9HDDUOarRcYwcDoMk82anDi.jpg',
                'role' => 'siswa',
                'created_at' => '2026-03-28 12:58:29',
                'updated_at' => '2026-03-28 13:18:54',
            ],
        ]);
    }
}