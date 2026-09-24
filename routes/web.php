<?php

use App\Http\Controllers\Admin\AdminLoanController;
use App\Http\Controllers\LoanPublicController;
use App\Http\Controllers\ProfileController;
use App\Models\Item;
use App\Models\Loan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Landing Page, Form Pinjam, Tracking)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    // Hitung data real-time dari database
    $totalAset = Item::count();
    $barangSiap = Item::where('available_stock', '>', 0)->count();
    $totalPeminjaman = Loan::count();
    $sedangDiproses = Loan::whereIn('status', ['pending', 'approved'])->count();

    // Kirim datanya ke file welcome.blade.php
    return view('welcome', compact('totalAset', 'barangSiap', 'totalPeminjaman', 'sedangDiproses'));
})->name('home');
Route::get('/pinjam/{item?}', [LoanPublicController::class, 'create'])->name('loans.create');
Route::post('/pinjam/store', [LoanPublicController::class, 'store'])->name('pinjam.store');
Route::get('/pinjam/sukses/{loan_code}', [LoanPublicController::class, 'success'])->name('loans.success');
Route::get('/cek-status', [LoanPublicController::class, 'track'])->name('loans.track');
Route::get('/lacak-status', [LoanPublicController::class, 'trackStatus'])->name('lacak.status');
Route::get('/katalog-inventaris', [\App\Http\Controllers\InventoryController::class, 'index'])->name('katalog.inventaris');

/*
|--------------------------------------------------------------------------
| Admin & Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Admin Loans Management
    Route::get('/admin/loans', [AdminLoanController::class, 'index'])->name('admin.loans.index');
    Route::patch('/admin/loans/{id}/status', [AdminLoanController::class, 'updateStatus'])->name('admin.loans.update');
    Route::post('/admin/loans/{loan}/dates', [AdminLoanController::class, 'updateDates'])->name('admin.loans.dates');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';