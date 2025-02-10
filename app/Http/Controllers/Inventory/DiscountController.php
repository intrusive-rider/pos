<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventory\DiscountRequest;
use App\Models\Discount;

class DiscountController extends Controller
{
    /**
     * Menampilkan hal. daftar diskon aktif.
     */
    public function index()
    {
        $discounts = Discount::where('active', true)->get();
        return view('inventory.discount.index', compact('discounts'));
    }

    /**
     * Menampilkan hal. pembuatan diskon.
     */
    public function create()
    {
        return view('inventory.discount.create');
    }

    /**
     * Menyimpan diskon.
     */
    public function store(DiscountRequest $request)
    {
        $attr = $request->validated();
        Discount::create($attr);

        return redirect()->route('index-discount');
    }

    /**
     * Menampilkan hal. pembaharuan diskon.
     */
    public function edit(Discount $discount)
    {
        return view('inventory.discount.edit', compact('discount'));
    }

    /**
     * Memperbaharui diskon.
     */
    public function update(DiscountRequest $request, Discount $discount)
    {
        $attr = $request->validated();
        $discount->update($attr);

        return redirect()->route('index-discount');
    }

    /**
     * Menghapus diskon.
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('index-discount');
    }
}
