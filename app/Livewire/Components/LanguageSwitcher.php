<?php

namespace App\Livewire\Components;

use App\Services\LanguageService;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public $languageItems = [];

    public $selectedLanguageItem = [];

    protected LanguageService $languageService;

    public function boot(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    public function mount()
    {
        $this->languageItems = $this->languageService->getAvailableLanguages();
        $this->selectedLanguageItem = $this->languageService->getSelectedLanguage();
    }

    public function setLanguage($selectedLanguage)
    {
        $this->languageService->setLanguage($selectedLanguage);
        $this->selectedLanguageItem = $this->languageService->getSelectedLanguage();
    }

    public function render()
    {
        return view('livewire.components.language-switcher');
    }
}
