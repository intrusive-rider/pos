<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductSearch extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.product-search');
    }

    public function getProductsProperty()
    {
        return Product::query()
            ->when(
                $this->search,
                fn($query) =>
                $query
                    ->where('products.name', 'like', '%' . $this->search . '%')
                    ->orWhereHas(
                        'category',
                        fn($q) =>
                        $q->where('categories.name', 'like', '%' . $this->search . '%')
                    )
            )
            ->get();
    }
}
