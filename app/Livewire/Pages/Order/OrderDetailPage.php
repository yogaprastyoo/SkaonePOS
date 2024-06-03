<?php

namespace App\Livewire\Pages\Order;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class OrderDetailPage extends Component
{
    public $no_order;

    #[Layout('layouts/app')]
    #[Title('Invoices')]
    public function render()
    {
        $order = Order::with('user')->with('orderProduct')->where('no_order', $this->no_order)->firstOrFail();
        return view('livewire.pages.order.order-detail-page', [
            'order' => $order
        ]);
    }
}
