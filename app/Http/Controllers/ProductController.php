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

    // Memanggil stok barang kategori rokok
    public function showGroceries()
    {
        $groceries = Product::where('category', 'groceries')->get();
        return view('stock-barang.sembako', compact('groceries'));
    }
    
    
}
