<?php

namespace App\Livewire\Components;

use App\Services\LexemeService;
use App\Support\Enums\Statuses;
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

    public function mount(LexemeService $lexemeService, $lexemeId, $word, $lessonLanguage, $lessonId)
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

    public function save(LexemeService $lexemeService)
    {
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

    public function toggleWellKnown()
    {
        $this->setStatus(Statuses::WELL_KNOWN);
    }

    public function toggleIgnore()
    {
        $this->setStatus(Statuses::IGNORED);
    }

    private function setStatus(Statuses $status)
    {
        $this->status = ($this->status === $status) ? null : $status;
    }

    public function saveAndClose(LexemeService $lexemeService)
    {
        $this->save($lexemeService);
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.components.edit-lexeme-modal');
    }
}
