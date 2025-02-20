<?php

namespace App\Livewire\Components;

use App\Services\LanguageService;
use Illuminate\View\View;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public array $availableLanguages = [];

    public array $currentLanguage = [];

    protected LanguageService $languageService;

    public function boot(LanguageService $languageService): void
    {
        $this->languageService = $languageService;
    }

    public function mount(): void
    {
        $this->availableLanguages = $this->languageService->getAvailableLanguages();
        $this->currentLanguage = $this->languageService->getSelectedLanguage();
    }

    /**
     * Update the current language and redirect to the lessons.index route.
     */
    public function setLanguage(string $language): void
    {
        $this->languageService->setLanguage($language);
        $this->currentLanguage = $this->languageService->getSelectedLanguage();

        $this->redirectRoute('lessons.index');
    }

    public function render(): View
    {
        return view('livewire.components.language-switcher');
    }
}
