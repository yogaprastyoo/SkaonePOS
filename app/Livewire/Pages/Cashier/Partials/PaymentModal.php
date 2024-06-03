<?php

namespace App\Livewire\Pages\Cashier\Partials;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ProductCart;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class PaymentModal extends Component
{
    #[Rule('required|unique')]
    public $no_order;

    #[Rule('required')]
    public $user_id;

    #[Rule('required')]
    public $grand_total;

    #[Rule('required')]
    public $payment = 'tunai';

    #[Rule('required')]
    public $pay;

    #[Rule('required')]
    public $change;

    /**
     * Handle dispatch update-cart.
     */
    #[On('update-cart')]
    public function updateCart()
    {
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
     * Handle createOrder.
     */
    public function createOrder(ProductCart $productCart)
    {
        $this->sanitizePay();

        $productCarts = $productCart->with('product.productCategory')
            ->where('user_id', auth()->id())
            ->get();

        $this->grand_total = $productCarts->sum('total');
        $this->change = $this->pay - $this->grand_total;

        // Check if product carts are not empty
        if ($productCarts->isEmpty()) {
            return;
        }

        // Check if pay is less than grand total
        if ($this->pay < $this->grand_total) {
            session()->flash('error', 'Jumlah Pembayaran tidak mencukupi.');
            $this->reset();
            return;
        }

        // Create order and associate products
        $orderData = [
            'no_order' => $this->no_order,
            'user_id' => auth()->id(),
            'grand_total' => $this->grand_total,
            'payment' => $this->payment,
            'pay' => $this->pay,
            'change' => $this->change,
        ];

        $order = Order::create($orderData);

        $orderProducts = $productCarts->map(function ($productCart) use ($order) {
            return [
                'order_id' => $order->id,
                'product_id' => $productCart->product_id,
                'qty' => $productCart->qty,
                'total' => $productCart->total,
            ];
        });

        OrderProduct::insert($orderProducts->toArray());

        // Delete product carts
        $productCart->where('user_id', auth()->id())->delete();

        // Dispatch event
        $this->dispatch('create-order', $order->id);

        // Flash success message and reset state
        session()->flash('success', 'Pembayaran telah sukses dilakukan.');
        $this->reset();
    }

    /**
     * Render Component PaymentModal.
     */
    public function render(ProductCart $productCart)
    {
        $productCarts = $productCart->with('product.productCategory')
            ->where('user_id', auth()->id())
            ->get();

        return view('livewire.pages.cashier.partials.payment-modal', compact('productCarts'));
    }

    /**
     * Handle method sanitizePay.
     */
    private function sanitizePay()
    {
        $this->pay = intval(str_replace(['.', ','], '', $this->pay));
    }
}
