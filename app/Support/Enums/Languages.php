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
