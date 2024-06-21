<?php

namespace App\Livewire\Pages;

use App\Models\Lesson;
use Livewire\Component;
use Livewire\WithPagination;

class Lessons extends Component
{
    use WithPagination;

    public $title = '';

    public function mount()
    {
        $this->title = __('Lesson Overview');
    }

    public function render()
    {
        return view('livewire.pages.lessons', [
            'lessons' => Lesson::paginate(10),
        ])->title($this->title);
    }
}
