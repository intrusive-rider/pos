<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('category.create');
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
        return view('category.edit', compact('category'));
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
