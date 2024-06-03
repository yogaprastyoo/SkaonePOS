<?php

namespace App\Livewire\Pages\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;

class OrderPage extends Component
{
    #[Url]
    public $search = '';

    public $order_id;
    public $no_order;
    public $cashier;
    public $total;
    public $pay;
    public $change;
    public $payment;

    /**
     * Handle dispatch search.
     */
    #[On('search')]
    public function updateSearch($search = null)
    {
        $this->search = $search;
        if ($search == null) {
            $this->redirect('/invoices', navigate: true);
        }
    }

    /**
     * Handle dispatch update-list.
     */
    #[On('update-list')]
    public function updateList()
    {
    }

    /**
     * Render Page Invoice.
     */
    #[Layout('layouts/app')]
    #[Title('Invoices')]
    public function render(Order $order)
    {
        $orders = $order->with('user')
            ->where('no_order', 'like', "%{$this->search}%")
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('livewire.pages.order.order-page', compact('orders'))->with('today', now()->isoFormat('dddd, D MMMM Y'));
    }
}
