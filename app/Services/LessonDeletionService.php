<?php

namespace App\Services;

use App\Models\Lesson;

class LessonDeletionService
{
    /**
     * Deletes a lesson by its ID.
     *
     * @throws \Exception If the lesson with the given ID is not found.
     */
    public function deleteLesson(int $lessonId): void
    {
        $lesson = Lesson::find($lessonId);

        if (! $lesson) {
            throw new \Exception('Lesson with ID '.$lessonId.' not found.');
        }

        $lesson->delete();
    }
}
