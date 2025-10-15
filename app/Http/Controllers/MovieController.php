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
        $movies = Movie::select('id', 'title', 'poster_url', 'file_path')->get();

        return Inertia::render('Movies/Index', [
            'movies' => $movies,
        ]);
    }
}
