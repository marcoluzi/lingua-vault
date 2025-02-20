<?php

namespace App\Livewire\Pages;

use App\Livewire\Traits\WithLanguageModelQuery;
use App\Livewire\Traits\WithSortable;
use App\Models\Lesson;
use App\Services\LanguageService;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Breadcrumbs\Trail;

class Lessons extends Component
{
    use WithPagination, WithSortable, WithLanguageModelQuery;

    public string $pageTitle = '';

    protected LanguageService $languageService;

    public function boot(LanguageService $languageService): void
    {
        $this->languageService = $languageService;
    }

    public function mount(): void
    {
        $this->pageTitle = __('Lessons');

        $this->initializeSortable();
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail->push($this->pageTitle);
    }

    /**
     * Refresh the lessons list by resetting pagination.
     * Triggered by the 'lesson-deleted' event.
     */
    #[On('lesson-deleted')]
    public function refreshLessons(): void
    {
        $this->resetPage();
    }

    protected function getSortOptions(): array
    {
        return [
            [
                'value' => 'updated_at',
                'label' => __('Recently practiced'),
                'action' => '$wire.sortBy("updated_at");',
                'direction' => 'desc',
            ],
            [
                'value' => 'title-asc',
                'column' => 'title',
                'label' => __('Alphabetical (A-Z)'),
                'action' => '$wire.sortBy("title-asc");',
                'direction' => 'asc',
            ],
            [
                'value' => 'title-desc',
                'column' => 'title',
                'label' => __('Alphabetical (Z-A)'),
                'action' => '$wire.sortBy("title-desc");',
                'direction' => 'desc',
            ],
            [
                'value' => 'progress',
                'label' => __('Progress'),
                'action' => '$wire.sortBy("progress");',
                'direction' => 'asc',
            ],
        ];
    }

    protected function getModelClass(): string
    {
        return Lesson::class;
    }

    public function render(): View
    {
        $lessons = $this->getPaginatedModels();

        return view('livewire.pages.lessons', ['lessons' => $lessons])->title($this->pageTitle);
    }
}
