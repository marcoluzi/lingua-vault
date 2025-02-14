<?php

namespace App\Services;

use App\Models\Lesson;
use App\Models\Lexeme;
use App\Support\Enums\Statuses;

class LexemeService
{
    /**
     * Retrieve a lexeme by its text and language.
     */
    public function findByTextAndLanguage(string $text, string $language): ?Lexeme
    {
        return Lexeme::where('text', $text)
            ->where('language', $language)
            ->first();
    }

    /**
     * Determine the background color for a lexeme based on its e_factor and status.
     */
    public function determineBackgroundColor(Lexeme $lexeme): string
    {
        if ($lexeme->status === Statuses::WELL_KNOWN || $lexeme->status === Statuses::IGNORED) {
            return 'white';
        }

        return match (true) {
            $lexeme->e_factor >= 1.3 && $lexeme->e_factor <= 1.6 => 'red',
            $lexeme->e_factor >= 1.7 && $lexeme->e_factor <= 2.1 => 'orange',
            $lexeme->e_factor >= 2.2 && $lexeme->e_factor <= 2.5 => 'green',
            default => 'white',
        };
    }

    /**
     * Retrieve a lexeme by its id.
     */
    public function findById(int $id): ?Lexeme
    {
        return Lexeme::find($id);
    }

    /**
     * Create a new lexeme record.
     */
    public function createLexeme(array $data): Lexeme
    {
        return Lexeme::create($data);
    }

    /**
     * Update an existing lexeme record.
     */
    public function updateLexeme(Lexeme $lexeme, array $data): bool
    {
        return $lexeme->update($data);
    }

    /**
     * Attach a lexeme to a lesson.
     */
    public function attachToLesson(Lexeme $lexeme, int $lessonId): bool
    {
        $lesson = Lesson::find($lessonId);
        if ($lesson) {
            $lesson->lexemes()->attach($lexeme->id);

            return true;
        }

        return false;
    }
}
