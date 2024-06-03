<?php

namespace App\Livewire\Pages\Cashier\Partials;

use App\Models\Order;
use App\Models\ProductCart;
use Livewire\Attributes\On;
use Livewire\Component;

class CashierProductCart extends Component
{
    public $no_order;

    /**
     * Handle dispatch add-to-cart.
     */
    #[On('update-cart')]
    public function updateCart()
    {
    }

    /**
     * Handle removeToCart.
     */
    public function removeToCart($product_id)
    {
        ProductCart::where('id', $product_id)
            ->where('user_id', auth()->id())
            ->delete();

        $this->dispatch('update-cart');
    }

    /**
     * Render Component CashierProductCart.
     */
    public function render(ProductCart $productCart)
    {
        $productCarts = ProductCart::with('product.productCategory')
            ->where('user_id', auth()->id())
            ->get();

        $today = now()->isoFormat('D, MMMM Y');
        $this->generateUniqueNoOrder();

        return view('livewire.pages.cashier.partials.cashier-product-cart', compact('productCarts', 'today'));
    }

    /**
     * Handle method generateUniqueNoOrder.
     */
    public function generateUniqueNoOrder()
    {
        $userId = auth()->id();
        $date = date('dmyis');
        $orderCount = Order::count() + 1;
        $this->no_order = $userId . $date . $orderCount;

        // Ensure uniqueness
        while (Order::where("no_order", $this->no_order)->exists()) {
            $orderCount++;
            $this->no_order = $userId . $date . $orderCount;
        }
    }
}
