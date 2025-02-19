<?php

namespace App\Livewire\Components;

use App\Livewire\Pages\Lessons;
use App\Services\LessonDeletionService;
use LivewireUI\Modal\ModalComponent;
use Illuminate\View\View;

class DeleteLessonModal extends ModalComponent
{
    public int $lessonId;

    protected LessonDeletionService $lessonDeletionService;

    public function boot(LessonDeletionService $lessonDeletionService): void
    {
        $this->lessonDeletionService = $lessonDeletionService;
    }

    /**
     * Deletes the current lesson using the lessonDeletionService.
     *
     * Dispatches a 'lesson-deleted' event to the Lessons component
     * and closes the modal upon successful deletion.
     *
     * @throws \Exception If an error occurs during deletion.
     */
    public function deleteLesson(): void
    {
        try {
            $this->lessonDeletionService->deleteLesson($this->lessonId);
            $this->dispatch('lesson-deleted')->to(Lessons::class);
            $this->closeModal();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function render(): View
    {
        return view('livewire.components.delete-lesson-modal');
    }
}
