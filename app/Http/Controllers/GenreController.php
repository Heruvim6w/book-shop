<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        return $genre->with('books')->get();
    }
}
