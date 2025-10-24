<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class GenreController extends Controller
{
    public function index()
    {
        $genres = DB::table('genres')->select('id', 'name', 'slug')->get();
        return Inertia::render('admin/genres/Index', ['genres' => $genres]);
    }

    public function create()
    {
        return Inertia::render('admin/genres/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:genres,slug',
        ]);

        DB::table('genres')->insert($validated);
        return redirect()->route('admin.genres.index');
    }

    public function edit($id)
    {
        $genre = DB::table('genres')->where('id', $id)->first();
        return Inertia::render('admin/genres/Edit', ['genre' => $genre]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:genres,slug,' . $id,
        ]);

        DB::table('genres')->where('id', $id)->update($validated);
        return redirect()->route('admin.genres.index');
    }

    public function destroy($id)
    {
        DB::table('genres')->where('id', $id)->delete();
        return redirect()->route('admin.genres.index');
    }
}
