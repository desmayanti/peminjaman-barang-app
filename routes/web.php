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
Route::post('/loans/store', [LoanPublicController::class, 'store'])->name('loans.store');
Route::get('/pinjam/sukses/{loan_code}', [LoanPublicController::class, 'success'])->name('loans.success');
Route::get('/cek-status', [LoanPublicController::class, 'track'])->name('loans.track');
Route::get('/lacak-status', [LoanPublicController::class, 'trackStatus'])->name('lacak.status');
Route::get('/katalog-inventaris', [\App\Http\Controllers\InventoryController::class, 'index'])->name('katalog.inventaris');

/*
|--------------------------------------------------------------------------
| Secret Admin Entrance (Pintu Rahasia Portal Admin)
|--------------------------------------------------------------------------
*/
Route::get('/akses-portal-admin', function (\Illuminate\Http\Request $request) {
    if (\Illuminate\Support\Facades\Auth::check()) {
        \Illuminate\Support\Facades\Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }
    return redirect()->route('login');
})->name('admin.portal');

/*
|--------------------------------------------------------------------------
| Admin & Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Admin Loans Management
    Route::get('/admin/loans', [AdminLoanController::class, 'index'])->name('admin.loans.index');
    Route::match(['get', 'post'], '/admin/loans/cetak-pdf', [AdminLoanController::class, 'cetakPdf'])->name('admin.loans.cetak');
    Route::patch('/admin/loans/{id}/status', [AdminLoanController::class, 'updateStatus'])->name('admin.loans.update');
    Route::post('/admin/loans/{loan}/dates', [AdminLoanController::class, 'updateDates'])->name('admin.loans.dates');

    // Admin Items Management
    Route::get('/admin/items', [\App\Http\Controllers\Admin\AdminItemController::class, 'index'])->name('admin.items.index');
    Route::get('/admin/items/create', [\App\Http\Controllers\Admin\AdminItemController::class, 'create'])->name('admin.items.create');
    Route::post('/admin/items', [\App\Http\Controllers\Admin\AdminItemController::class, 'store'])->name('admin.items.store');
    Route::get('/admin/items/{item}/edit', [\App\Http\Controllers\Admin\AdminItemController::class, 'edit'])->name('admin.items.edit');
    Route::put('/admin/items/{item}', [\App\Http\Controllers\Admin\AdminItemController::class, 'update'])->name('admin.items.update');
    Route::delete('/admin/items/{item}', [\App\Http\Controllers\Admin\AdminItemController::class, 'destroy'])->name('admin.items.destroy');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';