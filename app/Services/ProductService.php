<?php

namespace App\Services;

use App\Http\Requests\Inventory\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

/**
 * *Utility class* untuk ProductController.
 * 
 * @method handle_image
 * @method get_category_id
 */
class ProductService
{
    /**
     * Menyimpan gambar produk.
     */
    public function handle_image(ProductRequest $request, ?Product $product = null)
    {
        if ($request->hasFile('image')) {

            $condition = $product &&
                !is_null($product->image) &&
                Storage::exists($product->image);

            if ($condition) {
                Storage::delete($product->image);
            }

            return 'storage/' . $request->image->store('product_img', 'public');
        }

        return $product ? $product->image : null;
    }

    /**
     * Mendapatkan ID kategori dari namanya.
     */
    public function get_category_id($category_name)
    {
        return Category::firstOrCreate(['name' => $category_name])->id;
    }
}
