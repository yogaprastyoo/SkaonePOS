<?php

namespace App\Livewire\Pages\Order\Partials;

use Livewire\Component;
use App\Models\Order;
use Livewire\Attributes\On;

class OrderDeleteModal extends Component
{

    public $order_id;

    /**
     * Handle dispatch order-detail.
     */
    #[On('order-detail')]
    public function orderDetail($order_id)
    {
        $this->order_id = $order_id;
        $order = Order::with('user')->find($this->order_id);

        if ($order) {
            $this->order_id = $order->id;
        }
    }

    /**
     * Handle dispatch close-alert.
     */
    #[On('close-alert')]
    public function closeAlert()
    {
    }

    /**
     * Handle deleteOrder.
     */
    public function deleteOrder()
    {
        if ($this->order_id == 0) {
            session()->flash('error', 'Invoice tidak ditemukan.');
            return;
        }
        $order = Order::find($this->order_id);

        $order->delete();

        $this->order_id = 0;

        session()->flash('success', 'Invoice berhasi dihapus.');

        $this->dispatch('update-list');
    }

    /**
     * Render Component OrderDeleteModal.
     */
    public function render()
    {
        return view('livewire.pages.order.partials.order-delete-modal');
    }
}
