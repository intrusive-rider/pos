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
                $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('category', 'like', '%' . $this->search . '%')
            )
            ->get();
    }
}
