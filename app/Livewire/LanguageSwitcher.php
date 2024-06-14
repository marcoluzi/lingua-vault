<?php

namespace App\Livewire;

use App\Models\Language;
use App\Models\Option;
use Livewire\Component;
use Livewire\Attributes\On;

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
        $this->selectedLanguageCode = $option ? $option->value : $this->languages->first()->code;
        $this->updateSelectedLanguageName();
    }

    public function updateSelectedLanguageName()
    {
        $language = $this->languages->where('code', $this->selectedLanguageCode)->first();
        $this->selectedLanguageName = $language ? $language->name : __('Select language');
    }

    public function chooseLanguage($languageCode)
    {
        $this->selectedLanguageCode = $languageCode;
        $this->updateSelectedLanguageName();
        $this->saveSelectedLanguage();
        $this->dispatch('languageChanged', $languageCode);
    }

    public function saveSelectedLanguage()
    {
        Option::updateOrCreate(
            ['name' => 'selected_language'],
            ['value' => $this->selectedLanguageCode]
        );
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
