<?php

namespace App\Services;

use App\Models\Lesson;
use App\Models\Lexeme;
use App\Support\Enums\Statuses;

class LexemeService
{
    /**
     * Find a lexeme by text and language.
     */
    public function findByTextAndLanguage(string $text, string $language): ?Lexeme
    {
        return Lexeme::where('text', $text)->where('language', $language)->first();
    }

    /**
     * Determines the background color for a given lexeme based on its status and e-factor.
     *
     * If the lexeme's status is WELL_KNOWN or IGNORED, returns 'white'.
     * Otherwise, it returns a color based on the e-factor range:
     * - 'red' for e-factor between 1.3 and 1.6
     * - 'orange' for e-factor between 1.7 and 2.1
     * - 'green' for e-factor between 2.2 and 2.5
     *
     * If none of the conditions are met, it defaults to 'white'.
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
     * Finds a lexeme by its ID.
     */
    public function findById(int $id): ?Lexeme
    {
        return Lexeme::find($id);
    }

    /**
     * Creates a new lexeme.
     *
     * @param  array{text:string, meaning:string, romanization:string|null, language:string, repetitions:int|null, e_factor:float|null, status:string|null}  $data
     */
    public function createLexeme(array $data): Lexeme
    {
        return Lexeme::create($data);
    }

    /**
     * Updates a lexeme.
     *
     * @param  array{text:string|null, meaning:string|null, romanization:string|null, language:string|null, repetitions:int|null, e_factor:float|null, status:string|null}  $data
     */
    public function updateLexeme(Lexeme $lexeme, array $data): bool
    {
        return $lexeme->update($data);
    }

    /**
     * Attaches a lexeme to a lesson.
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

    /**
     * Deletes a lexeme by its ID.
     *
     * @throws \Exception If the lexeme with the given ID is not found.
     */
    public function deleteLexeme(int $lexemeId): void
    {
        $lexeme = Lexeme::find($lexemeId);

        if (! $lexeme) {
            throw new \Exception('Lexeme with ID '.$lexemeId.' not found.');
        }

        $lexeme->delete();
    }
}
