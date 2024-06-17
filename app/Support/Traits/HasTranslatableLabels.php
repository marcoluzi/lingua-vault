<?php

namespace App\Support\Traits;

trait HasTranslatableLabels
{
    public function getLabel(): string
    {
        return self::options()[$this->value];
    }
}
