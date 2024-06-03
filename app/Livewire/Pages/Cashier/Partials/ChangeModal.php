<?php

namespace App\Livewire\Pages\Cashier\Partials;

use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Component;

class ChangeModal extends Component
{
    public $order_id;
    public $no_order;
    public $change;

    /**
     * Handle dispatch create-order.
     */
    #[On('create-order')]
    public function createOrder($id = null)
    {
        $this->order_id = $id;
        $order = Order::find($this->order_id);
        $this->change = $order->change;
    }

    /**
     * Handle dispatch checkout.
     */
    #[On('checkout')]
    public function checkout($no_order = null)
    {
        $this->no_order = $no_order;
    }

    /**
     * Render Component ChangeModal.
     */
    public function render()
    {
        return view('livewire.pages.cashier.partials.change-modal');
    }
}
