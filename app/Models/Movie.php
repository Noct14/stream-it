<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable =
    [
        "slug",
        "title",
        "poster_url",
        "file_path"
    ];
}
