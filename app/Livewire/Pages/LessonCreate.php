<?php

namespace App\Livewire\Pages;

use App\Support\Enums\Languages;
use Exception;
use InvalidArgumentException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class LessonCreate extends Component
{
    public $title = '';

    public $languageItems = [];

    public $selectedLanguageItem = [];

    #[Validate('required', message: 'The lesson title is required.')]
    public $lessonTitle = '';

    #[Validate('required', message: 'The lesson text is required.')]
    public $lessonText = '';

    public function mount()
    {
        $this->title = __('Create Lesson');
        $this->setLanguageItems();
        $this->setSelectedLanguageItem();
    }

    // TODO: breadcrumbs break after component update
    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('Lessons'), route('lessons.index'))
            ->push($this->title);
    }

    public function save()
    {
        $this->validate(); 

        dump($this->lessonTitle);
        dump($this->lessonText);
    }

    public function render()
    {
        return view('livewire.pages.lesson-create')->title($this->title);
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
    }

    // TODO: Fix duplicate code with language switcher component
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

    // TODO: Fix duplicate code with language switcher component
    /**
     * Get the selected language from the option table and set it as a property.
     *
     * @return array
     */
    private function setSelectedLanguageItem()
    {
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
