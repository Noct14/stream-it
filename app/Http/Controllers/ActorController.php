<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actors = Actor::select('id', 'slug', 'name', 'image_url')->get();

        return Inertia::render('Actor/ActorIndex', [
            'actors' =>$actors
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
        $actor = DB::table('actors')->where('slug', $slug)->first();

        if (!$actor) {
            abort(404, 'Actor not found');
        }

        $movies = DB::table('movies')
            ->join('movie_has_actor', 'movies.id', '=', 'movie_has_actor.movie_id')
            ->join('actors', 'movie_has_actor.actor_id', '=', 'actors.id')
            ->where('actors.slug', $slug)
            ->select('movies.id', 'movies.slug', 'movies.title', 'movies.poster_url', 'movies.file_path')
            ->distinct()
            ->get();

        return Inertia::render('Actor/ActorShow', [
            'actor' => $actor,
            'movies' => $movies,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actor $actor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actor $actor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actor $actor)
    {
        //
    }
}
