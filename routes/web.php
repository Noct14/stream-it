<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\GenreController;

Route::get('/home', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/', [MovieController::class, 'index'])->name('movies.index');

Route::get('/genre', [GenreController::class, 'index'])->name('genre.index');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
