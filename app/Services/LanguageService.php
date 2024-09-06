<?php

namespace App\Services;

use App\Support\Enums\Languages;
use InvalidArgumentException;

class LanguageService
{
    public function getAvailableLanguages(): array
    {
        return array_map(function ($language) {
            return [
                'value' => $language->value,
                'label' => $language->getLabel(),
                'image' => asset('flags/'.$language->value.'.svg'),
                'alt' => __('Flag for :language', ['language' => $language->getLabel()]),
                'action' => '$wire.setLanguage(\''.$language->value.'\')',
            ];
        }, Languages::cases());
    }

    public function getSelectedLanguage(): array
    {
        $selectedLanguage = \Settings::get('selected_language') ?? Languages::cases()[0]->value;

        return [
            'value' => $selectedLanguage,
            'label' => Languages::from($selectedLanguage)->getLabel(),
            'image' => asset('flags/'.$selectedLanguage.'.svg'),
            'alt' => __('Flag for :language', ['language' => Languages::from($selectedLanguage)->getLabel()]),
        ];
    }

    public function setLanguage(string $selectedLanguage): void
    {
        if (!Languages::tryFrom($selectedLanguage)) {
            throw new InvalidArgumentException("Invalid language: {$selectedLanguage}");
        }

        \Settings::set('selected_language', $selectedLanguage);
    }
}
