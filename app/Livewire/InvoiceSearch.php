<?php

namespace App\Livewire;

use Livewire\Component;

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

    public function getFilteredInvoicesProperty()
    {
        return $this->invoices
            ->filter(fn($invoice) =>
            ! $this->search || 
            str_contains(
                strtolower($invoice->buyer), strtolower($this->search)
            ));
    }
}
