<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
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
