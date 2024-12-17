<?php

namespace App\Livewire;

use Livewire\Component;

class ProductSearch extends Component
{
    public $products;
    public $search = '';

    public function mount($products)
    {
        $this->products = $products;
    }

    public function render()
    {
        return view('livewire.product-search');
    }

    public function getProductsProperty()
    {
        return collect($this->products)->when(
            $this->search,
            fn($products) =>
            $products->filter(
                fn($product) =>
                str_contains(strtolower($product->name), strtolower($this->search)) ||
                    str_contains(strtolower($product->category->name ?? ''), strtolower($this->search))
            )
        );
    }
}
