<?php

namespace App\Livewire;

use Livewire\Component;

class DiscountSearch extends Component
{
    public $discounts;
    public $search = '';

    public function mount($discounts)
    {
        $this->discounts = $discounts;
    }

    public function render()
    {
        return view('livewire.discount-search');
    }

    public function getFilteredDiscountsProperty()
    {
        return $this->discounts
            ->filter(fn($discount) =>
            ! $this->search || str_contains(
                strtolower($discount->name), strtolower($this->search)
            ));
    }
}
