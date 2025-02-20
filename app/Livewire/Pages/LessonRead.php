<?php

namespace App\Livewire\Pages;

use App\Models\Lesson;
use App\Services\LanguageService;
use Illuminate\View\View;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class LessonRead extends Component
{
    public int $lessonId;

    public string $language;

    public string $pageTitle = '';

    public string $text;

    protected LanguageService $languageService;

    public function boot(LanguageService $languageService): void
    {
        $this->languageService = $languageService;
    }

    public function mount(int $lessonId): void
    {
        $lesson = Lesson::findOrFail($lessonId);

        $this->lessonId = $lesson->id;
        $this->language = $lesson->language->value;
        $this->pageTitle  = $lesson->title;
        $this->text = $lesson->text;

        if ($this->language !== $this->languageService->getCurrentLanguage()) {
            $this->languageService->setLanguage($this->language);

            $this->redirectRoute('lessons.read', ['lessonId' => $lesson->id]);
        }
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail->push(__('Lessons'), route('lessons.index'))->push($this->pageTitle);
    }

    public function render(): View
    {
        return view('livewire.pages.lesson-read')->title($this->pageTitle);
    }
}
