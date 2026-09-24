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
        // 1. Validasi input dari form landing page
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nickname' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'barang_id' => 'required|exists:items,id',
            'keterangan' => 'required|string',
        ]);

        // Generate unique loan code
        do {
            $loanCode = 'PJ-' . rand(10000, 99999);
        } while (Loan::where('loan_code', $loanCode)->exists());

        // 2. Simpan ke database (Tabel loans)
        Loan::create([
            'loan_code' => $loanCode,
            'borrower_name' => $request->nama,
            'nickname' => $request->nickname,
            'phone_number' => $request->whatsapp,
            'email' => $request->email,
            'borrow_date' => $request->tanggal_pinjam,
            'return_date' => $request->tanggal_kembali,
            'item_id' => $request->barang_id,
            'purpose' => $request->keterangan,
            'status' => 'pending', // Status awal masuk ke admin
        ]);

        // 3. Redirect LANGSUNG ke halaman lacak status bawa keyword kodenya!
        return redirect()->route('lacak.status', ['keyword' => $loanCode])
                         ->with('success', 'Permohonan berhasil dikirim!');
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

    public function trackStatus(Request $request)
    {
        $keyword = $request->input('keyword'); 
        $loan = null;

        if ($keyword) {
            $loan = \App\Models\Loan::where('loan_code', $keyword)
                      ->orWhere('phone_number', $keyword)
                      ->with('item')
                      ->first();
        }

        return view('lacak-status', compact('loan', 'keyword'));
    }
}