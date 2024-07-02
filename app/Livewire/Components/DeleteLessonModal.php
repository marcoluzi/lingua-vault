<?php

namespace App\Livewire\Components;

use App\Livewire\Pages\Lessons;
use App\Models\Lesson;
use LivewireUI\Modal\ModalComponent;

class DeleteLessonModal extends ModalComponent
{
    public int $lessonId;

    /**
     * Deleting the lesson of the current modal.
     *
     * @return void
     *
     * @throws \Exception If lesson not found.
     */
    public function deleteLesson()
    {
        $lesson = Lesson::find($this->lessonId);

        if (! $lesson) {
            throw new \Exception('Lesson with ID '.$this->lessonId.' not found.');
        }

        $lesson->delete();

        $this->dispatch('lesson-deleted')->to(Lessons::class);
        $this->closeModal();

    }

    public function render()
    {
        return view('livewire.components.delete-lesson-modal');
    }
}
