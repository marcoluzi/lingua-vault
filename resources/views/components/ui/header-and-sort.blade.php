<div class="flex md:items-center justify-between flex-col-reverse md:flex-row gap-4 mt-8 md:mt-16">
    <div class="md:max-w-xs w-full">
        <x-select-menu class="max-w-48" :items="$availableSortOptions" :selectedItem="$currentSortOption" label="{{ __('Sort by') }}" />
    </div>

    @if (isset($actionButtonRoute) && isset($actionButtonText))
        <x-button href="{{ $actionButtonRoute }}" icon="{{ $actionButtonIcon }}">
            {{ $actionButtonText }}
        </x-button>
    @endif
</div>
