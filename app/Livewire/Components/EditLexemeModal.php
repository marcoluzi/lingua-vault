<?php

namespace App\Livewire\Components;

use App\Models\Lexeme;
use App\Models\Lesson;
use LivewireUI\Modal\ModalComponent;

class EditLexemeModal extends ModalComponent
{
    public ?int $lexemeId = null;
    public string $word;
    public string $lessonLanguage;
    public int $lessonId;

    public ?string $meaning = '';
    public ?string $romanized = '';

    public function mount($lexemeId, $word, $lessonLanguage, $lessonId)
    {
        $this->lexemeId       = $lexemeId;
        $this->word           = $word;
        $this->lessonLanguage = $lessonLanguage;
        $this->lessonId       = $lessonId;

        if ($this->lexemeId) {
            $lexeme = Lexeme::find($this->lexemeId);

            if ($lexeme) {
                $this->meaning   = $lexeme->meaning;
                $this->romanized = $lexeme->romanized;
            }
        }
    }

    /**
     * Auto-save when any bound property is updated.
     */
    public function updated($propertyName)
    {
        $this->save();
    }

    public function save()
    {
        $data = [
            'text'      => $this->word,
            'meaning'   => $this->meaning,
            'romanized' => $this->romanized,
            'language'  => $this->lessonLanguage,
        ];

        if ($this->lexemeId) {
            $lexeme = Lexeme::find($this->lexemeId);
            if ($lexeme) {
                $lexeme->update($data);
            }
        } else {
            $lexeme = Lexeme::create($data);
            $this->lexemeId = $lexeme->id;

            // Attach the newly created lexeme to the lesson via the pivot table
            $lesson = Lesson::find($this->lessonId);
            if ($lesson) {
                $lesson->lexemes()->attach($lexeme->id);
            }
        }
    }

    public function render()
    {
        return view('livewire.components.edit-lexeme-modal');
    }
}
