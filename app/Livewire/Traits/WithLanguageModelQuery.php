<?php

namespace App\Livewire\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;

trait WithLanguageModelQuery
{
    abstract protected function getModelClass(): string;

    protected function getPaginatedModels(): LengthAwarePaginator
    {
        $modelClass = $this->getModelClass();

        return $modelClass::where('language', $this->languageService->getCurrentLanguage())
            ->orderBy($this->currentSortField, $this->currentSortDirection)
            ->paginate(10);
    }
}
