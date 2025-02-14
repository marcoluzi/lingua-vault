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
     * Determine the full Tailwind CSS class string for a lexeme's background and border.
     * All possible classes are explicitly returned.
     */
    public function determineBackgroundColor(Lexeme $lexeme): string
    {
        if ($lexeme->status === Statuses::WELL_KNOWN || $lexeme->status === Statuses::IGNORED) {
            return 'bg-white border border-gray-300';
        }

        if ($lexeme->e_factor >= 1.3 && $lexeme->e_factor <= 1.6) {
            return 'bg-red-200 border border-red-400';
        }

        if ($lexeme->e_factor >= 1.7 && $lexeme->e_factor <= 2.1) {
            return 'bg-orange-200 border border-orange-400';
        }

        if ($lexeme->e_factor >= 2.2 && $lexeme->e_factor <= 2.5) {
            return 'bg-green-200 border border-green-400';
        }

        // Default case
        return 'bg-white border border-gray-300';
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
