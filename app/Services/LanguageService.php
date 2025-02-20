<?php

namespace App\Services;

use App\Support\Enums\Languages;
use InvalidArgumentException;

class LanguageService
{
    /**
     * Retrieves an array of available languages.
     *
     * It uses the Languages enum to generate an array of language items.
     * Each language item contains the language value, label, image path, alt text and an action.
     * The action is a string that calls the setLanguage method with the language value as an argument.
     *
     * @return array<int, array{value: string, label: string, image: string, alt: string, action: string}>
     */
    public function getAvailableLanguages(): array
    {
        return array_map(function (Languages $language) {
            return [
                'value' => $language->value,
                'label' => $language->getLabel(),
                'image' => asset('flags/'.$language->value.'.svg'),
                'alt' => __('Flag for :language', ['language' => $language->getLabel()]),
                'action' => '$wire.setLanguage(\''.$language->value.'\');',
            ];
        }, Languages::cases());
    }

    /**
     * Retrieves the currently selected language as an associative array.
     *
     * The array contains the language's value, label, image path, and alt text.
     * The label is derived from the Languages enum, and the image path points to
     * the language's flag.
     *
     * @return array{value:string, label:string, image:string, alt:string}
     */
    public function getSelectedLanguage(): array
    {
        $selectedLanguage = $this->getCurrentLanguage();

        return [
            'value' => $selectedLanguage,
            'label' => Languages::from($selectedLanguage)->getLabel(),
            'image' => asset('flags/'.$selectedLanguage.'.svg'),
            'alt' => __('Flag for :language', ['language' => Languages::from($selectedLanguage)->getLabel()]),
        ];
    }

    /**
     * Retrieves the currently selected language as a string.
     *
     * It defaults to the first language in the Languages enum if no language is
     * set in the settings.
     */
    public function getCurrentLanguage(): string
    {
        return \Settings::get('selected_language') ?? Languages::cases()[0]->value;
    }

    /**
     * Sets the currently selected language.
     *
     * @throws InvalidArgumentException If the provided language is not a valid case of the Languages enum.
     */
    public function setLanguage(string $selectedLanguage): void
    {
        if (! Languages::tryFrom($selectedLanguage)) {
            throw new InvalidArgumentException("Invalid language: {$selectedLanguage}");
        }

        \Settings::set('selected_language', $selectedLanguage);
    }
}
