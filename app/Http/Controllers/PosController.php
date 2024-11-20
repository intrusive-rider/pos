<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('pos.create', ['products' => $products]);
    }
    
    public function checkout(Request $request)
    {
        $buyer = 'Safira';
        $quantities = $request->input('quantity'); // Get the array of product quantities

        // Step 1: Create the Transaction record
        $transaction = Transaction::create([
            'seller_id' => Auth::user()->id,
            'buyer' => $buyer,    // Store the buyer's name
            'total' => $this->calculateTotal($quantities),  // Calculate the total based on products
        ]);

        // Step 2: Create entries in the pivot table (transaction_product)
        foreach ($quantities as $prod_id => $quantity) {
            $product = Product::find($prod_id);

            if ($product && $quantity > 0) {
                // Create an entry in the pivot table linking the transaction and product with quantity
                $transaction->products()->attach($prod_id, ['quantity' => $quantity]);
            }

            // Reduce the stock of the product by the quantity purchased
            $product->decrement('stock', $quantity);  // Decrease stock by the quantity
        }

        return redirect('/');
    }

    protected function calculateTotal($quantities)
    {
        $total = 0;

        foreach ($quantities as $prod_id => $quantity) {
            $product = Product::find($prod_id);
            if ($product) {
                $total += $product->price * $quantity;
            }
        }

        return $total;
    }
}
