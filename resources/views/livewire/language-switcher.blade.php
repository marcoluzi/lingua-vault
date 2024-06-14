<div x-data="languageSwitcher()" x-init="init()">
    <label id="listbox-label" class="block text-sm font-medium leading-6 text-white"
        @click="$refs.button.focus()">{{ __('Language') }}</label>
    <div class="relative mt-2">
        <button type="button"
            class="relative w-full cursor-default rounded-md bg-white py-1.5 pl-3 pr-10 text-left text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 sm:text-sm sm:leading-6"
            x-ref="button" @click="toggleDropdown" aria-haspopup="listbox" :aria-expanded="open.toString()"
            aria-labelledby="listbox-label">
            <span class="flex items-center">
                <img src="https://via.placeholder.com/20" alt="" class="h-5 w-5 flex-shrink-0 rounded-full">
                <span class="ml-3 block truncate" x-text="selectedLanguageName">{{ $selectedLanguageName }}</span>
            </span>
            <span class="pointer-events-none absolute inset-y-0 right-0 ml-3 flex items-center pr-2">
                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </button>
        <ul x-show="open" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
            @click.away="closeDropdown" x-ref="listbox" tabindex="-1" role="listbox" aria-labelledby="listbox-label">
            @foreach ($languages as $language)
                <li class="text-gray-900 relative cursor-default select-none py-2 pl-3 pr-9"
                    id="listbox-option-{{ $language->code }}" role="option"
                    @click="selectLanguage('{{ $language->code }}', '{{ $language->name }}')"
                    @mouseenter="setActiveDescendant('listbox-option-{{ $language->code }}')"
                    @mousemove="setActiveDescendant('listbox-option-{{ $language->code }}')"
                    :class="{ 'bg-indigo-600 text-white': activeLanguage === '{{ $language->code }}', 'text-gray-900': activeLanguage !== '{{ $language->code }}' }">
                    <div class="flex items-center">
                        <img src="https://via.placeholder.com/20" alt=""
                            class="h-5 w-5 flex-shrink-0 rounded-full">
                        <span class="font-normal ml-3 block truncate"
                            :class="{ 'font-semibold': activeLanguage === '{{ $language->code }}' }">{{ $language->name }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<script>
    function languageSwitcher() {
        return {
            open: false,
            activeDescendant: 'listbox-option-{{ $selectedLanguageCode }}',
            activeLanguage: '{{ $selectedLanguageCode }}',
            selectedLanguageName: '{{ $selectedLanguageName }}',
            init() {
                window.addEventListener('languageChanged', (event) => {
                    const languageCode = event.detail;
                    this.activeLanguage = languageCode;
                    this.selectedLanguageName = this.getLanguageNameByCode(languageCode);
                });
            },
            toggleDropdown() {
                this.open = !this.open;
            },
            closeDropdown() {
                this.open = false;
                this.$refs.button.focus();
            },
            selectLanguage(code, name) {
                this.activeLanguage = code;
                this.selectedLanguageName = name;
                this.closeDropdown();
            },
            setActiveDescendant(id) {
                this.activeDescendant = id;
            },
            getLanguageNameByCode(code) {
                const language = @json($languages).find(lang => lang.code === code);
                return language ? language.name : '{{ __('Select language') }}';
            }
        }
    }
</script>
