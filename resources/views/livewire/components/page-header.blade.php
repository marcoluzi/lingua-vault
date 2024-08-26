<div>
    <div>
        <x-breadcrumbs />
    </div>
    <div class="mt-2 md:flex md:items-center md:justify-between">
        <div class="min-w-0 flex-1">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                {{ $title }}
            </h2>
        </div>
        <div class="mt-4 flex flex-shrink-0 md:ml-4 md:mt-0">
            {{-- TODO: Create Lesson --}}
            <button type="button" class="ml-3 inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">{{ __('Create new lesson') }}</button>
        </div>
    </div>
</div>
