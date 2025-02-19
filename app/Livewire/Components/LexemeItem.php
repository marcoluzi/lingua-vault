<?php

namespace App\Livewire\Components;

use App\Services\LexemeService;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class LexemeItem extends Component
{
    public string $word;

    public string $lessonLanguage;

    public int $lessonId;

    public ?int $lexemeId = null;

    public string $backgroundColor = 'blue';

    public function mount(LexemeService $lexemeService, string $word, string $lessonLanguage, int $lessonId): void
    {
        $this->word = $word;
        $this->lessonLanguage = $lessonLanguage;
        $this->lessonId = $lessonId;

        $existing = $lexemeService->findByTextAndLanguage($this->word, $this->lessonLanguage);
        if ($existing) {
            $this->lexemeId = $existing->id;
            $this->backgroundColor = $lexemeService->determineBackgroundColor($existing);
        }
    }

    /**
     * Updates the lexeme information and background color upon receiving a 'lexeme-updated' event.
     *
     * This method receives the lexeme id as payload and updates the component only if the
     * updated lexeme id matches the lexeme corresponding to this component.
     *
     * @param  array{lexemeId:int}  $payload
     */
    #[On('lexeme-updated')]
    public function updateLexeme(array $payload, LexemeService $lexemeService): void
    {
        if (! isset($payload['lexemeId'])) {
            return;
        }

        $updatedLexemeId = $payload['lexemeId'];

        if ($this->lexemeId !== null && $this->lexemeId !== $updatedLexemeId) {
            return;
        }

        $existing = $lexemeService->findByTextAndLanguage($this->word, $this->lessonLanguage);
        if ($existing && $existing->id === $updatedLexemeId) {
            $this->lexemeId = $existing->id;
            $this->backgroundColor = $lexemeService->determineBackgroundColor($existing);
        }
    }

    public function render(): View
    {
        return view('livewire.components.lexeme-item');
    }
}
