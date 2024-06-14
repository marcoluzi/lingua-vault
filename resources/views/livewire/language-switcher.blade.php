<div x-data="{
    open: false,
    activeDescendant: '{{ 'listbox-option-' . $selectedLanguageCode }}',
    activeIndex: 0,
    onButtonClick() {
        this.open = !this.open;
    },
    onOptionSelect() {
        this.open = false;
    },
    onEscape() {
        this.open = false;
        this.$refs.button.focus();
    },
    choose(code) {
        $wire.chooseLanguage(code);
        this.open = false;
        this.$refs.button.focus();
    },
    onMouseEnter(event) {
        this.activeDescendant = event.target.id;
    },
    onMouseMove(event, code) {
        this.activeDescendant = event.target.id;
    },
    onMouseLeave() {
        this.activeDescendant = '';
    },
}">
    <label id="listbox-label" class="block text-sm font-medium leading-6 text-white" @click="$refs.button.focus()">{{ __('Language') }}</label>
    <div class="relative mt-2">
        <button type="button" class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6" x-ref="button" @keydown.arrow-up.stop.prevent="onButtonClick()" @keydown.arrow-down.stop.prevent="onButtonClick()" @click="onButtonClick()" aria-haspopup="listbox" :aria-expanded="open" aria-labelledby="listbox-label">
            <span class="flex items-center">
                {{-- TODO: make image variable based on active language --}}
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-5 w-5 flex-shrink-0 rounded-full">
                <span class="ml-3 block truncate">{{ $selectedLanguageName ?? __('Select language') }}</span>
            </span>
            <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z" clip-rule="evenodd" />
                </svg>
            </span>
        </button>
        <ul x-show="open" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm" @click.away="open = false" @keydown.enter.stop.prevent="onOptionSelect()" @keydown.space.stop.prevent="onOptionSelect()" @keydown.escape="onEscape()" @keydown.arrow-up.prevent="onArrowUp()" @keydown.arrow-down.prevent="onArrowDown()" x-ref="listbox" tabindex="-1" role="listbox" aria-labelledby="listbox-label" :aria-activedescendant="activeDescendant">
            @foreach ($languages as $language)
                {{-- TODO: Hover State  --}}
                <li class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9" id="listbox-option-{{ $language->code }}" role="option" @click="choose('{{ $language->code }}')" @mouseenter="onMouseEnter($event)" @mousemove="onMouseMove($event, '{{ $language->code }}')" @mouseleave="onMouseLeave($event)" :class="{'bg-indigo-600 text-white': activeIndex === {{ $loop->index }},'text-gray-900': !(!(activeIndex === {{ $loop->index }}))}">
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1491528323818-fdd1faba62cc?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" class="h-5 w-5 flex-shrink-0 rounded-full">
                        <!-- Selected: "font-semibold", Not Selected: "font-normal" -->
                        <span class="font-normal ml-3 block truncate" :class="{'font-semibold': activeIndex === {{ $loop->index }}, 'font-normal': !( activeIndex === {{ $loop->index }})}">{{ $language->name }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>
