<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;

class InvoiceSearch extends Component
{
    public $search = '';

    public function render()
    {
        return view('livewire.invoice-search');
    }

    public function getInvoicesProperty()
    {
        return Transaction::query()
            ->when(
                $this->search,
                fn($query) =>
                $query->where('buyer', 'like', '%' . $this->search . '%')
            )
            ->get();
    }
}
