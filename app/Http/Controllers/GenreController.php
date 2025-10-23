<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genre = Genre::select('id', 'name', 'slug')->get();

        return Inertia::render('Genre/GenreIndex', [
            'genre' => $genre,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $genre = DB::table('genres')->where('slug', $slug)->first();

        if (!$genre) {
            abort(404, 'Genre not found');
        }

        $movies = DB::table('movies')
            ->join('movie_has_genre', 'movies.id', '=', 'movie_has_genre.movie_id')
            ->join('genres', 'movie_has_genre.genre_id', '=', 'genres.id')
            ->where('genres.slug', $slug)
            ->select('movies.id', 'movies.slug', 'movies.title', 'movies.poster_url', 'movies.file_path')
            ->distinct()
            ->get();

        return Inertia::render('Genre/GenreShow', [
            'genre' => $genre,
            'movies' => $movies,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        //
    }
}
