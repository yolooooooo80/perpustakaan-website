<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with(['user', 'book.category'])->latest()->paginate(15);
        return view('loans.index', compact('loans'));
    }

    public function myLoans()
    {
        $loans = Loan::where('user_id', Auth::id())->with('book')->latest()->get();
        return view('loans.mine', compact('loans'));
    }

    public function store(Request $request, Book $book)
    {
        if ($book->stock <= 0) {
            return back()->with('warning', 'Stok buku habis.');
        }

        // Get duration from category or default 7
        $duration = $book->category->loan_duration_days ?? 7;

        Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'borrowed_at' => now(),
            'due_at' => now()->addDays($duration),
            'loan_duration' => $duration,
            'status' => 'aktif',
        ]);

        $book->decrement('stock');

        return redirect()->route('loans.mine')->with('success', 'Buku berhasil dipinjam.');
    }

    public function return(Request $request, Loan $loan)
    {
        $returnedAt = now();
        $dueAt = Carbon::parse($loan->due_at);
        $fineAmount = 0;

        if ($returnedAt->gt($dueAt)) {
            $daysLate = $returnedAt->diffInDays($dueAt);
            $finePerDay = $loan->book->category->fine_per_day ?? 1000;
            $fineAmount = $daysLate * $finePerDay;
        }

        $loan->update([
            'returned_at' => $returnedAt,
            'status' => 'kembali',
            'fine_amount' => $fineAmount,
            'notes' => $request->notes,
        ]);

        $loan->book->increment('stock');

        return back()->with('success', 'Buku dikembalikan. ' . ($fineAmount > 0 ? "Denda keterlambatan: Rp " . number_format($fineAmount) : ""));
    }

    public function updateFine(Request $request, Loan $loan)
    {
        $request->validate([
            'fine_amount' => 'required|numeric|min:0',
            'damage_fee' => 'nullable|numeric|min:0',
            'status' => 'required|in:aktif,kembali,rusak',
            'notes' => 'nullable|string',
            'notify' => 'nullable|boolean'
        ]);

        $loan->update([
            'fine_amount' => $request->fine_amount,
            'damage_fee' => $request->damage_fee ?? 0,
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        // Send chat notification if requested
        if ($request->notify) {
            $message = "Pemberitahuan dari Perpustakaan: Peminjaman buku '{$loan->book->title}' Anda telah diperbarui. ";
            if ($request->status === 'rusak') {
                $message .= "Status: RUSAK. Denda kerusakan: Rp " . number_format($request->damage_fee) . ". ";
            }
            $message .= "Catatan: " . ($request->notes ?? '-');

            Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $loan->user_id,
                'message' => $message,
            ]);
        }

        return back()->with('success', 'Data denda/status berhasil diperbarui dan notifikasi dikirim.');
    }
}
