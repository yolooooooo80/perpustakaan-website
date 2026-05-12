<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->month ?? now()->format('m');
        $year = $request->year ?? now()->format('Y');

        $monthlyLoans = Loan::whereMonth('borrowed_at', $month)
            ->whereYear('borrowed_at', $year)
            ->with(['user', 'book'])
            ->get();

        $stats = [
            'total_loans' => $monthlyLoans->count(),
            'total_fines' => $monthlyLoans->sum('fine_amount'),
            'total_damage_fees' => $monthlyLoans->sum('damage_fee'),
            'returned_count' => $monthlyLoans->where('status', 'kembali')->count(),
            'damaged_count' => $monthlyLoans->where('status', 'rusak')->count(),
        ];

        return view('admin.reports', compact('stats', 'month', 'year', 'monthlyLoans'));
    }
}
