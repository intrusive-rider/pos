<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class StockController extends Controller
{
    public function UpdateStocks()
    {
        return view('stock.product');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Menyimpan data produk
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->category = $request->input('category');

        
        // Menyimpan gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/postimage');
            $product->image = Storage::url($imagePath); // Mengambil URL gambar setelah diupload
        }

        $product->save();

        return redirect()->back()->with('success', 'Product has been saved successfully!');
    }

}
