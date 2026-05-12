<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Get all books in the catalog.
     */
    public function books(Request $request)
    {
        $books = Book::with(['author', 'category'])
            ->when($request->search, function($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%");
            })
            ->paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => $books
        ]);
    }

    /**
     * Get library statistics.
     */
    public function stats()
    {
        return response()->json([
            'status' => 'success',
            'data' => [
                'total_books' => Book::count(),
                'total_members' => User::where('role', 'pengunjung')->count(),
                'active_loans' => Loan::whereNull('returned_at')->count(),
                'total_fines' => Loan::sum('fine_amount'),
            ]
        ]);
    }

    /**
     * Get book detail.
     */
    public function bookDetail(Book $book)
    {
        return response()->json([
            'status' => 'success',
            'data' => $book->load(['author', 'category'])
        ]);
    }
}
