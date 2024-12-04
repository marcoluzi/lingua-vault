<?php

namespace App\Livewire\Components;

use App\Models\Lexeme;
use Livewire\Component;

class LexemeItem extends Component
{
    public string $lessonLanguage;

    public string $word;

    public string $backgroundColor = 'blue';

    public function mount()
    {
        $lexeme = Lexeme::where('text', strtolower($this->word))
            ->where('language', $this->lessonLanguage)
            ->first();

        if ($lexeme) {
            $this->backgroundColor = $this->getBackgroundColor($lexeme->e_factor);
        }
    }

    /**
     * Determine the background color based on the given e-factor.
     *
     * Colors are set as follows:
     * - Red: 1.3 <= eFactor <= 1.6
     * - Orange: 1.7 <= eFactor <= 2.1
     * - Green: 2.2 <= eFactor <= 2.5
     * - Gray: All other cases
     *
     * @param float $eFactor
     * @return string
     */
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
