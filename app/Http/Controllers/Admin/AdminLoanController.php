<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;

class AdminLoanController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        $search = $request->query('search');

        $query = Loan::with('item')->latest();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('loan_code', 'like', "%{$search}%")
                  ->orWhere('nickname', 'like', "%{$search}%")
                  ->orWhere('borrower_name', 'like', "%{$search}%")
                  ->orWhere('phone_number', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $loans = $query->paginate(10)->withQueryString();

        $counts = [
            'all' => Loan::count(),
            'pending' => Loan::where('status', 'pending')->count(),
            'approved' => Loan::where('status', 'approved')->count(),
            'rejected' => Loan::where('status', 'rejected')->count(),
            'returned' => Loan::where('status', 'returned')->count(),
        ];

        return view('admin.loans.index', compact('loans', 'status', 'search', 'counts'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Cari data permohonan peminjaman
        $loan = \App\Models\Loan::with('item')->findOrFail($id);
        $newStatus = $request->status; // Status baru dari tombol yang diklik admin

        // 1. SKENARIO DISETUJUI -> STOK BERKURANG
        if ($newStatus == 'approved' && $loan->status == 'pending') {
            // Cek dulu, jangan sampai nyetujuin barang yang stoknya udah 0
            if ($loan->item->available_stock >= $loan->quantity) {
                $loan->update(['status' => 'approved']);
                $loan->item->decrement('available_stock', $loan->quantity); // Otomatis ngurangin stok barang
                return redirect()->back()->with('success', 'Disetujui! Stok barang otomatis berkurang.');
            } else {
                return redirect()->back()->with('error', 'Gagal! Stok barang tidak mencukupi.');
            }
        }

        // 2. SKENARIO DIKEMBALIKAN -> STOK BERTAMBAH (RESTOCK OTOMATIS)
        elseif ($newStatus == 'returned' && $loan->status == 'approved') {
            $loan->update(['status' => 'returned']);
            $loan->item->increment('available_stock', $loan->quantity); // Otomatis balikin stok barang
            return redirect()->back()->with('success', 'Barang dikembalikan! Stok otomatis bertambah.');
        }

        // 3. SKENARIO DITOLAK -> STOK AMAN (TIDAK BERUBAH)
        elseif ($newStatus == 'rejected' && $loan->status == 'pending') {
            $loan->update(['status' => 'rejected']);
            return redirect()->back()->with('success', 'Permohonan ditolak.');
        }

        return redirect()->back();
    }
    public function updateDates(Request $request, Loan $loan)
    {
        $validated = $request->validate([
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrow_date',
            'admin_notes' => 'nullable|string|max:500',
        ], [
            'borrow_date.required' => 'Tanggal pinjam wajib diisi.',
            'return_date.required' => 'Tanggal pengembalian wajib diisi.',
            'return_date.after_or_equal' => 'Tanggal pengembalian harus sama atau setelah tanggal pinjam.',
        ]);

        $loan->update([
            'borrow_date' => $validated['borrow_date'],
            'return_date' => $validated['return_date'],
            'admin_notes' => $validated['admin_notes'] ?? $loan->admin_notes,
        ]);

        return back()->with('success', "Tanggal peminjaman #{$loan->loan_code} berhasil diperbarui.");
    }
}