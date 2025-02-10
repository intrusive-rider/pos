<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\CategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Menampilkan hal. pembuatan kategori produk.
     */
    public function create()
    {
        return view('inventory.category.create');
    }

    /**
     * Menyimpan kategori produk.
     */
    public function store(CategoryRequest $request)
    {
        $attr = $request->validated();
        Category::create($attr);

        return redirect()->route('index-product');
    }

    /**
     * Menampilkan hal. pembaharuan kategori produk.
     */
    public function edit(Category $category)
    {
        return view('inventory.category.edit', compact('category'));
    }

    /**
     * Memperbaharui kategori produk.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $attr = $request->validated();
        $category->update($attr);

        return redirect()->route('index-product');
    }

    /**
     * Menghapus kategori produk.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }
}
