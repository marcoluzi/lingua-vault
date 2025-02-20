<div class="flex justify-center items-center mt-8 md:mt-16">
    <div class="text-center">
        <x-icon-solid.folder-xmark class="mx-auto h-12 w-12" />
        <h3 class="mt-2 text-sm font-semibold text-gray-900">{{ $emptyTitle }}</h3>
        <p class="mt-1 text-sm text-gray-500">{{ $emptyMessage }}</p>
        <div class="mt-6">
            <x-button href="{{ $emptyButtonRoute }}" icon="plus">{{ $emptyButtonText }}</x-button>
        </div>
    </div>
</div>
