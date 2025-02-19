<?php

namespace App\Support\Enums;

use App\Support\Interfaces\Translatable;
use App\Support\Traits\HasTranslatableLabels;

enum Statuses: string implements Translatable
{
    use HasTranslatableLabels;

    case WELL_KNOWN = 'well-known';
    case IGNORED = 'ignored';

    /**
     * Retrieves an array of statuses.
     *
     * The array maps status values to their translated labels.
     *
     * @return array<string, string> An associative array where the keys are the status values and the values are the translated status names.
     */
    public static function options(): array
    {
        return [
            self::WELL_KNOWN->value => __('Well known'),
            self::IGNORED->value    => __('Ignored'),
        ];
    }
}
