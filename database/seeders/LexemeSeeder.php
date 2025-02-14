<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LexemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            \App\Models\Lexeme::factory()->create();
        }
    }
}
