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

    public array $tokens = [];

    protected LanguageService $languageService;

    public function boot(LanguageService $languageService): void
    {
        $this->languageService = $languageService;
    }

    /**
     * Tokenize text into words and punctuation.
     *
     * @return array<array{content: string, type: string}>
     */
    protected function tokenizeText(string $text): array
    {
        // First, split into paragraphs while preserving double newlines
        $paragraphs = preg_split('/(\R{2,})/u', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
        $tokens = [];

        foreach ($paragraphs as $paragraph) {
            if (preg_match('/^\R+$/u', $paragraph)) {
                // This is a paragraph separator (double newline)
                $tokens[] = ['content' => '', 'type' => 'paragraph-break'];
                continue;
            }

            // Process words, punctuation and spaces within each paragraph
            $pattern = '/([^\s\p{P}]+)|([^\w\s])|(\s+)/u';
            preg_match_all($pattern, $paragraph, $matches, PREG_SET_ORDER);

            foreach ($matches as $match) {
                if (! empty($match[1])) { // Word
                    $tokens[] = ['content' => $match[1], 'type' => 'word'];
                } elseif (! empty($match[2])) { // Punctuation
                    $tokens[] = ['content' => $match[2], 'type' => 'punctuation'];
                } elseif (! empty($match[3])) { // Space
                    $tokens[] = ['content' => ' ', 'type' => 'space'];
                }
            }
        }

        return $tokens;
    }

    public function mount(int $lessonId): void
    {
        $lesson = Lesson::findOrFail($lessonId);

        $this->lessonId = $lesson->id;
        $this->language = $lesson->language->value;
        $this->pageTitle = $lesson->title;
        $this->text = $lesson->text;
        $this->tokens = $this->tokenizeText($this->text);

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
