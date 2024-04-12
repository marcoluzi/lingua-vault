<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('languages')->insert([
            'name' => __('English'),
            'code' => 'en',
        ]);
        DB::table('languages')->insert([
            'name' => __('German'),
            'code' => 'de',
        ]);
        DB::table('languages')->insert([
            'name' => __('Italian'),
            'code' => 'it',
        ]);
    }
}
