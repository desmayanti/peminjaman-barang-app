<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoanPublicController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $search = $request->query('search');

        $query = Item::query();

        if ($category && $category !== 'Semua') {
            $query->where('category', $category);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $items = $query->orderBy('available_stock', 'desc')->get();
        $categories = Item::select('category')->distinct()->pluck('category');

        $stats = [
            'total_items' => Item::count(),
            'available_items' => Item::where('available_stock', '>', 0)->count(),
            'total_loans' => Loan::count(),
            'active_loans' => Loan::whereIn('status', ['pending', 'approved'])->count(),
        ];

        return view('welcome', compact('items', 'categories', 'stats', 'category', 'search'));
    }

    public function create($itemId = null)
    {
        $selectedItem = null;
        if ($itemId) {
            $selectedItem = Item::find($itemId);
        }

        $items = Item::where('available_stock', '>', 0)->orderBy('name')->get();

        return view('loans.create', compact('items', 'selectedItem'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nickname' => 'required|string|max:50',
            'borrower_name' => 'required|string|max:100',
            'phone_number' => 'required|string|max:25',
            'email' => 'required|email|max:100',
            'item_id' => 'required|exists:items,id',
            'quantity' => 'required|integer|min:1',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date|after_or_equal:borrow_date',
            'purpose' => 'required|string|max:1000',
        ], [
            'nickname.required' => 'Nickname peminjam wajib diisi.',
            'borrower_name.required' => 'Nama lengkap peminjam wajib diisi.',
            'phone_number.required' => 'Nomor telepon/WhatsApp wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'item_id.required' => 'Silakan pilih barang yang ingin dipinjam.',
            'quantity.required' => 'Jumlah barang wajib diisi minimal 1 unit.',
            'borrow_date.required' => 'Tanggal peminjaman wajib ditentukan.',
            'borrow_date.after_or_equal' => 'Tanggal peminjaman tidak boleh tanggal kemarin.',
            'return_date.required' => 'Tanggal pengembalian wajib ditentukan.',
            'return_date.after_or_equal' => 'Tanggal pengembalian harus sama atau setelah tanggal peminjaman.',
            'purpose.required' => 'Keperluan/tujuan peminjaman barang wajib diisi.',
        ]);

        $item = Item::findOrFail($validated['item_id']);

        if ($item->available_stock < $validated['quantity']) {
            return back()->withInput()->withErrors([
                'quantity' => "Stok barang tidak mencukupi. Sisa stok tersedia: {$item->available_stock} unit.",
            ]);
        }

        // Generate unique loan code (e.g. PJ-78241)
        do {
            $loanCode = 'PJ-' . rand(10000, 99999);
        } while (Loan::where('loan_code', $loanCode)->exists());

        $validated['loan_code'] = $loanCode;
        $validated['status'] = 'pending';

        $loan = Loan::create($validated);

        return redirect()->route('loans.success', $loan->loan_code);
    }

    public function success($loan_code)
    {
        $loan = Loan::with('item')->where('loan_code', $loan_code)->firstOrFail();

        return view('loans.success', compact('loan'));
    }

    public function track(Request $request)
    {
        $query = $request->query('query');
        $loan = null;
        $loans = null;

        if ($query) {
            $trimmed = trim($query);
            $loans = Loan::with('item')
                ->where('loan_code', $trimmed)
                ->orWhere('phone_number', $trimmed)
                ->orWhere('email', $trimmed)
                ->orWhere('nickname', 'like', "%{$trimmed}%")
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('loans.track', compact('loans', 'query'));
    }
}