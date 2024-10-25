<?php

namespace App\Livewire\Pages;

use App\Models\Lesson;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class LessonView extends Component
{
    public $title = '';

    public Lesson $post;

    public function mount($id)
    {
        $this->post = Lesson::findOrFail($id);
        $this->title = $this->post->title;
    }

    // TODO: breadcrumbs break after component update
    // TODO: Trait erstellen
    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('Lessons'), route('lessons.index'))
            ->push($this->title);
    }

    public function render()
    {
        return view('livewire.pages.lesson-view')->title($this->title);
    }
}
