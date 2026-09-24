<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        // Query to get all items from the database
        $items = Item::all();
        
        // Return to the katalog-inventaris view
        return view('katalog-inventaris', compact('items'));
    }
}
