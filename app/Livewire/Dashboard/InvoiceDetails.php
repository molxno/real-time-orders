<?php

namespace App\Livewire\Dashboard;

use App\Models\Invoice;
use Livewire\Component;

class InvoiceDetails extends Component
{
    public ?Invoice $invoice = null;

    /**
     * Mount the component.
     */
    public function mount($invoice = null): void
    {
        $this->invoice = $invoice;
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('livewire.dashboard.invoice-details');
    }
}
