<?php

namespace App\Livewire\Pages;

use App\Models\Lexeme;
use App\Services\LanguageService;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Breadcrumbs\Trail;
use Livewire\Attributes\On;

class Lexemes extends Component
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
        $this->pageTitle = __('Words and Expressions');

        // TODO: Prevent duplicate code of sorting function.
        $this->availableSortOptions = [
            [
                'value' => 'updated_at',
                'label' => __('Recently practiced'),
                'action' => '$wire.sortBy("updated_at");',
                'direction' => 'desc',
            ],
            [
                'value' => 'text',
                'label' => __('Alphabetical (A-Z)'),
                'action' => '$wire.sortBy("text");',
                'direction' => 'asc',
            ],
            [
                'value' => 'text',
                'label' => __('Alphabetical (Z-A)'),
                'action' => '$wire.sortBy("text");',
                'direction' => 'desc',
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

        if (! $selectedSortOption) {
            throw new \Exception('Invalid sort value.');
        }

        $this->currentSortField = $selectedSortOption['value'];
        $this->currentSortDirection = $selectedSortOption['direction'];
        $this->currentSortOption = $selectedSortOption;

        $this->resetPage();
    }

    /**
     * Refresh the lexemes list by resetting pagination.
     *
     * Triggered by the 'lexeme-deleted' event.
     */
    #[On('lexeme-deleted')]
    public function refreshLexemes(): void
    {
        $this->resetPage();
    }

    public function render(): View
    {
        $lexemes = Lexeme::where('language', $this->languageService
            ->getCurrentLanguage())
            ->orderBy($this->currentSortField, $this->currentSortDirection)
            ->paginate(10);

        return view('livewire.pages.lexemes', ['lexemes' => $lexemes])->title($this->pageTitle);
    }
}
