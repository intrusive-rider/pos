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
        $products = Product::all();
        $categories = Category::all();
        return view('product.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|max:255|unique:products,name',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'category' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,bmp|max:2048',
        ]);
        
        $category = $this->check_category($attr['category']);

        $attr['category_id'] = $category->id;
        unset($attr['category']);

        if ($request->hasFile('image')) {
            $attr['image'] = 'storage/' . $request->image->store('product_img', 'public');
        }

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
            'name' => 'required|max:255|unique:products,name',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = $this->check_category($attr['category']);

        $attr['category_id'] = $category->id;
        unset($attr['category']);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::exists($product->image)) {
                Storage::delete($product->image);
            }

            $attr['image'] = 'storage/' . $request->image->store('product_img', 'public');
        }

        $product->update($attr);
        return redirect()->route('index-product');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }

    protected function check_category($category_name)
    {
        $category = Category::where('name', $category_name)->first();

        if (is_null($category)) {
            $category = Category::create([
                'name' => $category_name
            ]);
        }

        return $category;
    }
}
