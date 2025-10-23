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
                'file_path' => 'videos/test1.mp4'
            ],
            [
                'slug' => Str::slug('The Dark Knight', '-'),
                'title' => 'The Dark Knight',
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMTMxNTMwODM0NF5BMl5BanBnXkFtZTcwODAyMTk2Mw@@._V1_FMjpg_UY2048_.jpg',
                'file_path' => 'videos/test2.mp4'
            ],
            [
                'slug' => Str::slug('Inception', '-'),
                'title' => 'Inception',
                'poster_url' => 'https://m.media-amazon.com/images/M/MV5BMjAxMzY3NjcxNF5BMl5BanBnXkFtZTcwNTI5OTM0Mw@@._V1_FMjpg_UX700_.jpg',
                'file_path' => 'videos/test3.mp4'
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

        DB::table('movie_has_actor')->insert([
            [
                'movie_id' => 1,
                'actor_id' => 1
            ],
            [
                'movie_id' => 2,
                'actor_id' => 2
            ],
            [
                'movie_id' => 3,
                'actor_id' => 3
            ]
        ]);

        DB::table('movie_has_genre')->insert([
            [
                'movie_id' => 1,
                'genre_id' => 1
            ],
            [
                'movie_id' => 1,
                'genre_id' => 3
            ],
            [
                'movie_id' => 2,
                'genre_id' => 1
            ],
            [
                'movie_id' => 2,
                'genre_id' => 3
            ],
            [
                'movie_id' => 3,
                'genre_id' => 1
            ],
            [
                'movie_id' => 3,
                'genre_id' => 2
            ],
        ]);
    }
}
