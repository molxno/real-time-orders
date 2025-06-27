<?php

namespace App\Livewire\Dashboard;

use App\Models\Order;
use Livewire\Component;

class OrderDisplay extends Component
{
    public ?Order $order = null;
    public bool $showInvoice = false;

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->order = Order::with(['user', 'products', 'invoice'])->first();
    }

    /**
     * Toggle the invoice details visibility.
     */
    public function toggleInvoice(): void
    {
        $this->showInvoice = !$this->showInvoice;
    }

    /**
     * Render the component.
     */
    public function render()
    {
        return view('livewire.dashboard.order-display');
    }
}
