<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Memanggil stok barang kategori rokok
    public function showCigarettes()
    {
        $cigarettes = Product::where('category', 'cigarettes')->get();
        return view('stock-barang.rokok', compact('cigarettes'));
    }

    // Memanggil stok barang kategori Sembako
    public function showGroceries()
    {
        $groceries = Product::where('category', 'groceries')->get();
        return view('stock-barang.sembako', compact('groceries'));
    }

    // Memanggil stok barang kategori Minuman
    public function showDrinks()
    {
        $drinks = Product::where('category', 'drinks')->get();
        return view('stock-barang.minuman', compact('drinks'));
    }

    // Memanggil stok barang kategori Gas
    public function showGas()
    {
        $gas = Product::where('category', 'gas')->get();
        return view('stock-barang.gas', compact('gas'));
    }
    
    
}
