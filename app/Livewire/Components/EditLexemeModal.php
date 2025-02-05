<?php

namespace App\Livewire\Components;

use App\Models\Lexeme;
use LivewireUI\Modal\ModalComponent;

class EditLexemeModal extends ModalComponent
{
    public int $lexemeId;

    public $text = '';

    public $meaning = '';

    public $pronunciation = '';

    public function mount()
    {
        $lexeme = Lexeme::find($this->lexemeId);

        if ($lexeme) {
            $this->text = $lexeme->text;
            $this->meaning = $lexeme->meaning;
            $this->pronunciation = $lexeme->pronunciation;
        }
    }

    public function render()
    {
        return view('livewire.components.edit-lexeme-modal');
    }
}
