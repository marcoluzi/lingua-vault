<div>
    <livewire:components.page-header :$title />
    <form class="mt-8 md:mt-16" wire:submit="save">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3 lg:col-span-2">
                <x-select-menu :items="$languageItems" :selectedItem="$selectedLanguageItem" label="{{ __('Lesson language') }}" />
            </div>
            <div class="col-span-full">
                <label for="lessonTitle" class="block text-sm font-medium leading-6">{{ __('Lesson title') }}</label>
                <div class="mt-2 @error('lessonTitle') relative rounded-md shadow-sm @enderror">
                    <input type="text" name="lessonTitle" id="lessonTitle" wire:model="lessonTitle" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 @error('lessonTitle') text-red-900 ring-red-300 placeholder:text-red-300 focus:ring-red-500 pe-11 @else text-gray-900 ring-gray-300 placeholder:text-gray-400 focus:ring-indigo-600 @enderror">
                    {{-- TODO: Create Component to prevent duplicate code --}}
                    @error('lessonTitle')
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    @enderror
                </div>
                @error('lessonTitle') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
            <div class="col-span-full">
                <label for="lessonText" class="lock text-sm font-medium leading-6">{{ __('Text') }}</label>
                <div class="mt-2 @error('lessonText') relative rounded-md shadow-sm @enderror">
                    <textarea rows="8" name="lessonText" id="lessonText" wire:model="lessonText" class="block w-full rounded-md border-0 py-1.5 shadow-sm ring-1 ring-inset focus:ring-2 focus:ring-inset sm:text-sm sm:leading-6 @error('lessonText') text-red-900 ring-red-300 placeholder:text-red-300 focus:ring-red-500 pe-11 @else text-gray-900 ring-gray-300 placeholder:text-gray-400 focus:ring-indigo-600 @enderror"></textarea>
                    @error('lessonText')
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    @enderror
                </div>
                @error('lessonText') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>
        <x-button type="submit" class="mt-8 w-full sm:w-auto">{{ __('Create lesson') }}</x-button>
    </form>
</div>
