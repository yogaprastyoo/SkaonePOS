<?php

namespace App\Observers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "saved" event.
     */
    public function saved(Product $product): void
    {
        if ($product->isDirty('image') && !is_null($product->getOriginal('image'))) {
            Storage::disk('public')->delete($product->getOriginal('image'));
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        if (!is_null($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        if (!is_null($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
    }
}
