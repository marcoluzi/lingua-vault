<div x-data="{ open: false }" class="relative flex-none">
    <button type="button" class="-m-2.5 block p-2.5 text-gray-500 hover:text-gray-900" id="{{ $menuId }}-button"
        :aria-expanded="open.toString()" aria-haspopup="true" @click="open = !open">
        <span class="sr-only">{{ __('Open options') }}</span>
        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
            <path
                d="M10 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM10 8.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM11.5 15.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
        </svg>
    </button>
    <div class="absolute right-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
        role="menu" aria-orientation="vertical" aria-labelledby="{{ $menuId }}-button" tabindex="-1"
        x-show="open" x-transition:enter="transition ease-out duration-10"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95" @click.away="open = false">
        <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50" role="menuitem"
            tabindex="-1">
            {{ __('Edit') }}
            <span class="sr-only">{{ $itemName }}</span>
        </a>
        <button class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50 w-full text-left"
            role="menuitem" tabindex="-1"
            wire:click="$dispatch('openModal', { component: '{{ $modalComponent }}', arguments: { '{{ $idKey }}': {{ $itemId }} }})">
            {{ __('Delete') }}
            {{-- </button> --}}
    </div>
</div>
