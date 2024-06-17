<?php

namespace App\Livewire;

use App\Models\Option;
use App\Support\Enums\Languages;
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

    public function setLanguage($selectedLanguage)
    {
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
