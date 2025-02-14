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

    protected LexemeService $lexemeService;

    public function mount($word, $lessonLanguage, $lessonId)
    {
        $this->word = $word;
        $this->lessonLanguage = $lessonLanguage;
        $this->lessonId = $lessonId;

        // Retrieve the LexemeService instance from the container.
        $this->lexemeService = app(LexemeService::class);

        $existing = $this->lexemeService->findByTextAndLanguage($this->word, $this->lessonLanguage);
        if ($existing) {
            $this->lexemeId = $existing->id;
            $this->backgroundColor = $this->lexemeService->determineBackgroundColor($existing);
        }
    }

    #[On('lexeme-updated')]
    public function updateLexeme()
    {
        $existing = $this->lexemeService->findByTextAndLanguage($this->word, $this->lessonLanguage);
        if ($existing) {
            $this->lexemeId = $existing->id;
            $this->backgroundColor = $this->lexemeService->determineBackgroundColor($existing);
        }
    }

    public function render()
    {
        return view('livewire.components.lexeme-item');
    }
}
