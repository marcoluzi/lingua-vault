<?php

namespace App\Livewire\Components;

use App\Services\LexemeService;
use Livewire\Attributes\On;
use Livewire\Component;

class LexemeItem extends Component
{
    public string $word;

    public string $lessonLanguage;

    public int $lessonId;

    public ?int $lexemeId = null;

    public string $backgroundColor = 'blue';

    public function mount(LexemeService $lexemeService, $word, $lessonLanguage, $lessonId)
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
    public function updateLexeme(LexemeService $lexemeService)
    {
        $existing = $lexemeService->findByTextAndLanguage($this->word, $this->lessonLanguage);
        if ($existing) {
            $this->lexemeId = $existing->id;
            $this->backgroundColor = $lexemeService->determineBackgroundColor($existing);
        }
    }

    public function render()
    {
        return view('livewire.components.lexeme-item');
    }
}
