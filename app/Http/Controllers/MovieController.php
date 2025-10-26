<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;
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

    public function search(Request $request)
    {
        $query = trim($request->input('q'));

        // Kalau kosong, langsung redirect balik biar gak query kosong
        if (empty($query)) {
            return redirect()->back();
        }

        // Cari movie berdasarkan title
        $movies = DB::table('movies')
            ->select('id', 'slug', 'title', 'poster_url')
            ->where('title', 'like', "%{$query}%")
            ->get();

        $actors = DB::table('actors')
            ->select('id', 'slug', 'name', 'image_url')
            ->where('name', 'like', "%{$query}%")
            ->get();

        return inertia('Home/Search', [
            'query' => $query,
            'movies' => $movies,
            'actors' => $actors,
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
