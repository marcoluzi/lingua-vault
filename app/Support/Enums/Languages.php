<?php

namespace App\Support\Enums;

use App\Support\Interfaces\Translatable;
use App\Support\Traits\HasTranslatableLabels;

enum Languages: string implements Translatable
{
    use HasTranslatableLabels;

    case DE = 'de';
    case EN = 'en';
    case FR = 'fr';
    case IT = 'it';

    /**
     * Retrieves an array of language options.
     *
     * The array maps language values to their translated labels.
     *
     * @return array<string, string> An associative array where the keys are language codes and the values are the translated language names.
     */
    public static function options(): array
    {
        return [
            self::DE->value => __('German'),
            self::EN->value => __('English'),
            self::FR->value => __('French'),
            self::IT->value => __('Italian'),
        ];
    }
}
