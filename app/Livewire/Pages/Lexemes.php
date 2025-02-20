<?php

namespace App\Livewire\Pages;

use App\Livewire\Traits\WithLanguageModelQuery;
use App\Livewire\Traits\WithSortable;
use App\Models\Lexeme;
use App\Services\LanguageService;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Breadcrumbs\Trail;

class Lexemes extends Component
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
        $this->pageTitle = __('Words and Expressions');
        $this->initializeSortable();
    }

    public function breadcrumbs(Trail $trail): Trail
    {
        return $trail->push($this->pageTitle);
    }

    /**
     * Refresh the lexemes list by resetting pagination.
     * Triggered by the 'lexeme-deleted' event.
     */
    #[On('lexeme-deleted')]
    public function refreshLexemes(): void
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
                'value' => 'text-asc',
                'column' => 'text',
                'label' => __('Alphabetical (A-Z)'),
                'action' => '$wire.sortBy("text-asc");',
                'direction' => 'asc',
            ],
            [
                'value' => 'text-desc',
                'column' => 'text',
                'label' => __('Alphabetical (Z-A)'),
                'action' => '$wire.sortBy("text-desc");',
                'direction' => 'desc',
            ],
        ];
    }

    protected function getModelClass(): string
    {
        return Lexeme::class;
    }

    public function render(): View
    {
        $lexemes = $this->getPaginatedModels();

        return view('livewire.pages.lexemes', ['lexemes' => $lexemes])->title($this->pageTitle);
    }
}
