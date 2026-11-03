<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminItemController extends Controller
{
    public function index()
    {
        $items = \App\Models\Item::orderBy('created_at', 'desc')->get();
        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        return view('admin.items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:items,code',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_stock' => 'required|integer|min:0',
            'is_consumable' => 'boolean',
            'max_request_qty' => 'nullable|integer|min:1',
        ]);

        $validated['is_consumable'] = $request->has('is_consumable');
        if (!$validated['is_consumable']) {
            $validated['max_request_qty'] = null;
        }

        $validated['available_stock'] = $validated['total_stock'];
        $validated['status'] = 'available';

        \App\Models\Item::create($validated);

        return redirect()->route('admin.items.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function edit(\App\Models\Item $item)
    {
        return view('admin.items.edit', compact('item'));
    }

    public function update(Request $request, \App\Models\Item $item)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:items,code,' . $item->id,
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'total_stock' => 'required|integer|min:0',
            'is_consumable' => 'boolean',
            'max_request_qty' => 'nullable|integer|min:1',
        ]);

        $validated['is_consumable'] = $request->has('is_consumable');
        if (!$validated['is_consumable']) {
            $validated['max_request_qty'] = null;
        }

        $stockDiff = $validated['total_stock'] - $item->total_stock;
        $validated['available_stock'] = $item->available_stock + $stockDiff;
        
        if ($validated['available_stock'] < 0) {
            return back()->withErrors(['total_stock' => 'Stok total tidak bisa kurang dari jumlah barang yang sedang dipinjam.']);
        }

        $item->update($validated);

        return redirect()->route('admin.items.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(\App\Models\Item $item)
    {
        if ($item->total_stock > $item->available_stock) {
            return redirect()->route('admin.items.index')->with('error', 'Barang tidak dapat dihapus karena sedang dipinjam.');
        }

        $item->delete();
        return redirect()->route('admin.items.index')->with('success', 'Barang berhasil dihapus.');
    }
}
