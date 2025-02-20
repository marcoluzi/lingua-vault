<?php

namespace App\Livewire\Components;

use App\Livewire\Pages\Lessons;
use App\Livewire\Traits\WithDeletionModal;
use App\Services\LessonDeletionService;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class DeleteLessonModal extends ModalComponent
{
    use WithDeletionModal;

    public int $lessonId;

    protected LessonDeletionService $lessonDeletionService;

    public function boot(LessonDeletionService $lessonDeletionService): void
    {
        $this->lessonDeletionService = $lessonDeletionService;
    }

    /**
     * Calls the deletion service to delete the lesson.
     */
    protected function performDeletion(): void
    {
        $this->lessonDeletionService->deleteLesson($this->lessonId);
    }

    /**
     * Returns the event name to dispatch after deletion.
     */
    protected function getDeletedEvent(): string
    {
        return 'lesson-deleted';
    }

    /**
     * Returns the component/class to notify.
     */
    protected function getRedirectComponent(): string
    {
        return Lessons::class;
    }

    public function render(): View
    {
        return view('livewire.components.delete-lesson-modal');
    }
}
