<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Support\Enums\Languages;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lexeme>
 */
class LexemeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'text' => strtolower($this->faker->word),
            'meaning' => $this->faker->sentence,
            'language' => $this->faker->randomElement(Languages::class),
            'repetitions' => $this->faker->numberBetween(1, 10),
            'e_factor' => $this->faker->randomFloat(1, 1.3, 2.5),
        ];
    }
}
