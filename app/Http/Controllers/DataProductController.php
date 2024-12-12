<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DataProductController extends Controller
{
    public function DataProduct()
    {
        $products = Product::all(); 
        return view('data.table-product', compact('products'));
    }

    public function EditProduct($id)
    {
        $product = Product::findOrFail($id); 
        return view('data.edit-product', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('image')) {
            
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('postimages'), $imageName);
            $validatedData['image'] = 'postimages/' . $imageName;
        }

        $product->update($validatedData);

        return redirect()->route('new-data')->with('message', 'Product has been updated successfully!');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id); 

        $product->delete();

        return redirect()->back()->with('message', 'Product has been successfully deleted');
    }

}
