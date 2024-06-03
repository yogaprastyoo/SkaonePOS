<?php

namespace App\Livewire\Pages\Cashier;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class CashierPage extends Component
{
    /**
     * Render Page Cashier.
     */
    #[Layout('layouts/app')]
    #[Title('Cashier')]
    public function render()
    {
        return view('livewire.pages.cashier.cashier-page');
    }
}
