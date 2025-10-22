<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::select('id', 'slug', 'title', 'poster_url', 'file_path')->get();

        return Inertia::render('Home/HomeIndex', [
            'movies' => $movies,
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
        // $moviesById = Movie::where('id', $id->id)->get();
        // $movie = Movie::findOrFail($id);
        $movie = Movie::where('slug', $slug)->firstOrFail();

        return Inertia::render('Home/MovieShow', [
            'movie' => $movie,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $genre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $genre)
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
