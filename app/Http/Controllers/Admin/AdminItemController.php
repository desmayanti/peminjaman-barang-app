<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminItemController extends Controller
{
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

        return redirect()->route('admin.items.create')->with('success', 'Barang berhasil ditambahkan.');
    }
}
