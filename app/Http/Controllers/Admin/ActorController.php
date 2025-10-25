<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ActorController extends Controller
{
    public function index()
    {
        $actors = DB::table('actors')->select('id', 'name', 'slug', 'image_url')->get();
        return Inertia::render('admin/actors/Index', ['actors' => $actors]);
    }

    public function create()
    {
        return Inertia::render('admin/actors/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:actors,slug',
            'image_url' => 'nullable|url',

        ]);

        DB::table('actors')->insert($validated);
        return redirect()->route('admin.actors.index');
    }

    public function edit($id)
    {
        $actor = DB::table('actors')->where('id', $id)->first();
        return Inertia::render('admin/actors/Edit', ['actor' => $actor]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:actors,slug,' . $id,
            'image_url' => 'nullable|url',
        ]);

        DB::table('actors')->where('id', $id)->update($validated);
        return redirect()->route('admin.actors.index');
    }

    public function destroy($id)
    {
        DB::table('actors')->where('id', $id)->delete();
        return redirect()->route('admin.actors.index');
    }
}
