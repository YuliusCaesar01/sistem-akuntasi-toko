<?php

namespace App\Http\Controllers;

use App\Models\Pembelian;
use App\Models\Product;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    public function index()
    {
        $pembelians = Pembelian::with('product')->get();
        return view('transaksi', compact('pembelians'));
    }

    public function create()
    {
        $products = Product::all();
        return view('transaksi.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'invoice' => 'required|string',
            'product_code' => 'required|exists:products,code',
        ]);

        $product = Product::find($request->product_code);
        $pembelian = new Pembelian();
        $pembelian->invoice = $request->invoice;
        $pembelian->product_code = $product->product_code;
        $pembelian->category = $product->category;
        $pembelian->product_name = $product->product_name;
        $pembelian->product_price = $product->product_price;
        $pembelian->save();

        return redirect()->route('transaksi')
                         ->with('success', 'Pembelian created successfully.');
    }

    public function show(Pembelian $pembelian)
    {
        return view('transaksi.show', compact('pembelian'));
    }

    public function edit(Pembelian $pembelian)
    {
        $products = Product::all();
        return view('transaksi.edit', compact('pembelian', 'products'));
    }

    public function update(Request $request, Pembelian $pembelian)
    {
        $request->validate([
            'invoice' => 'required|string',
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::find($request->product_id);
        $pembelian->invoice = $request->invoice;
        $pembelian->product_code = $product->product_code;
        $pembelian->category = $product->category;
        $pembelian->product_name = $product->product_name;
        $pembelian->product_price = $product->product_price;
        $pembelian->save();

        return redirect()->route('transaksi')
                         ->with('success', 'Pembelian updated successfully.');
    }

    public function destroy(Pembelian $pembelian)
    {
        $pembelian->delete();

        return redirect()->route('transaksi')
                         ->with('success', 'Pembelian deleted successfully.');
    }
}
