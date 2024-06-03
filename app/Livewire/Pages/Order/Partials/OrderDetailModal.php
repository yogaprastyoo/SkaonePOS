<?php

namespace App\Livewire\Pages\Order\Partials;

use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Component;

class OrderDetailModal extends Component
{

    public $order_id;
    public $no_order;
    public $cashier;
    public $total;
    public $pay;
    public $change;
    public $payment;
    public $order;

    /**
     * Handle dispatch order-detail.
     */
    #[On('order-detail')]
    public function orderDetail($order_id)
    {
        $this->order_id = $order_id;
        $order = Order::with('user')->with('orderProduct')->find($this->order_id);
        $this->order = Order::with('user')->with('orderProduct')->find($this->order_id);

        if ($order) {
            $this->order_id = $order->id;
            $this->no_order = $order->no_order;
            $this->cashier = $order->user->name;
            $this->total = $order->grand_total;
            $this->pay = $order->pay;
            $this->change = $order->change;
            $this->payment = $order->payment;
        }
    }

    /**
     * Render Component OrderDetailModal.
     */
    public function render()
    {
        return view('livewire.pages.order.partials.order-detail-modal');
    }
}
