<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class MovieController extends Controller
{
    public function index()
    {
        $movies = DB::table('movies')->select('id', 'title', 'slug', 'poster_url', 'file_path')->get();

        return Inertia::render('admin/movie/Index', [
            'movies' => $movies,
        ]);
    }

    public function create()
    {
        return Inertia::render('admin/movie/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:movies,slug',
            'poster_url' => 'nullable|string',
            'video' => 'required|file|mimetypes:video/mp4,video/mpeg,video/quicktime',
        ]);


        $path = $request->file('video')->store('videos');

        DB::table('movies')->insert([
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'poster_url' => $validated['poster_url'] ?? null,
            'file_path' => $path,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('admin.movies.index')->with('success', 'Movie created successfully!');
    }


    public function edit($id)
    {
        $movie = DB::table('movies')->where('id', $id)->first();

        return Inertia::render('admin/movie/Edit', [
            'movie' => $movie,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:movies,slug,' . $id,
            'poster_url' => 'nullable|string',
            'video' => 'nullable|file|mimetypes:video/mp4,video/mpeg,video/quicktime|max:512000',
        ]);

        $data = [
            'title' => $validated['title'],
            'slug' => $validated['slug'],
            'poster_url' => $validated['poster_url'] ?? null,
            'updated_at' => now(),
        ];

        if ($request->hasFile('video')) {
            $path = $request->file('video')->store('videos');
            $data['file_path'] = $path;
        }

        DB::table('movies')->where('id', $id)->update($data);

        return redirect()->route('admin.movies.index')->with('success', 'Movie updated successfully!');
    }


    public function destroy($id)
    {
        DB::table('movies')->where('id', $id)->delete();

        return redirect()->route('admin.movies.index')->with('success', 'Movie deleted!');
    }
}
