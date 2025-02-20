<?php

namespace App\Livewire\Components;

use App\Services\LanguageService;
use Illuminate\View\View;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public array $languageItems = [];

    public array $selectedLanguageItem = [];

    protected LanguageService $languageService;

    public function boot(LanguageService $languageService): void
    {
        $this->languageService = $languageService;
    }

    public function mount(): void
    {
        $this->languageItems = $this->languageService->getAvailableLanguages();
        $this->selectedLanguageItem = $this->languageService->getSelectedLanguage();
    }

    /**
     * Set the selected language by updating the selectedLanguage property and redirecting to the lessons.index route.
     */
    public function setLanguage(string $selectedLanguage): void
    {
        $this->languageService->setLanguage($selectedLanguage);
        $this->selectedLanguageItem = $this->languageService->getSelectedLanguage();

        $this->redirectRoute('lessons.index');
    }

    public function render(): View
    {
        return view('livewire.components.language-switcher');
    }
}
