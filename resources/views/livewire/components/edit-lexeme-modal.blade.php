<div>
    <x-modal-card>
        <h2 class="text-2xl font-extrabold mb-4">{{ $text }}</h2>
        <div class="mb-4">
            <label for="meaning" class="text-sm font-medium">{{ __('Meaning:') }}</label>
            <div class="mt-2">
                <input type="text" name="meaning" id="meaning" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" value="{{ $meaning }}"">
            </div>
        </div>
        <div>
            <label for="pronunciation" class="text-sm font-medium">{{ __('Pronunciation:') }}</label>
            <div class="mt-2">
                <input type="text" name="pronunciation" id="pronunciation" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" value="{{ $pronunciation }}"">
            </div>
        </div>
    </x-modal-card>
</div>
