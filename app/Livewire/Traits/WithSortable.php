<?php

namespace App\Livewire\Traits;

trait WithSortable
{
    public array $availableSortOptions = [];
    public array $currentSortOption = [];
    public string $currentSortField = 'updated_at';
    public string $currentSortDirection = 'desc';

    abstract protected function getSortOptions(): array;

    protected function initializeSortable(): void
    {
        $this->availableSortOptions = $this->getSortOptions();
        $this->currentSortOption = $this->availableSortOptions[0] ?? [];
        $this->currentSortField = $this->currentSortOption['column'] ?? $this->currentSortOption['value'] ?? 'updated_at';
        $this->currentSortDirection = $this->currentSortOption['direction'] ?? 'desc';
    }

    public function sortBy(string $id): void
    {
        $selectedSortOption = collect($this->availableSortOptions)->firstWhere('value', $id);

        if (! $selectedSortOption) {
            throw new \Exception('Invalid sort value.');
        }

        $this->currentSortField = $selectedSortOption['column'] ?? $selectedSortOption['value'];
        $this->currentSortDirection = $selectedSortOption['direction'];
        $this->currentSortOption = $selectedSortOption;
        $this->resetPage();
    }
}
