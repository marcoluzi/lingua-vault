<?php

namespace App\Livewire\Components;

use App\Models\Lexeme;
use Livewire\Component;

class LexemeItem extends Component
{
    public string $word;
    public string $lessonLanguage;
    public int $lessonId;
    public $lexemeId = 'null';
    public string $backgroundColor = 'blue';

    public function mount($word, $lessonLanguage, $lessonId)
    {
        $this->word           = $word;
        $this->lessonLanguage = $lessonLanguage;
        $this->lessonId       = $lessonId;

        // Check for an existing lexeme (matching text and language)
        $existing = Lexeme::where('text', $this->word)
            ->where('language', $this->lessonLanguage)
            ->first();

        if ($existing) {
            $this->lexemeId = $existing->id;
            $this->backgroundColor = $this->getColorForEfactor($existing->e_factor);
        }
    }

    /**
     * Maps the e_factor to a color string.
     */
    private function getColorForEfactor($e_factor): string
    {
        if ($e_factor <= 1.4) {
            return 'red';
        } elseif ($e_factor <= 1.6) {
            return 'orange';
        } elseif ($e_factor <= 1.8) {
            return 'yellow';
        } elseif ($e_factor <= 2.0) {
            return 'green';
        } elseif ($e_factor <= 2.2) {
            return 'teal';
        } else {
            return 'purple';
        }
    }

    public function render()
    {
        return view('livewire.components.lexeme-item');
    }
}
