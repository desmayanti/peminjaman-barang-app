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
        // Deteksi jenis pengajuan ('minta' vs 'pinjam')
        $itemId = $request->input('barang_id') ?? $request->input('item_id');
        $item = $itemId ? Item::find($itemId) : null;
        $isMinta = $request->input('request_type_welcome') === 'minta'
                || $request->input('request_type') === 'minta'
                || ($item && $item->is_consumable);

        $dateStartField = $request->has('tanggal_pinjam') ? 'tanggal_pinjam' : 'borrow_date';
        $dateEndField = $request->has('tanggal_kembali') ? 'tanggal_kembali' : 'return_date';

        // 1. Validasi input: jika 'minta', tanggal selesai/kembali boleh null/tidak wajib
        $rules = [
            'nama' => 'sometimes|required_without:borrower_name|string|max:255',
            'borrower_name' => 'sometimes|required_without:nama|string|max:255',
            'nickname' => 'required|string|max:255',
            'whatsapp' => 'sometimes|required_without:phone_number|string|max:255',
            'phone_number' => 'sometimes|required_without:whatsapp|string|max:255',
            'email' => 'required|email|max:255',
            'quantity' => 'nullable|integer|min:1',
            $dateStartField => 'required|date',
            'barang_id' => 'sometimes|required_without:item_id|exists:items,id',
            'item_id' => 'sometimes|required_without:barang_id|exists:items,id',
            'keterangan' => 'sometimes|required_without:purpose|string',
            'purpose' => 'sometimes|required_without:keterangan|string',
        ];

        if ($isMinta) {
            $rules[$dateEndField] = 'nullable';
        } else {
            $rules[$dateEndField] = "required|date|after_or_equal:{$dateStartField}";
        }

        $request->validate($rules);

        // Nilai tanggal_selesai dipaksa null jika jenisnya 'Minta Barang'
        $tanggalSelesai = $isMinta ? null : ($request->input('tanggal_kembali') ?? $request->input('return_date') ?? $request->input('tanggal_selesai'));

        // Generate unique loan code
        do {
            $loanCode = 'PJ-' . rand(10000, 99999);
        } while (Loan::where('loan_code', $loanCode)->exists());

        // 2. Simpan ke database (Tabel loans)
        Loan::create([
            'loan_code' => $loanCode,
            'borrower_name' => $request->input('nama') ?? $request->input('borrower_name'),
            'nickname' => $request->input('nickname'),
            'phone_number' => $request->input('whatsapp') ?? $request->input('phone_number'),
            'email' => $request->input('email'),
            'quantity' => $request->input('quantity', 1),
            'borrow_date' => $request->input('tanggal_pinjam') ?? $request->input('borrow_date'),
            'return_date' => $tanggalSelesai,
            'tanggal_selesai' => $tanggalSelesai,
            'type' => $isMinta ? 'minta' : 'pinjam',
            'item_id' => $itemId,
            'purpose' => $request->input('keterangan') ?? $request->input('purpose'),
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