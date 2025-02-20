<?php

namespace App\Livewire\Components;

use App\Livewire\Pages\Lessons;
use App\Livewire\Traits\WithDeletionModal;
use App\Services\LexemeService;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class DeleteLexemeModal extends ModalComponent
{
    use WithDeletionModal;

    public int $lexemeId;

    protected LexemeService $lexemeService;

    public function boot(LexemeService $lexemeService): void
    {
        $this->lexemeService = $lexemeService;
    }

    /**
     * Calls the deletion service to delete the lexeme.
     */
    protected function performDeletion(): void
    {
        $this->lexemeService->deleteLexeme($this->lexemeId);
    }

    /**
     * Returns the event name to dispatch after deletion.
     */
    protected function getDeletedEvent(): string
    {
        return 'lexeme-deleted';
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
        return view('livewire.components.delete-lexeme-modal');
    }
}
