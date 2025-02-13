<?php

namespace App\Models;

use App\Support\Enums\Languages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lexeme extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'meaning',
        'romanized',
        'language',
        'e_factor',
    ];

    protected function casts(): array
    {
        return [
            'language' => Languages::class,
        ];
    }
}
