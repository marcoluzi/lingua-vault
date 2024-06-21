<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Lesson Overview')]
class Lessons extends Component
{
    public function render()
    {
        return view('livewire.pages.lessons');
    }
}
