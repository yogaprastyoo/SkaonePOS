<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Search extends Component
{
    public $search;

    public function updatedSearch()
    {
        $this->dispatch('search', search: $this->search);
    }

    public function render()
    {
        return view('livewire.components.search');
    }
}
