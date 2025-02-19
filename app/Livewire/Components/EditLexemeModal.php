<?php

namespace App\Livewire\Components;

use App\Services\LexemeService;
use App\Support\Enums\Statuses;
use Illuminate\View\View;
use LivewireUI\Modal\ModalComponent;

class EditLexemeModal extends ModalComponent
{
    public ?int $lexemeId = null;

    public string $word;

    public string $lessonLanguage;

    public int $lessonId;

    public ?string $meaning = '';

    public ?string $romanized = '';

    public ?Statuses $status = null;

    protected array $rules = [
        'word' => 'required|string',
        'lessonLanguage' => 'required|string',
        'meaning' => 'nullable|string',
        'romanized' => 'nullable|string',
    ];

    public function mount(LexemeService $lexemeService, ?int $lexemeId, string $word, string $lessonLanguage, int $lessonId): void
    {
        $this->lexemeId = $lexemeId;
        $this->word = $word;
        $this->lessonLanguage = $lessonLanguage;
        $this->lessonId = $lessonId;

        if ($this->lexemeId) {
            $lexeme = $lexemeService->findById($this->lexemeId);

            if ($lexeme) {
                $this->meaning = $lexeme->meaning;
                $this->romanized = $lexeme->romanized;
                $this->status = $lexeme->status;
            }
        }
    }

    /**
     * Validates the input data and either updates an existing lexeme or creates a new one.
     *
     * If a lexeme ID is present, the lexeme is retrieved and updated with the provided data.
     * Otherwise, a new lexeme is created if there is a meaning or status, and it is attached
     * to the current lesson. After updating or creating, a 'lexeme-updated' event is dispatched
     * with the lexeme id as payload to update the corresponding LexemeItem(s).
     */
    public function save(LexemeService $lexemeService): void
    {
        $this->validate();

        $data = [
            'text' => $this->word,
            'meaning' => $this->meaning,
            'romanized' => $this->romanized,
            'language' => $this->lessonLanguage,
            'status' => $this->status,
        ];

        if ($this->lexemeId) {
            $lexeme = $lexemeService->findById($this->lexemeId);

            if ($lexeme) {
                $lexemeService->updateLexeme($lexeme, $data);

                $this->dispatch('lexeme-updated', ['lexemeId' => $lexeme->id])->to(LexemeItem::class);
            }
        } else {
            if ($this->meaning || $this->status) {
                $lexeme = $lexemeService->createLexeme($data);

                $this->lexemeId = $lexeme->id;

                if ($lexemeService->attachToLesson($lexeme, $this->lessonId)) {
                    $this->dispatch('lexeme-updated', ['lexemeId' => $lexeme->id])->to(LexemeItem::class);
                }
            }
        }
    }

    /**
     * Toggles the lexeme status to well-known.
     */
    public function toggleWellKnown(): void
    {
        $this->setStatus(Statuses::WELL_KNOWN);
    }

    /**
     * Toggles the lexeme status to ignored.
     */
    public function toggleIgnore(): void
    {
        $this->setStatus(Statuses::IGNORED);
    }

    /**
     * Toggles the lexeme status to the given status.
     *
     * If the lexeme status is already the given status, it will be set to null.
     * Otherwise, the status will be set to the given status.
     */
    private function setStatus(Statuses $status): void
    {
        $this->status = ($this->status === $status) ? null : $status;
    }

    /**
     * Saves the lexeme data and closes the modal.
     *
     * This function first calls the save method to validate and save or update
     * the lexeme data using the provided LexemeService. After saving, it closes
     * the modal dialog.
     */
    public function saveAndClose(LexemeService $lexemeService): void
    {
        $this->save($lexemeService);

        $this->closeModal();
    }

    public function render(): View
    {
        return view('livewire.components.edit-lexeme-modal');
    }
}
