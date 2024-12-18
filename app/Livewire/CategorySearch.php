<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class CategorySearch extends Component
{
    public $categories = []; 

    public function mount()
    {
        $this->categories = Category::all();
    }
    public function render()
    {
        $products = Product::with('category')->get();
        return view('livewire.category-search', compact('products'));
    }

    public $search = ''; 

    public function getCategoriesProperty()
    {
        return Category::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->get();
    }

}
