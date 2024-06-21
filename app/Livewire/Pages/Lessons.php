<?php

namespace App\Livewire\Pages;

use Livewire\Component;

class Lessons extends Component
{
    public $title = '';

    public function mount()
    {
        $this->title = __('Lessons Overview');
    }

    public function render()
    {
        return view('livewire.pages.lessons')->title($this->title);
    }
}
