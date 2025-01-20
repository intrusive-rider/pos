<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('inventory.category.create');
    }

    public function store(Request $request, Category $category)
    {
        $attr = $request->validate([
            'name' => 'required|max:255|unique:categories,name',
        ]);

        Category::create($attr);
        return redirect()->route('index-product');
    }

    public function edit(Category $category)
    {
        return view('inventory.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $attr = $request->validate([
            'name' => 'required|max:255|unique:categories,name',
        ]);

        $category->update($attr);
        return redirect()->route('index-product');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }
}
