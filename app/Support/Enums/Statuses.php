<?php

namespace App\Support\Enums;

use App\Support\Interfaces\Translatable;
use App\Support\Traits\HasTranslatableLabels;

enum Statuses: string implements Translatable
{
    use HasTranslatableLabels;

    case WELL_KNOWN = 'well-known';
    case IGNORED = 'ignored';

    public static function options(): array
    {
        return [
            self::WELL_KNOWN->value => __('Well known'),
            self::IGNORED->value => __('Ignored'),
        ];
    }
}
