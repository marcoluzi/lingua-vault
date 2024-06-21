<?php

namespace App\Livewire\Components;

use Livewire\Component;

class PageHeader extends Component
{
    public $title;

    public function render()
    {
        return view('livewire.components.page-header');
    }
}
