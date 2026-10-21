<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'type' => 'required|in:IN,OUT',
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        if ($validated['type'] === 'OUT' && $product->stock < $validated['quantity']) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }

        // Catat pergerakan stok
        StockMovement::create([
            'product_id' => $product->id,
            'type' => $validated['type'],
            'quantity' => $validated['quantity'],
            'notes' => $validated['notes'],
        ]);

        // Update jumlah stok produk
        if ($validated['type'] === 'IN') {
            $product->increment('stock', $validated['quantity']);
        } else {
            $product->decrement('stock', $validated['quantity']);
        }

        return back()->with('success', 'Stok berhasil diperbarui!');
    }
}