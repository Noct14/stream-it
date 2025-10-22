<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable =
    [
        "slug",
        "name",
        "image_url"
    ];
}
