<?php

namespace App\Livewire\Components;

use App\Services\LexemeService;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\View\View;

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

    #[On('lexeme-updated')]
    public function updateLexeme(LexemeService $lexemeService): void
    {
        $existing = $lexemeService->findByTextAndLanguage($this->word, $this->lessonLanguage);
        if ($existing) {
            $this->lexemeId = $existing->id;
            $this->backgroundColor = $lexemeService->determineBackgroundColor($existing);
        }
    }

    public function render(): View
    {
        return view('livewire.components.lexeme-item');
    }
}
