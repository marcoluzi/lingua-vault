<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\View\View;

#[Title('Home')]
class Home extends Component
{
    public function render(): View
    {
        return view('livewire.pages.home');
    }
}
