<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        return view('home')->layout('components.layouts.page-layout');
    }
}
