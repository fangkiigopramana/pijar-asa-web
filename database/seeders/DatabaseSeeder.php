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

        // Create lesson oleh pengajar
        // Lesson::create([
        //     'user_id' => 2,
        //     'code' => substr(Str::random(5) . time(), 0, 5),
        //     'title' => 'Agama Dasar',
        //     'description' => 'Pelajaran tentang konsep dasar dalam matematika, termasuk penjumlahan, pengurangan, perkalian, dan pembagian.'
        // ]);
        
        // Lesson::create([
        //     'user_id' => 2,
        //     'code' => substr(Str::random(5) . time(), 0, 5),
        //     'title' => 'Jaringan Dasar',
        //     'description' => 'Pelajaran tentang dasar-dasar pemrograman menggunakan bahasa seperti Python dan Java.'
        // ]);
        
        // Lesson::create([
        //     'user_id' => 2,
        //     'code' => substr(Str::random(5) . time(), 0, 5),
        //     'title' => 'Bahasa Inggris',
        //     'description' => 'Pelajaran untuk meningkatkan keterampilan berbahasa Inggris dalam mendengarkan, berbicara, membaca, dan menulis.'
        // ]);
        

        // Join Lesson oleh murid
        // LessonSubscribe::create([
        //     'user_id' => 1,
        //     'lesson_id' => 1
        // ]);
        // LessonSubscribe::create([
        //     'user_id' => 1,
        //     'lesson_id' => 2
        // ]);
        // LessonSubscribe::create([
        //     'user_id' => 1,
        //     'lesson_id' => 3
        // ]);

        // Create Conversation untuk setiap kelas/lesson
        Post::create([
            'lesson_id' => 1,
            'title' => "Lorem ipsum dolor sit amet",
            'category' => "task",
            'description' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum mollitia beatae consectetur architecto quod sapiente nisi ex maiores quos nam",
            'score_max' => "90",
        ]);
        Post::create([
            'lesson_id' => 2,
            'title' => "Lorem ipsum dolor sit amet",
            'category' => "materi",
            'description' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum mollitia beatae consectetur architecto quod sapiente nisi ex maiores quos nam",
        ]);
        Post::create([
            'lesson_id' => 2,
            'title' => "Lorem ipsum dolor sit amet",
            'category' => "task",
            'description' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum mollitia beatae consectetur architecto quod sapiente nisi ex maiores quos nam",
            'score_max' => "90",
        ]);
        Post::create([
            'lesson_id' => 3,
            'title' => "Lorem ipsum dolor sit amet",
            'category' => "materi",
            'description' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum mollitia beatae consectetur architecto quod sapiente nisi ex maiores quos nam",
        ]);
        Post::create([
            'lesson_id' => 1,
            'title' => "Lorem ipsum dolor sit amet",
            'category' => "materi",
            'description' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum mollitia beatae consectetur architecto quod sapiente nisi ex maiores quos nam",
        ]);
        Post::create([
            'lesson_id' => 3,
            'title' => "Lorem ipsum dolor sit amet",
            'category' => "materi",
            'description' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum mollitia beatae consectetur architecto quod sapiente nisi ex maiores quos nam",
        ]);
        Post::create([
            'lesson_id' => 3,
            'title' => "Lorem ipsum dolor sit amet",
            'category' => "materi",
            'description' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Earum mollitia beatae consectetur architecto quod sapiente nisi ex maiores quos nam",
        ]);
        // Post::create([
        //     'lesson_id' => 1,
        //     'title' => "lorem30",
        //     'category' => "material",
        //     'description' => "lorem44444mmmm",
        //     'score_max' => "90",
        // ]);

        // Submission::create([
        //     'post_id' => 1,
        //     'user_id' => 1,
        //     'link_file' => "Lorem, ipsum dolor.",
        //     'score' => 100
        // ]);

        // $faker = Factory::create();
        // for ($i=0; $i < 10 ; $i++) { 
        //     User::create([
        //         'name' => $faker->name,
        //         'role' => 'murid',
        //         'email' => $faker->unique()->safeEmail,
        //         'gender' => $faker->randomElement(['L', 'P']),
        //         'nomor_handphone' => $faker->phoneNumber,
        //         'alamat' => $faker->address,
        //         'nama_wali' => $faker->name,
        //         'tempat_lahir' => $faker->city,
        //         'tanggal_lahir' => $faker->date,
        //         'password' => Hash::make('password'),
        //     ]);
        // }
    }
}
