<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

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
    
    // Menambah Produk Sembako
    public function storeSembako(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric',
            'product_quantity' => 'required|integer',
        ]);
    
        // Get the highest product code from the database
        $lastProduct = Product::orderBy('product_code', 'desc')->first();
        $lastCode = $lastProduct ? $lastProduct->product_code : 'S-000';
    
        // Extract the numeric part and increment it
        $lastCodeNumber = intval(substr($lastCode, 2));
        $nextCodeNumber = str_pad($lastCodeNumber + 1, 3, '0', STR_PAD_LEFT);
    
        // Generate the new product code
        $newProductCode = 'S-' . $nextCodeNumber;
    
        Product::create([
            'category' => $request->category,
            'product_name' => $request->product_name,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'product_code' => $newProductCode, // Include the generated product code
        ]);
    
        return redirect()->route('stock-barang.sembako')->with('success', 'Product added successfully!');
    }
    


    // Menambah Stok Produk Sembako
    public function updateQuantitySembako(Request $request, $id)
    {
        $request->validate([
            'product_quantity' => 'required|integer|min:1',
        ]);
    
        $product = Product::findOrFail($id);
        $product->product_quantity += $request->product_quantity;
        $product->save();
    
        return redirect()->route('stock-barang.sembako')->with('success', 'Product quantity updated successfully!');
    }

    // Update Harga Sembako
    public function updatePrice(Request $request, $id)
    {
    $request->validate([
        'product_price' => 'required|numeric|min:0',
    ]);

    $product = Product::findOrFail($id);
    $product->product_price = $request->product_price;
    $product->save();

    return redirect()->route('stock-barang.sembako')->with('success', 'Product price updated successfully!');
    }

    // Menghapus Produk Sembako
    public function deleteSembako($id)
    {
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('stock-barang.sembako')->with('success', 'Product deleted successfully!');
    }

     // Menambah Produk Rokok
     public function storeRokok(Request $request)
{
    $request->validate([
        'category' => 'required|string|max:255',
        'product_name' => 'required|string|max:255',
        'product_price' => 'required|numeric',
        'product_quantity' => 'required|integer',
    ]);

    // Get the highest product code for 'R-' from the database
    $lastProduct = Product::where('product_code', 'like', 'R-%')
                          ->orderBy('product_code', 'desc')
                          ->first();
    $lastCode = $lastProduct ? $lastProduct->product_code : 'R-000';

    // Extract the numeric part and increment it
    $lastCodeNumber = intval(substr($lastCode, 2));
    $nextCodeNumber = str_pad($lastCodeNumber + 1, 3, '0', STR_PAD_LEFT);

    // Generate the new product code
    $newProductCode = 'R-' . $nextCodeNumber;

    Product::create([
        'category' => $request->category,
        'product_name' => $request->product_name,
        'product_price' => $request->product_price,
        'product_quantity' => $request->product_quantity,
        'product_code' => $newProductCode, 
    ]);

    return redirect()->route('stock-barang.rokok')->with('success', 'Product added successfully!');
}

 
     // Menambah Stok Produk Rokok
     public function updateQuantityRokok(Request $request, $id)
     {
         $request->validate([
             'product_quantity' => 'required|integer|min:1',
         ]);
     
         $product = Product::findOrFail($id);
         $product->product_quantity += $request->product_quantity;
         $product->save();
     
         return redirect()->route('stock-barang.rokok')->with('success', 'Product quantity updated successfully!');
     }

     // Update Harga Rokok
    public function updatePriceRokok(Request $request, $id)
    {
    $request->validate([
        'product_price' => 'required|numeric|min:0',
    ]);

    $product = Product::findOrFail($id);
    $product->product_price = $request->product_price;
    $product->save();

    return redirect()->route('stock-barang.rokok')->with('success', 'Product price updated successfully!');
    }
 
     // Menghapus Produk Rokok
     public function deleteRokok($id)
     {
     $product = Product::findOrFail($id);
     $product->delete();
 
     return redirect()->route('stock-barang.rokok')->with('success', 'Product deleted successfully!');
     }
     
    // Menambah Produk Minuman
    public function storeMinuman(Request $request)
{
    $request->validate([
        'category' => 'required|string|max:255',
        'product_name' => 'required|string|max:255',
        'product_price' => 'required|numeric',
        'product_quantity' => 'required|integer',
    ]);

    // Get the highest product code for 'M-' from the database
    $lastProduct = Product::where('product_code', 'like', 'M-%')
                          ->orderBy('product_code', 'desc')
                          ->first();
    $lastCode = $lastProduct ? $lastProduct->product_code : 'M-000';

    // Extract the numeric part and increment it
    $lastCodeNumber = intval(substr($lastCode, 2));
    $nextCodeNumber = str_pad($lastCodeNumber + 1, 3, '0', STR_PAD_LEFT);

    // Generate the new product code
    $newProductCode = 'M-' . $nextCodeNumber;

    Product::create([
        'category' => $request->category,
        'product_name' => $request->product_name,
        'product_price' => $request->product_price,
        'product_quantity' => $request->product_quantity,
        'product_code' => $newProductCode, // Include the generated product code
    ]);

    return redirect()->route('stock-barang.minuman')->with('success', 'Product added successfully!');
}

 
     // Menambah Stok Produk Minuman
     public function updateQuantityMinuman(Request $request, $id)
     {
         $request->validate([
             'product_quantity' => 'required|integer|min:1',
         ]);
     
         $product = Product::findOrFail($id);
         $product->product_quantity += $request->product_quantity;
         $product->save();
     
         return redirect()->route('stock-barang.minuman')->with('success', 'Product quantity updated successfully!');
     }

     // Update Harga Minuman
    public function updatePriceMinuman(Request $request, $id)
    {
    $request->validate([
        'product_price' => 'required|numeric|min:0',
    ]);

    $product = Product::findOrFail($id);
    $product->product_price = $request->product_price;
    $product->save();

    return redirect()->route('stock-barang.minuman')->with('success', 'Product price updated successfully!');
    }
 
     // Menghapus Produk Minuman
     public function deleteMinuman($id)
     {
     $product = Product::findOrFail($id);
     $product->delete();
 
     return redirect()->route('stock-barang.minuman')->with('success', 'Product deleted successfully!');
     }

     // Menambah Produk Gas
     public function storeGas(Request $request)
{
    $request->validate([
        'category' => 'required|string|max:255',
        'product_name' => 'required|string|max:255',
        'product_price' => 'required|numeric',
        'product_quantity' => 'required|integer',
    ]);

    // Get the highest product code for 'G-' from the database
    $lastProduct = Product::where('product_code', 'like', 'G-%')
                          ->orderBy('product_code', 'desc')
                          ->first();
    $lastCode = $lastProduct ? $lastProduct->product_code : 'G-000';

    // Extract the numeric part and increment it
    $lastCodeNumber = intval(substr($lastCode, 2));
    $nextCodeNumber = str_pad($lastCodeNumber + 1, 3, '0', STR_PAD_LEFT);

    // Generate the new product code
    $newProductCode = 'G-' . $nextCodeNumber;

    Product::create([
        'category' => $request->category,
        'product_name' => $request->product_name,
        'product_price' => $request->product_price,
        'product_quantity' => $request->product_quantity,
        'product_code' => $newProductCode, // Include the generated product code
    ]);

    return redirect()->route('stock-barang.gas')->with('success', 'Product added successfully!');
}

 
     // Menambah Stok Produk Gas
     public function updateQuantityGas(Request $request, $id)
     {
         $request->validate([
             'product_quantity' => 'required|integer|min:1',
         ]);
     
         $product = Product::findOrFail($id);
         $product->product_quantity += $request->product_quantity;
         $product->save();
     
         return redirect()->route('stock-barang.gas')->with('success', 'Product quantity updated successfully!');
     }

     // Update Harga Gas
    public function updatePriceGas(Request $request, $id)
    {
    $request->validate([
        'product_price' => 'required|numeric|min:0',
    ]);

    $product = Product::findOrFail($id);
    $product->product_price = $request->product_price;
    $product->save();

    return redirect()->route('stock-barang.gas')->with('success', 'Product price updated successfully!');
    }
 
     // Menghapus Produk Gas
     public function deleteGas($id)
     {
     $product = Product::findOrFail($id);
     $product->delete();
 
     return redirect()->route('stock-barang.gas')->with('success', 'Product deleted successfully!');
     }

     
}


