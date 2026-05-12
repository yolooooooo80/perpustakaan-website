<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookApiController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'category'])->get();
        return response()->json([
            'success' => true,
            'data' => $books
        ]);
    }

    public function show(Book $book)
    {
        return response()->json([
            'success' => true,
            'data' => $book->load(['author', 'category'])
        ]);
    }
}
