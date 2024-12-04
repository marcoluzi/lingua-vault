<?php

namespace App\Livewire\Pages;

use App\Models\Lesson;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class LessonRead extends Component
{
    public string $lessonLanguage;
    public string $title;
    public string $text;

    public function mount($lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);

        // TODO: Switch Current Language if different from lesson language

        $this->lessonLanguage = $lesson->language->value;
        $this->title = $lesson->title;
        $this->text = $lesson->text;
    }

    // TODO: breadcrumbs break after component update
    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('Lessons'), route('lessons.index'))
            ->push($this->title);
    }

    public function render()
    {
        return view('livewire.pages.lesson-read')->title($this->title);
    }
}
