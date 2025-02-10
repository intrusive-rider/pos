<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Services\CheckoutService;

class OrderController extends Controller
{
    /**
     * *Container* untuk CheckoutService
     */
    protected $checkout;

    public function __construct(CheckoutService $checkout_service)
    {
        $this->checkout = $checkout_service;
    }

    /**
     * Menampilkan hal. pembuatan pesanan.
     */
    public function create()
    {
        $products = Product::with('category')
            ->get()
            ->groupBy(fn($product) => $product->category->name);

        $discounts = Discount::where('active', true)->get();
        return view('customer.order.create', compact('products', 'discounts'));
    }

    /**
     * Menyimpan pesanan.
     */
    public function store(OrderRequest $request)
    {
        $data = $request->validated();

        $quantities = $data['quantity'];
        $discounts = Discount::where('name', $data['discount'] ?? null)->get() ?? collect();

        [
            'sub_total' => $sub_total,
            'grand_total' => $grand_total,
            'discounts' => $discounts,
        ] = $this->checkout->get_total($quantities, $discounts);

        $order = Order::create([
            'seller_id'   => Auth::id(),
            'sub_total'   => $sub_total,
            'grand_total' => $grand_total,
        ]);

        $order->products()->attach(
            collect($quantities)
                ->filter(fn($qty) => $qty > 0) // Menghilangkan nilai-nilai kosong.
                ->mapWithKeys(fn($qty, $id) => [$id => ['quantity' => $qty]])
        );

        $order->discounts()->attach($discounts->isNotEmpty() ? $discounts : []);

        return redirect()->route('show-order', $order);
    }

    /**
     * Melihat salah satu pesanan.
     */
    public function show(Order $order)
    {
        $order->load(['products', 'discounts']);
        return view('customer.order.show', compact('order'));
    }

    /**
     * Menampilkan hal. pembaharuan pesanan.
     */
    public function edit(Order $order)
    {
        $products = Product::with('category')
            ->get()
            ->groupBy('category.name');

        $discounts = Discount::where('active', true)->get();
        $order->load(['products', 'discounts']);

        return view('customer.order.edit', compact('products', 'discounts', 'order'));
    }

    /**
     * Memperbaharui pesanan.
     */
    public function update(OrderRequest $request, Order $order)
    {
        $data = $request->validated();

        $quantities = $data['quantity'];
        $discounts = Discount::where('name', $data['discount'] ?? null)->get() ?? collect();

        [
            'sub_total' => $sub_total,
            'grand_total' => $grand_total,
            'discounts' => $discounts,
        ] = $this->checkout->get_total($quantities, $discounts);

        $order->update([
            'sub_total'   => $sub_total,
            'grand_total' => $grand_total,
        ]);

        $order->products()->sync(
            collect($quantities)
                ->filter(fn($qty) => $qty > 0) // Menghilangkan nilai-nilai kosong.
                ->mapWithKeys(fn($qty, $id) => [$id => ['quantity' => $qty]])
        );

        $order->discounts()->sync($discounts->isNotEmpty() ? $discounts : []);

        return redirect()->route('show-order', $order);
    }
}
