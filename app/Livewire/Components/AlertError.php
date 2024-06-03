<?php

namespace App\Livewire\Components;

use Livewire\Component;

class AlertError extends Component
{
    public $dispatch;

    public function render()
    {
        return view('livewire.components.alert-error');
    }
}
