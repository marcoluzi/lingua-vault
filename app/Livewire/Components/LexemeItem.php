<?php

namespace App\Livewire\Components;

use App\Models\Lexeme;
use Livewire\Component;

class LexemeItem extends Component
{
    public $lessonLanguage = '';

    public $word = '';

    public $backgroundColor = 'blue';

    public int $lexemeId = 0;

    public function mount()
    {
        $lexeme = Lexeme::where('text', strtolower($this->word))
            ->where('language', $this->lessonLanguage)
            ->first();

        if ($lexeme) {
            $this->lexemeId = $lexeme->id;
            $this->backgroundColor = $this->getBackgroundColor($lexeme->e_factor);
        }
    }

    private function getBackgroundColor(float $eFactor): string
    {
        return match (true) {
            $eFactor >= 1.3 && $eFactor <= 1.6 => 'red',
            $eFactor >= 1.7 && $eFactor <= 2.1 => 'orange',
            $eFactor >= 2.2 && $eFactor <= 2.5 => 'green',
            default => 'gray',
        };
    }

    public function render()
    {
        return view('livewire.components.lexeme-item');
    }
}
