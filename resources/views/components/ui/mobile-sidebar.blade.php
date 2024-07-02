<div x-show="isOpen" class="relative z-50 lg:hidden" role="dialog" aria-modal="true">
    <div x-show="isOpen" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/80">
    </div>
    <div class="fixed inset-0 flex">
        <div x-show="isOpen" x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full" @click.away="isOpen = false"
            class="relative mr-16 flex w-full max-w-xs flex-1">
            <div x-show="isOpen" x-transition:enter="ease-in-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in-out duration-300"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="absolute left-full top-0 flex w-16 justify-center pt-5">
                <button @click="isOpen = false" type="button" class="-m-2.5 p-2.5">
                    <span class="sr-only">{{ __('Close sidebar') }}</span>
                    <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-900 px-6 pb-2 ring-1 ring-white/10">
                <div class="flex h-16 shrink-0 items-center">
                    <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500"
                        alt="Your Company">
                </div>
                @livewire('components.language-switcher')
                <nav class="flex flex-1 flex-col">
                    <ul role="list" class="flex flex-1 flex-col gap-y-7">
                        <li>
                            <ul role="list" class="-mx-2 space-y-1">
                                <li>
                                    <a href="{{ route('lessons.index') }}" class="bg-gray-800 text-white group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg class="h-6 w-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="currentColor" aria-hidden="true"><path d="M192 96a48 48 0 1 0 0-96 48 48 0 1 0 0 96zm-8 384V352h16V480c0 17.7 14.3 32 32 32s32-14.3 32-32V192h56 64 16c17.7 0 32-14.3 32-32s-14.3-32-32-32H384V64H576V256H384V224H320v48c0 26.5 21.5 48 48 48H592c26.5 0 48-21.5 48-48V48c0-26.5-21.5-48-48-48H368c-26.5 0-48 21.5-48 48v80H243.1 177.1c-33.7 0-64.9 17.7-82.3 46.6l-58.3 97c-9.1 15.1-4.2 34.8 10.9 43.9s34.8 4.2 43.9-10.9L120 256.9V480c0 17.7 14.3 32 32 32s32-14.3 32-32z" /></svg>
                                        {{ __('Lessons') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-gray-400 hover:text-white hover:bg-gray-800 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
                                        <svg class="h-6 w-6 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="currentColor" aria-hidden="true"><path d="M256 448c141.4 0 256-93.1 256-208S397.4 32 256 32S0 125.1 0 240c0 45.1 17.7 86.8 47.7 120.9c-1.9 24.5-11.4 46.3-21.4 62.9c-5.5 9.2-11.1 16.6-15.2 21.6c-2.1 2.5-3.7 4.4-4.9 5.7c-.6 .6-1 1.1-1.3 1.4l-.3 .3 0 0 0 0 0 0 0 0c-4.6 4.6-5.9 11.4-3.4 17.4c2.5 6 8.3 9.9 14.8 9.9c28.7 0 57.6-8.9 81.6-19.3c22.9-10 42.4-21.9 54.3-30.6c31.8 11.5 67 17.9 104.1 17.9zM160 144h48c17.7 0 32 14.3 32 32v24 24 39.3c0 35.2-25.4 65.2-60.2 71l-7.9 1.3c-13.1 2.2-25.4-6.7-27.6-19.7s6.7-25.4 19.7-27.6l7.9-1.3c11.6-1.9 20.1-11.9 20.1-23.7V256H160c-17.7 0-32-14.3-32-32V176c0-17.7 14.3-32 32-32zm224 80v39.3c0 35.2-25.4 65.2-60.2 71l-7.9 1.3c-13.1 2.2-25.4-6.7-27.6-19.7s6.7-25.4 19.7-27.6l7.9-1.3c11.6-1.9 20.1-11.9 20.1-23.7V256H304c-17.7 0-32-14.3-32-32V176c0-17.7 14.3-32 32-32h48c17.7 0 32 14.3 32 32v24 24z"/></svg>
                                        {{ __('Words and Expressions') }}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
