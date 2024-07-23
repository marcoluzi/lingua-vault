<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class LessonCreate extends Component
{
    public $title = '';

    public function mount()
    {
        $this->title = __('Create Lesson');
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('Lessons'), route('lessons.index'))
            ->push($this->title);
    }

    public function render()
    {
        return view('livewire.pages.lesson-create')->title($this->title);
    }
}
