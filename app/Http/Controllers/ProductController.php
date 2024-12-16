<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Category::find($value)) {
                        $fail('The selected category is invalid.');
                    }
                },
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $attr['category_id'] = $attr['category'];
        unset($attr['category']);

        if ($request->hasFile('image')) {
            $attr['image'] = 'storage/' . $request->image->store('product_img', 'public');
        }

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '_' . $image->getClientOriginalName(); 
        //     $image->move(public_path('product_img'), $imageName); 
        //     $attr['image'] = 'product_img/' . $imageName; 
        // }

        Product::create($attr);
        return redirect()->route('index-product');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Category::find($value)) {
                        $fail('The selected category is invalid.');
                    }
                },
            ],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $attr['category_id'] = $attr['category'];
        unset($attr['category']);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            $attr['image'] = 'storage/' . $request->image->store('product_img', 'public');
        }

        // if ($request->hasFile('image')) {
        //     // Hapus gambar lama jika ada
        //     if ($product->image && file_exists(public_path($product->image))) {
        //         unlink(public_path($product->image));
        //     }
        //     // Simpan gambar baru
        //     $image = $request->file('image');
        //     $imageName = time() . '_' . $image->getClientOriginalName();
        //     $image->move(public_path('product_img'), $imageName);
        //     $attr['image'] = 'product_img/' . $imageName;
        // }

        $product->update($attr);
        return redirect()->route('index-product');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }
}
