<?php

namespace App\Livewire\Components;

use App\Support\Enums\Languages;
use Exception;
use InvalidArgumentException;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public $languageItems = [];

    public $selectedLanguageItem = [];

    public function mount()
    {
        $this->setLanguageItems();
        $this->setSelectedLanguageItem();
    }

    /**
     * Set the selected language by updating the selectedLanguage property and saving it to the option table.
     *
     * @param  string  $selectedLanguage  The selected language as a two letter string, that is a case of the Languages enum.
     * @return void
     *
     * @throws InvalidArgumentException If the provided language is not a valid case of the Languages enum.
     */
    public function setLanguage($selectedLanguage)
    {
        if (! Languages::tryFrom($selectedLanguage)) {
            throw new InvalidArgumentException("Provided language is not a valid case of the Languages enum. Given: {$selectedLanguage}");
        }

        $this->selectedLanguageItem = [
            'value' => $selectedLanguage,
            'label' => Languages::from($selectedLanguage)->getLabel(),
            'image' => asset('flags/'.$selectedLanguage.'.svg'),
            'alt' => __('Flag for :language', ['language' => Languages::from($selectedLanguage)->getLabel()]),
        ];

        \Settings::set('selected_language', Languages::from($selectedLanguage)->value);
    }

    public function render()
    {
        return view('livewire.components.language-switcher');
    }

    /**
     * Create the language items array and set it as a property.
     *
     * @return void
     *
     * @throws Exception If no languages are found in the Languages enum.
     */
    private function setLanguageItems()
    {
        $languages = Languages::cases();

        if (empty($languages)) {
            throw new Exception('No languages found in the Languages enum.');
        }

        $languageItems = [];

        foreach ($languages as $language) {
            $languageItems[] = [
                'value' => $language->value,
                'label' => $language->getLabel(),
                'image' => asset('flags/'.$language->value.'.svg'),
                'alt' => __('Flag for :language', ['language' => $language->getLabel()]),
                'action' => '$wire.setLanguage(\''.$language->value.'\')',
            ];
        }

        $this->languageItems = $languageItems;
    }

    /**
     * Get the selected language from the option table and set it as a property.
     *
     * @return array
     */
    private function setSelectedLanguageItem()
    {
        /*$selectedLanguage = Option::where('name', 'selected_language')->value('value') ?? $this->languageItems[0]['value'];*/
        $selectedLanguage = \Settings::get('selected_language') ?? $this->languageItems[0]['value'];

        $selectedLanguageItem = [
            'value' => $selectedLanguage,
            'label' => Languages::from($selectedLanguage)->getLabel(),
            'image' => asset('flags/'.$selectedLanguage.'.svg'),
            'alt' => __('Flag for :language', ['language' => Languages::from($selectedLanguage)->getLabel()]),
        ];

        $this->selectedLanguageItem = $selectedLanguageItem;
    }
}
