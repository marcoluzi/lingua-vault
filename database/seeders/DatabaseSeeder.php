<?php

namespace Database\Seeders;

use App\Models\Lesson;
use App\Models\Lexeme;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create lessons
        $lessons = Lesson::factory()->count(20)->create();

        // Create lexemes and associate them with lessons
        $lessons->each(function ($lesson) {
            $lexemes = Lexeme::factory()->count(rand(5, 15))->create();

            // Attach lexemes to the lesson via the pivot table
            $lesson->lexemes()->attach($lexemes->pluck('id')->toArray());
        });
    }
}
