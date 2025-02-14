<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\View\View;

class PageHeader extends Component
{
    public string $title;

    public function render(): View
    {
        return view('livewire.components.page-header');
    }
}
