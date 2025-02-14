<?php

namespace App\Livewire\Components;

use App\Services\LexemeService;
use App\Support\Enums\Statuses;
use LivewireUI\Modal\ModalComponent;
use Illuminate\View\View;

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

        // TODO: Only dispatch to parent
        if ($this->lexemeId) {
            $lexeme = $lexemeService->findById($this->lexemeId);
            if ($lexeme) {
                $lexemeService->updateLexeme($lexeme, $data);
                $this->dispatch('lexeme-updated')->to(LexemeItem::class);
            }
        } else {
            if ($this->meaning || $this->status) {
                $lexeme = $lexemeService->createLexeme($data);
                $this->lexemeId = $lexeme->id;
                if ($lexemeService->attachToLesson($lexeme, $this->lessonId)) {
                    $this->dispatch('lexeme-updated')->to(LexemeItem::class);
                }
            }
        }
    }

    public function toggleWellKnown(): void
    {
        $this->setStatus(Statuses::WELL_KNOWN);
    }

    public function toggleIgnore(): void
    {
        $this->setStatus(Statuses::IGNORED);
    }

    private function setStatus(Statuses $status): void
    {
        $this->status = ($this->status === $status) ? null : $status;
    }

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
