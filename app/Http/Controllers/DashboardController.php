<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use App\Models\Loan;
use App\Models\User;
use App\Models\InventoryLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DashboardController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return $this->adminDashboard();
        } elseif ($user->role === 'pegawai') {
            return $this->pegawaiDashboard();
        } else {
            return $this->pengunjungDashboard();
        }
    }

    private function adminDashboard()
    {
        return view('admin.dashboard', [
            'stats' => [
                'totalBooks' => Book::count(),
                'totalUsers' => User::count(),
                'activeLoans' => Loan::whereNull('returned_at')->count(),
                'monthlyRevenue' => Loan::whereMonth('returned_at', Carbon::now()->month)->sum('fine_amount'),
            ],
            'recentInventory' => InventoryLog::with(['book', 'user'])->latest()->take(5)->get(),
            'currentBorrowers' => Loan::whereNull('returned_at')->with(['user', 'book'])->latest()->take(10)->get(),
            'registeredUsers' => User::latest()->take(5)->get(),
        ]);
    }

    private function pegawaiDashboard()
    {
        return view('pegawai.dashboard', [
            'stats' => [
                'totalBooks' => Book::count(),
                'activeLoans' => Loan::whereNull('returned_at')->count(),
                'overdueLoans' => Loan::whereNull('returned_at')->where('due_at', '<', now())->count(),
            ],
            'pendingActions' => Loan::whereNull('returned_at')->with(['user', 'book'])->orderBy('due_at', 'asc')->take(10)->get(),
            'categories' => Category::all(), // For editing loan rules
        ]);
    }

    private function pengunjungDashboard()
    {
        return view('pengunjung.dashboard', [
            'recommendations' => Book::with(['author', 'category'])->latest()->take(6)->get(),
            'myActiveLoans' => Loan::where('user_id', Auth::id())->whereNull('returned_at')->with('book')->get(),
            'myFineTotal' => Loan::where('user_id', Auth::id())->sum('fine_amount'),
        ]);
    }

    public function inventory()
    {
        $books = Book::all();
        $logs = InventoryLog::with(['book', 'user'])->latest()->paginate(15);
        return view('admin.inventory', compact('books', 'logs'));
    }

    public function storeInventory(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string'
        ]);

        $book = Book::find($request->book_id);
        
        if ($request->type === 'in') {
            $book->increment('stock', $request->quantity);
        } else {
            if ($book->stock < $request->quantity) {
                return back()->with('error', 'Stok tidak mencukupi untuk barang keluar.');
            }
            $book->decrement('stock', $request->quantity);
        }

        InventoryLog::create([
            'book_id' => $request->book_id,
            'user_id' => Auth::id(),
            'type' => $request->type,
            'quantity' => $request->quantity,
            'note' => $request->note
        ]);

        return back()->with('success', 'Log inventaris berhasil dicatat.');
    }

    public function reports()
    {
        $this->authorize('admin');
        
        $monthlyStats = Loan::selectRaw('strftime("%Y-%m", returned_at) as month, count(*) as total_loans, sum(fine_amount) as total_fines')
            ->whereNotNull('returned_at')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->get();

        return view('admin.reports', compact('monthlyStats'));
    }
}
