<?php

namespace App\Services;

use App\Models\Lesson;

class LessonDeletionService
{
    /**
     * Deleting the lesson by the given id.
     *
     *
     * @throws \Exception If the lesson is not found.
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
