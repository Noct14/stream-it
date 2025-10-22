<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'testuser@gmail.com',
            'password' => Hash::make('123'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
        ]);

        DB::table('movies')->insert([
            [
                'slug' => Str::slug('Avengers: Endgame', '-'),
                'title' => 'Avengers: Endgame',
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMTc5MDE2ODcwNV5BMl5BanBnXkFtZTgwMzI2NzQ2NzM@._V1_FMjpg_UX1000_.jpg',
                'file_path' => 'movies/avengers-endgame.mp4'
            ],
            [
                'slug' => Str::slug('The Dark Knight', '-'),
                'title' => 'The Dark Knight',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/id/8/8a/Dark_Knight.jpg',
                'file_path' => 'movies/the-dark-knight.mp4'
            ],
            [
                'slug' => Str::slug('Inception', '-'),
                'title' => 'Inception',
                'poster_url' => 'https://upload.wikimedia.org/wikipedia/id/9/91/Inception_poster.jpg',
                'file_path' => 'movies/inception.mp4'
            ],
        ]);

        DB::table('genres')->insert([
            [
                'slug' => Str::slug('Action', '-'),
                'name' => 'Action'
            ],
            [
                'slug' => Str::slug('Drama', '-'),
                'name' => 'Drama'
            ],
            [
                'slug' => Str::slug('Superhero', '-'),
                'name' => 'Superhero'
            ],
        ]);

        DB::table('actors')->insert([
            [
                'slug' => Str::slug('Robert Downey Jr.', '-'),
                'name' => 'Robert Downey Jr.',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/23/Robert_Downey_Jr._2014_Comic-Con.jpg/800px-Robert_Downey_Jr._2014_Comic-Con.jpg'
            ],
            [
                'slug' => Str::slug('Christian Bale', '-'),
                'name' => 'Christian Bale',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0a/Christian_Bale-7837.jpg/800px-Christian_Bale-7837.jpg'
            ],
            [
                'slug' => Str::slug('Leonardo DiCaprio', '-'),
                'name' => 'Leonardo DiCaprio',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f6/Leonardo_Dicaprio_-_World_Premiere_%E2%80%98One_Battle_after_Another%E2%80%99.jpg/800px-Leonardo_Dicaprio_-_World_Premiere_%E2%80%98One_Battle_after_Another%E2%80%99.jpg'
            ],
        ]);

    }
}
