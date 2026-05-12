<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ApiController;

// Landing Page
Route::get('/', function () {
    $latestBooks = \App\Models\Book::with(['author', 'category'])->latest()->take(4)->get();
    return view('welcome', compact('latestBooks'));
});

// Auth Routes (Breeze)
require __DIR__.'/auth.php';

// Protected Routes
Route::middleware(['auth'])->group(function () {
    
    // Dashboard (Redirects based on role)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Chat System
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');

    // ROLE: ADMIN
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/reports', [DashboardController::class, 'reports'])->name('reports');
        Route::get('/users', [DashboardController::class, 'users'])->name('users');
        Route::get('/inventory', [DashboardController::class, 'inventory'])->name('inventory');
        Route::post('/inventory', [DashboardController::class, 'storeInventory'])->name('inventory.store');
    });

    // ROLE: PEGAWAI (Staff)
    Route::middleware(['role:pegawai,admin'])->prefix('staff')->name('staff.')->group(function () {
        Route::resource('books', BookController::class);
        Route::resource('authors', AuthorController::class);
        Route::resource('categories', CategoryController::class);
        
        // Fine & Loan Management
        Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
        Route::post('/loans/{loan}/return', [LoanController::class, 'return'])->name('loans.return');
        Route::post('/loans/{loan}/update-fine', [LoanController::class, 'updateFine'])->name('loans.update-fine');
    });

    // ROLE: PENGUNJUNG (Visitor)
    Route::middleware(['role:pengunjung,pegawai,admin'])->group(function () {
        Route::get('/browse', [BookController::class, 'browse'])->name('books.browse');
        Route::post('/books/{book}/borrow', [LoanController::class, 'store'])->name('books.borrow');
        Route::get('/my-loans', [LoanController::class, 'myLoans'])->name('loans.mine');
    });

});

// API Routes
Route::prefix('api')->group(function() {
    Route::get('/books', [ApiController::class, 'books']);
    Route::get('/books/{book}', [ApiController::class, 'bookDetail']);
    Route::get('/stats', [ApiController::class, 'stats']);
});
