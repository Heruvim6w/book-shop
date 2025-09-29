<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $books = Book::existBooks()->get();
        $authors = Author::whoseBooksExist()->get();

        return view('index', compact(
            'books',
            'authors',
        ));
    }
}
