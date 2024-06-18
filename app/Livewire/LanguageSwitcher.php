<?php

namespace App\Livewire;

use App\Models\Option;
use App\Support\Enums\Languages;
use InvalidArgumentException;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public $languages = [];

    public $selectedLanguage = '';

    public function mount()
    {
        $this->languages = array_column(Languages::cases(), 'value');
        $this->selectedLanguage = Option::where('name', 'selected_language')->get(['value'])->first()->value ?? Languages::EN->value;
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
            throw new InvalidArgumentException("Privided language is not a valid case of the Languages enum. Given: {$selectedLanguage}");
        }

        $this->selectedLanguage = $selectedLanguage;

        Option::updateOrCreate(
            ['name' => 'selected_language'],
            ['value' => Languages::from($selectedLanguage)->value]
        );
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
