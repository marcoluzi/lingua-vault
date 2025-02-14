<?php

namespace App\Models;

use App\Support\Enums\Languages;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'text',
        'language',
        'word_count',
    ];

    protected function casts(): array
    {
        return [
            'language' => Languages::class,
        ];
    }

    public function lexemes(): BelongsToMany
    {
        return $this->belongsToMany(Lexeme::class);
    }
}
