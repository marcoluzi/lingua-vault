<?php

namespace App\Livewire\Components;

use App\Models\Lexeme;
use Livewire\Component;

class LexemeItem extends Component
{
    public string $word;
    public ?Lexeme $lexeme = null;

    public function mount(string $word)
    {
        $this->lexeme = Lexeme::where('text', $word)->first();
    }

    public function render()
    {
        return view('livewire.components.lexeme-item', [
            'lexemeExists' => $this->lexeme !== null,
        ]);
    }
}
