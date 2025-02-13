<?php

namespace App\Livewire\Components;

use App\Models\Lexeme;
use App\Models\Lesson;
use LivewireUI\Modal\ModalComponent;

class EditLexemeModal extends ModalComponent
{
    public ?int $lexemeId;
    public string $word;
    public string $lessonLanguage;
    public int $lessonId;

    public ?string $meaning = '';
    public ?string $romanized = '';
    public string $status = '1';

    // Mapping of status values to e_factor
    protected array $statusMapping = [
        '1'           => 1.3,
        '2'           => 1.5,
        '3'           => 1.7,
        '4'           => 1.9,
        '5'           => 2.1,
        'Well Known'  => 2.3,
        'Ignored'     => 2.5,
    ];

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

                // Reverse-map the e_factor to a status option
                foreach ($this->statusMapping as $key => $value) {
                    if (abs($lexeme->e_factor - $value) < 0.01) {
                        $this->status = (string) $key;
                        break;
                    }
                }
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
        // Map the selected status to an e_factor value
        $e_factor = $this->statusMapping[$this->status] ?? 1.3;

        $data = [
            'text'      => $this->word,
            'meaning'   => $this->meaning,
            'romanized' => $this->romanized,
            'language'  => $this->lessonLanguage,
            'e_factor'  => $e_factor,
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
