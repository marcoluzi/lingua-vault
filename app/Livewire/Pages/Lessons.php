<?php

namespace App\Livewire\Pages;

use App\Models\Lesson;
use Livewire\Component;

class Lessons extends Component
{
    public $title = '';

    public $lessons = [];

    public function mount()
    {
        $this->title = __('Lesson Overview');
        $this->lessons = Lesson::all(['title', 'word_count', 'progress', 'updated_at'])->toArray();
    }

    public function render()
    {
        return view('livewire.pages.lessons')->title($this->title);
    }
}
