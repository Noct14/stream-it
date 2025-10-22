<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\VideoController;

Route::get('/home', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/', [MovieController::class, 'index'])->name('movies.index');

Route::get('/movie/{slug}', [MovieController::class, 'show'])->name('movies.show');

Route::get('/genre', [GenreController::class, 'index'])->name('genre.index');

Route::get('/actor', [ActorController::class, 'index'])->name('actor.index');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

Route::get('/videos/{filename}', [VideoController::class, 'stream']);
