<div>
    <x-modal-card>
        <h2 class="text-lg font-bold mb-4">{{ $word }}</h2>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Translation</label>
            <input type="text" wire:model.live.1000ms="meaning" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Romanized (optional)</label>
            <input type="text" wire:model.live.1000ms="romanized" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        
        <div class="mb-4">
            <span class="isolate inline-flex rounded-md shadow-sm">
                <button type="button" class="relative inline-flex items-center rounded-l-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Well known</button>
                <button type="button" class="relative -ml-px inline-flex items-center bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-10">Ignore</button>
            </span>
        </div>
            
        <div class="text-sm text-gray-500">
            Saving...
        </div>
    </x-modal-card>
</div>
