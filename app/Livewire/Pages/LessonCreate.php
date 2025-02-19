<?php

namespace App\Livewire\Pages;

use App\Models\Lesson;
use App\Support\Enums\Languages;
use Exception;
use Illuminate\View\View;
use InvalidArgumentException;
use Livewire\Attributes\Validate;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class LessonCreate extends Component
{
    public string $title = '';

    public array $languageItems = [];

    #[Validate('required', message: 'The language is required.')]
    public array $selectedLanguageItem = [];

    #[Validate('required', message: 'The lesson title is required.')]
    public string $lessonTitle = '';

    #[Validate('required', message: 'The lesson text is required.')]
    public string $lessonText = '';

    public function mount(): void
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

    /**
     * Validates the component data and creates a new lesson.
     *
     * It validates the language, title, and text input and then creates a new
     * lesson with the validated data. After the lesson is created, it redirects
     * the user to the lessons index page.
     */
    public function save(): void
    {
        $this->validate();

        Lesson::create([
            'language' => $this->selectedLanguageItem['value'],
            'title' => $this->lessonTitle,
            'text' => $this->lessonText,
            'word_count' => str_word_count($this->lessonText),
        ]);

        $this->redirectRoute('lessons.index');
    }

    /**
     * Sets the selected language property.
     *
     * It takes a string of the language value and sets the selected language property
     * to an array containing the language value, label, image path and alt text.
     *
     * @throws InvalidArgumentException If the provided language is not a valid case of the Languages enum.
     */
    public function setLanguage(string $selectedLanguage): void
    {
        $language = Languages::tryFrom($selectedLanguage);
        if ($language === null) {
            throw new InvalidArgumentException("Provided language is not a valid case of the Languages enum. Given: {$selectedLanguage}");
        }

        $this->selectedLanguageItem = [
            'value' => $selectedLanguage,
            'label' => $language->getLabel(),
            'image' => asset('flags/'.$selectedLanguage.'.svg'),
            'alt' => __('Flag for :language', ['language' => $language->getLabel()]),
        ];
    }

    /**
     * Sets the language items for the language select menu.
     *
     * It uses the Languages enum to generate an array of language items.
     * Each language item contains the language value, label, image path, alt text and an action.
     * The action is a string that calls the setLanguage method with the language value as an argument.
     *
     * @throws Exception If no languages are found in the Languages enum.
     */
    private function setLanguageItems(): void
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
     * Sets the selected language item based on the current language setting.
     *
     * Retrieves the selected language from settings or defaults to the first language item.
     * It then updates the selectedLanguageItem property with the language's value, label, image path, and alt text.
     */
    private function setSelectedLanguageItem(): void
    {
        $selectedLanguage = \Settings::get('selected_language') ?? $this->languageItems[0]['value'];
        $language = Languages::from($selectedLanguage);

        $this->selectedLanguageItem = [
            'value' => $selectedLanguage,
            'label' => $language->getLabel(),
            'image' => asset('flags/'.$selectedLanguage.'.svg'),
            'alt' => __('Flag for :language', ['language' => $language->getLabel()]),
        ];
    }

    public function render(): View
    {
        return view('livewire.pages.lesson-create')->title($this->title);
    }
}
