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

         
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName(); 
            $image->move(public_path('postimages'), $imageName); 
            $validatedData['image'] = 'postimages/' . $imageName; 
        }
        
        Product::create($validatedData);

        return redirect()->route('new-data')->with('message', 'Product has been saved successfully!');
    }

}
