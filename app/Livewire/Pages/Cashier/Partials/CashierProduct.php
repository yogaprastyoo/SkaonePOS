<?php

namespace App\Livewire\Pages\Cashier\Partials;

use App\Models\Product;
use App\Models\ProductCart;
use App\Models\ProductCategory;
use Livewire\Attributes\On;
use Livewire\Component;

class CashierProduct extends Component
{
    public $search;

    /**
     * Handle dispatch search.
     */
    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
    }

    /**
     * Handle dispatch update-cart.
     */
    #[On('update-cart')]
    public function updateCart()
    {
    }

    /**
     * Handle addToCart / addQTY.
     */
    public function addToCart($product_id)
    {
        /** Finding the product based on its ID **/
        $product = Product::find($product_id);
        $user_id = auth()->id();

        if ($product) {

            /** If the product is found, check if it's already in the shopping cart **/
            $productCart = ProductCart::where('user_id', $user_id)->where('product_id', $product_id)->first();

            if ($productCart) {

                /** If the product is already in the shopping cart, increment its quantity and update the total. **/
                $productCart->qty++;
                $productCart->total += $product->price;
                $productCart->save();
            } else {

                /** If the product is not yet in the shopping cart, add a new product to it **/
                ProductCart::create([
                    'product_id' => $product_id,
                    'user_id' => auth()->id(),
                    'qty' => 1,
                    'total' => $product->price
                ]);
            }
        }
    }

    /**
     * Handle reduceQTY.
     */
    public function reduceQTY($product_id)
    {
        // Find the product cart entry for the given product ID with its product
        $productCart = ProductCart::with('product')->where('product_id', $product_id)->first();

        // Check if the product cart entry exists
        if ($productCart) {
            // Decrease the quantity of the product in the cart
            $productCart->qty--;

            // If the quantity becomes zero or less, remove the product from the cart
            if ($productCart->qty <= 0) {
                $productCart->delete();
            } else {
                // If the quantity is still greater than zero, update the total price of the product cart entry
                // by subtracting the product price multiplied by the decreased quantity
                if ($productCart->product) {
                    // Update the total price of the product cart entry and save the changes
                    $productCart->total -= $productCart->product->price;
                    $productCart->save();
                }
            }
        }
    }

    /**
     * Render Component ProductCashier.
     */
    public function render(ProductCart $productCart)
    {
        $productCarts = $productCart->with('product.productCategory')
            ->where('user_id', auth()->id())
            ->get();

        $products = Product::where('name', 'like', "%{$this->search}%")
            ->where('is_available', true)
            ->get();

        $categories = ProductCategory::get();

        return view('livewire.pages.cashier.partials.cashier-product', compact('productCarts', 'products', 'categories'))
            ->with('today', now()->isoFormat('dddd, D MMMM Y'));
    }
}
