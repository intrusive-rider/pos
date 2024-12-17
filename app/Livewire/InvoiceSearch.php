<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;

class InvoiceSearch extends Component
{
    public $invoices;
    public $search = '';

    public function mount($invoices)
    {
        $this->invoices = $invoices;
    }

    public function render()
    {
        return view('livewire.invoice-search');
    }

    public function getInvoicesProperty()
    {
        return collect($this->transactions)->when(
            $this->search,
            fn($invoices) =>
            $invoices->filter(
                fn($invoice) =>
                str_contains(strtolower($invoice->buyer), strtolower($this->search))
            )
        );
    }
}
