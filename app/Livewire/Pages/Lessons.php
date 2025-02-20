<?php

namespace App\Livewire\Pages;

use App\Models\Lesson;
use App\Services\LanguageService;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Breadcrumbs\Trail;

class Lessons extends Component
{
    use WithPagination;

    public string $pageTitle = '';

    public array $availableSortOptions = [];

    public array $currentSortOption = [];

    public string $currentSortField = 'updated_at';

    public string $currentSortDirection = 'desc';

    protected LanguageService $languageService;

    public function boot(LanguageService $languageService): void
    {
        $this->languageService = $languageService;
    }

    public function mount(): void
    {
        $this->pageTitle = __('Lessons');

        $this->availableSortOptions = [
            [
                'value' => 'updated_at',
                'label' => __('Recently practiced'),
                'action' => '$wire.sortBy("updated_at")',
                'direction' => 'desc',
            ],
            [
                'value' => 'title',
                'label' => __('Alphabetical (A-Z)'),
                'action' => '$wire.sortBy("title")',
                'direction' => 'asc',
            ],
            [
                'value' => 'progress',
                'label' => __('Progress'),
                'action' => '$wire.sortBy("progress")',
                'direction' => 'asc',
            ],
        ];

        $this->currentSortOption = $this->availableSortOptions[0];
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail->push($this->pageTitle);
    }

    /**
     * Set the sort field and direction based on the selected sort option.
     *
     * @throws \Exception If the sort value is invalid.
     */
    public function sortBy(string $value): void
    {
        $selectedSortOption = collect($this->availableSortOptions)->firstWhere('value', $value);

        if (!$selectedSortOption) {
            throw new \Exception('Invalid sort value.');
        }

        $this->currentSortField = $selectedSortOption['value'];
        $this->currentSortDirection = $selectedSortOption['direction'];
        $this->currentSortOption = $selectedSortOption;

        $this->resetPage();
    }

    /**
     * Refresh the lessons list by resetting pagination.
     *
     * Triggered by the 'lesson-deleted' event.
     */
    #[On('lesson-deleted')]
    public function refreshLessons(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $lessons = Lesson::where('language', $this->languageService
            ->getCurrentLanguage())
            ->orderBy($this->currentSortField, $this->currentSortDirection)
            ->paginate(10);

        return view('livewire.pages.lessons', ['lessons' => $lessons])->title($this->pageTitle);
    }
}
