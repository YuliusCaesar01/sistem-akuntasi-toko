<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Invoice;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('invoice')->get();
        return view('purchases.index', compact('purchases'));
    }

    public function create()
    {
        $products = Product::all();
        return view('purchases.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'products.*.product_code' => 'required|exists:products,product_code',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            // Generate a unique invoice number
            $invoiceNumber = 'INV-' . time();
            $totalAmount = 0;

            // Create the invoice
            $invoice = Invoice::create([
                'invoice_number' => $invoiceNumber,
                'total_amount' => 0, // Will be updated later
            ]);

            foreach ($request->products as $productData) {
                $product = Product::where('product_code', $productData['product_code'])->first();
                $total_price = $product->product_price * $productData['quantity'];
                $totalAmount += $total_price;

                // Create the purchase
                Purchase::create([
                    'invoice' => $invoiceNumber,
                    'product_code' => $productData['product_code'],
                    'quantity' => $productData['quantity'],
                    'total_price' => $total_price,
                ]);

                // Reduce product quantity
                $product->product_quantity -= $productData['quantity'];
                $product->save();
            }

            // Update the total amount in the invoice
            $invoice->update(['total_amount' => $totalAmount]);
        });

        return redirect()->route('purchases.index')->with('success', 'Purchase successful!');
    }

    public function show($id)
    {
        $purchase = Purchase::findOrFail($id);
        return view('purchases.show', compact('purchase'));
    }
}
