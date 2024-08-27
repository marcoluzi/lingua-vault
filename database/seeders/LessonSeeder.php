<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 10 lessons with random title and random text
        for ($i = 0; $i < 50; $i++) {
            \App\Models\Lesson::factory()->create();
        }

    }
}
