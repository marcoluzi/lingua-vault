@php
    use App\Support\Enums\Statuses;
@endphp

<div>
    <x-modal-card>
        <h2 class="text-lg font-bold mb-4">{{ $word }}</h2>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Translation</label>
            <input type="text" wire:model.defer="meaning" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Romanized (optional)</label>
            <input type="text" wire:model.defer="romanized" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
        </div>
        <div class="mb-4">
            <span class="isolate inline-flex rounded-md shadow-sm">
                <button type="button"
                        class="relative inline-flex items-center rounded-l-md px-3 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 focus:z-10 transition {{ $status === Statuses::WELL_KNOWN ? 'hover:bg-indigo-500 bg-indigo-600 text-white' : 'hover:bg-gray-50 bg-white text-gray-900' }}"
                        wire:click="toggleWellKnown">
                    Well known
                </button>
                <button type="button"
                        class="relative -ml-px inline-flex items-center rounded-r-md px-3 py-2 text-sm font-semibold ring-1 ring-inset ring-gray-300 focus:z-10 transition {{ $status === Statuses::IGNORED ? 'hover:bg-indigo-500 bg-indigo-600 text-white' : 'hover:bg-gray-50 bg-white text-gray-900' }}"
                        wire:click="toggleIgnore">
                    Ignore
                </button>
            </span>
        </div>
        <div class="mt-4 flex justify-end">
            <button type="button"
                    wire:click="saveAndClose"
                    wire:loading.attr="disabled"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                Save & Close
            </button>
        </div>
    </x-modal-card>
</div>

@script
    <script>
        $wire.on('closingModalOnEscape', data => {
            if ($wire.isDirty) {
                data.closing = false;
                $wire.save();
                $wire.closeModal();
            }
        });
        $wire.on('closingModalOnClickAway', data => {
            if ($wire.isDirty) {
                data.closing = false;
                $wire.save();
                $wire.closeModal();
            }
        });
    </script>
@endscript

