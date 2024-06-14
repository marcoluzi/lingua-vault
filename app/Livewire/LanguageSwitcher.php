<?php

namespace App\Livewire;

use App\Models\Language;
use App\Models\Option;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public $languages;

    public $selectedLanguageCode;
    public $selectedLanguageName;

    public function mount()
    {
        $this->languages = Language::all();
        $this->loadSelectedLanguage();
    }

    public function loadSelectedLanguage()
    {
        $option = Option::where('name', 'selected_language')->first();
        $this->selectedLanguageCode = $option ? $option->value : null;
        $this->selectedLanguageName = $this->languages->where('code', $this->selectedLanguageCode)->first()->name ?? null;
    }

    public function chooseLanguage($languageCode)
    {
        $this->selectedLanguageCode = $languageCode;
        $this->selectedLanguageName = $this->languages->where('code', $this->selectedLanguageCode)->first()->name;
        $this->saveSelectedLanguage();

    }

    public function saveSelectedLanguage()
    {
        $option = Option::updateOrCreate(
            ['name' => 'selected_language'],
            ['value' => $this->selectedLanguageCode]
        );
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
