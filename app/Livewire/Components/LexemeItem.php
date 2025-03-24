<?php

namespace App\Livewire\Components;

use App\Services\LexemeService;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class LexemeItem extends Component
{
    public ?int $lexemeId = null;

    public string $word;

    public string $language;

    public int $lessonId;

    public string $backgroundColor = 'blue';

    public function mount(LexemeService $lexemeService, string $word, string $language, int $lessonId): void
    {
        $this->word = $word;
        $this->language = $language;
        $this->lessonId = $lessonId;

        $lexeme = $lexemeService->findByTextAndLanguage($word, $language);

        if ($lexeme) {
            $this->lexemeId = $lexeme->id;
            $this->backgroundColor = $lexemeService->determineBackgroundColor($lexeme);
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
        $lexemeId = $payload['lexemeId'] ?? null;

        if ($this->lexemeId !== null && $this->lexemeId !== $lexemeId) {
            return;
        }

        $lexeme = $lexemeService->findByTextAndLanguage($this->word, $this->language);

        if ($lexeme && $lexeme->id === $lexemeId) {
            $this->lexemeId = $lexeme->id;
            $this->backgroundColor = $lexemeService->determineBackgroundColor($lexeme);
        }
    }

    public function render(): View
    {
        return view('livewire.components.lexeme-item');
    }
}
