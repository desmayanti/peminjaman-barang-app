<?php

use App\Http\Controllers\Admin\AdminLoanController;
use App\Http\Controllers\LoanPublicController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Landing Page, Form Pinjam, Tracking)
|--------------------------------------------------------------------------
*/
Route::get('/', [LoanPublicController::class, 'index'])->name('home');
Route::get('/pinjam/{item?}', [LoanPublicController::class, 'create'])->name('loans.create');
Route::post('/pinjam', [LoanPublicController::class, 'store'])->name('loans.store');
Route::get('/pinjam/sukses/{loan_code}', [LoanPublicController::class, 'success'])->name('loans.success');
Route::get('/cek-status', [LoanPublicController::class, 'track'])->name('loans.track');

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
        Route::post('/admin/loans/{loan}/status', [AdminLoanController::class, 'updateStatus'])->name('admin.loans.status');
    Route::post('/admin/loans/{loan}/dates', [AdminLoanController::class, 'updateDates'])->name('admin.loans.dates');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';