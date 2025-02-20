<?php

namespace App\Livewire\Components;

use App\Livewire\Pages\Lessons;
use App\Services\LexemeService;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class DeleteLexemeModal extends ModalComponent
{
    public int $lexemeId;

    protected LexemeService $lexemeService;

    public function boot(LexemeService $lexemeService): void
    {
        $this->lexemeService = $lexemeService;
    }

    /**
     * Deletes the current lexeme using the lexemeDeletionService.
     *
     * Dispatches a 'lexeme-deleted' event to the Lessons component
     * and closes the modal upon successful deletion.
     *
     * @throws \Exception If an error occurs during deletion.
     */
    public function deleteLexeme(): void
    {
        try {
            $this->lexemeService->deleteLexeme($this->lexemeId);

            $this->dispatch('lexeme-deleted')->to(Lessons::class);

            $this->closeModal();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function render(): View
    {
        return view('livewire.components.delete-lexeme-modal');
    }
}
