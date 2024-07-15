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
        // Format the date as DDMM
        $datePart = date('dm');

        // Get the latest invoice number for today
        $latestInvoice = Invoice::where('invoice_number', 'like', 'INV-' . $datePart . '-%')
            ->orderBy('invoice_number', 'desc')
            ->first();

        // Determine the next sequence number
        if ($latestInvoice) {
            $lastSequence = (int) substr($latestInvoice->invoice_number, -3);
            $nextSequence = str_pad($lastSequence + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextSequence = '001';
        }

        // Generate the unique invoice number
        $invoiceNumber = 'INV-' . $datePart . '-' . $nextSequence;
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

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $purchase = Purchase::findOrFail($id);

            // Get the invoice number
            $invoiceNumber = $purchase->invoice;

            // Find all purchases with the same invoice number
            $purchases = Purchase::where('invoice', $invoiceNumber)->get();

            foreach ($purchases as $purchase) {
                // Restore product quantity
                $product = Product::where('product_code', $purchase->product_code)->first();
                $product->product_quantity += $purchase->quantity;
                $product->save();

                // Delete the purchase
                $purchase->delete();
            }

            // Optionally, delete the invoice if it has no more purchases
            Invoice::where('invoice_number', $invoiceNumber)->delete();
        });

        return redirect()->route('purchases.index')->with('success', 'All purchases with the same invoice deleted successfully!');
    }
}
