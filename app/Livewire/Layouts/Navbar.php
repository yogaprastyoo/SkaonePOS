<?php

namespace App\Livewire\Layouts;

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public function logout()
    {
        Auth::logout();

        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.layouts.navbar');
    }
}
