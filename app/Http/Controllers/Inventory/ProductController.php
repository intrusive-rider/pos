<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
{
    /**
     * *Container* untuk ProductService
     */
    protected $product_service;

    public function __construct(ProductService $product_service)
    {
        $this->product_service = $product_service;
    }

    /**
     * Menampilkan hal. daftar produk.
     */
    public function index()
    {
        return view('inventory.product.index', [
            'products' => Product::all(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Menampilkan hal. pembuatan produk.
     */
    public function create()
    {
        return view('inventory.product.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Menyimpan produk.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        $data['category_id'] = $this->product_service->get_category_id($data['category']);
        unset($data['category']);

        $data['image'] = $this->product_service->handle_image($request);

        Product::create($data);
        return redirect()->route('index-product');
    }

    /**
     * Menampilkan hal. pembaharuan produk
     */
    public function edit(Product $product)
    {
        return view('inventory.product.edit', [
            'product' => $product,
            'categories' => Category::all()
        ]);
    }

    /**
     * Memperbaharui produk.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();

        $data['category_id'] = $this->product_service->get_category_id($data['category']);
        unset($data['category']);

        $data['image'] = $this->product_service->handle_image($request, $product);

        $product->update($data);
        return redirect()->route('index-product');
    }

    /**
     * Menghapus produk.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back();
    }
}
