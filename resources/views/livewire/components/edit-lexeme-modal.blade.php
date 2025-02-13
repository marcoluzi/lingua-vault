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

        <div class="text-sm text-gray-500">
            Auto-saving...
        </div>
    </x-modal-card>
</div>
