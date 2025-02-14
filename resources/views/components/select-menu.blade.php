<div x-data="{ open: false }">
    @if (isset($label))
        <label class="block text-sm font-medium leading-6" :class="{ 'text-white': '{{ isset($lightLabel) }}' }">
            {{ $label }}
        </label>
    @endif
    <div class="relative mt-2">
        <button type="button" class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-xs ring-1 ring-inset ring-gray-300 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6" x-ref="button" @click="open = !open" aria-haspopup="listbox" :aria-expanded="open.toString()">
            <span class="flex items-center">
                @if (isset($selectedItem['image']))
                    <img src="{{ $selectedItem['image'] }}" alt="{{ $selectedItem['alt'] }}" class="h-5 w-5 shrink-0 rounded-full">
                @endif
                <span class="block truncate" :class="{ 'ml-3': '{{ isset($selectedItem['image']) }}' }">{{ $selectedItem['label'] }}</span>
            </span>
            <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                </svg>
            </span>
        </button>
        <ul class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-hidden sm:text-sm" x-show="open" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click.away="open = false" tabindex="-1" role="listbox">
            @foreach ($items as $item)
                <li class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9 hover:bg-indigo-600 hover:text-white transition" :class="{ 'bg-indigo-600 text-white': '{{ $selectedItem['value'] }}' === '{{ $item['value'] }}', 'text-gray-900': '{{ $selectedItem['value'] }}' !== '{{ $item['value'] }}' }" role="option"
                    @click="
                        open = false;
                        {{ $item['action'] }}
                    ">
                    <div class="flex items-center">
                        @if (isset($item['image']))
                            <img src="{{ $item['image'] }}" alt="{{ $item['alt'] }}" class="h-5 w-5 shrink-0 rounded-full" />
                        @endif
                        <span class="font-normal block truncate" :class="{ 'font-semibold': '{{ $selectedItem['value'] }}' === '{{ $item['value'] }}', 'ml-3': '{{ isset($item['image']) }}' }">
                            {{ $item['label'] }}
                        </span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
