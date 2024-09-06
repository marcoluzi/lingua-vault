<?php

namespace Database\Factories;

use App\Support\Enums\Languages;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'text' => $this->faker->paragraph,
            'language' => $this->faker->randomElement(Languages::class),
            'word_count' => $this->faker->numberBetween(100, 1000),
            'progress' => $this->faker->numberBetween(0, 100),
        ];
    }
}
