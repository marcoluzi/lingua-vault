<?php

namespace App\Livewire\Components;

use Illuminate\View\View;
use Livewire\Component;

class PageHeader extends Component
{
    public string $pageTitle = '';

    public function render(): View
    {
        return view('livewire.components.page-header');
    }
}
