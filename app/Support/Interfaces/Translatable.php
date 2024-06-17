<?php

namespace App\Support\Interfaces;

interface Translatable
{
    public static function options(): array;

    public function getLabel(): string;
}
