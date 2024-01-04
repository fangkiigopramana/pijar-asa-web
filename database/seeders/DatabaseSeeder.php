<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Lesson;
use App\Models\LessonSubscribe;
use App\Models\Post;
use App\Models\Submission;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Untuk Murid
        User::create([
            'name' => "Fangki Igo Pramana",
            'role' => "murid",
            'email' => "fangki@gmail.com",
            'gender' => "L",
            'nama_wali' => "ayah fangki",
            'nomor_handphone' => "0818181818",
            'alamat' => 'Lorem ipsum dolor sit amet consectetur',
            'tempat_lahir' => "tegal",
            'tanggal_lahir' => '1990-01-01', // Sesuaikan dengan tanggal lahir Fangki
            'password' => Hash::make('12345678')
        ]);

        // Untuk Pengajar
        User::create([
            'name' => "Fulan",
            'role' => "pengajar",
            'email' => "fulan@gmail.com",
            'gender' => "L",
            'nomor_handphone' => "0818181818",
            'alamat' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium',
            'mata_pelajaran' => 'Matematika',
            'pendidikan_terakhir' => 'D4/S1',
            'password' => Hash::make('11111111')
        ]);
    }
}
