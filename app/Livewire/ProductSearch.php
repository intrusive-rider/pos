<?php

namespace App\Livewire;

use Livewire\Component;

class ProductSearch extends Component
{
    public $products;
    public $categories;
    public $search = '';

    public function mount($products, $categories)
    {
        $this->products = $products;
        $this->categories = $categories;
    }

    public function render()
    {
        return view('livewire.product-search');
    }

    public function getFilteredProductsProperty()
    {
        return collect($this->products->load('category'))->when(
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
