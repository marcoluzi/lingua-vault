<?php

namespace App\Livewire;

use App\Models\Option;
use Livewire\Component;

class LanguageSwitcher extends Component
{
    public $languages = [];
    public $selectedLanguage = '';

    public function mount()
    {
        $this->languages = config('app.languages');
        $this->selectedLanguage = Option::where('name', 'selected_language')->get(['value'])->first()->value ?? 'en';
    }

    public function setLanguage($code)
    {
        $this->selectedLanguage = $code;
        Option::updateOrCreate(
            ['name' => 'selected_language'],
            ['value' => $code]
        );
    }

    public function render()
    {
        return view('livewire.language-switcher');
    }
}
