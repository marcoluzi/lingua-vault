<?php

namespace App\Livewire\Pages;

use App\Models\Lesson;
use App\Services\LanguageService;
use Livewire\Component;
use WireUi\Breadcrumbs\Trail;

class LessonRead extends Component
{
    public int $lessonId;

    public string $lessonLanguage;

    public string $title;

    public string $text;

    protected LanguageService $languageService;

    public function boot(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    public function mount($lessonId)
    {
        $lesson = Lesson::findOrFail($lessonId);
        $this->lessonId = $lesson->id;
        $this->lessonLanguage = $lesson->language->value;
        $this->title = $lesson->title;
        $this->text = $lesson->text;

        if ($this->lessonLanguage !== $this->languageService->getCurrentLanguage()) {
            $this->languageService->setLanguage($this->lessonLanguage);

            return redirect()->route('lessons.read', ['lessonId' => $lesson->id]);
        }
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail
            ->push(__('Lessons'), route('lessons.index'))
            ->push($this->title);
    }

    public function render()
    {
        return view('livewire.pages.lesson-read')->title($this->title);
    }
}
