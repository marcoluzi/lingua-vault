<div>
    <livewire:components.page-header :$title />
    <ul role="list" class="divide-y divide-gray-100 mt-8 md:mt-16">
        <li class="flex items-center justify-between gap-x-6 py-5">
            <div class="min-w-0">
                <div class="flex items-start gap-x-3">
                    <p class="text-sm font-semibold leading-6 text-gray-900">GraphQL API</p>
                    <p
                        class="mt-0.5 whitespace-nowrap rounded-md bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                        10% complete</p>
                </div>
                <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                    <p class="whitespace-nowrap">Last learned <time datetime="2023-03-17T00:00Z">March 17, 2023</time></p>
                    <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
                        <circle cx="1" cy="1" r="1" />
                    </svg>
                    <p class="truncate">Total Words: 345</p>
                </div>
            </div>
            <div class="flex flex-none items-center gap-x-4">
                <a href="#"
                    class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:block">Learn
                    now</a>
                <div x-data="{ open: false }" class="relative flex-none">
                    <button type="button" class="-m-2.5 block p-2.5 text-gray-500 hover:text-gray-900"
                        id="options-menu-0-button" :aria-expanded="open.toString()" aria-haspopup="true"
                        @click="open = !open">
                        <span class="sr-only">Open options</span>
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                            data-slot="icon">
                            <path
                                d="M10 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM10 8.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM11.5 15.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                        </svg>
                    </button>
                    <div class="absolute right-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                        role="menu" aria-orientation="vertical" aria-labelledby="options-menu-0-button"
                        tabindex="-1" x-show="open" x-transition:enter="transition ease-out duration-10"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95" @click.away="open = false">
                        <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50"
                            role="menuitem" tabindex="-1" id="options-menu-0-item-0">Edit<span class="sr-only">,
                                GraphQL
                                API</span></a>
                        <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50"
                            role="menuitem" tabindex="-1" id="options-menu-0-item-1">Move<span class="sr-only">,
                                GraphQL
                                API</span></a>
                        <a href="#" class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50"
                            role="menuitem" tabindex="-1" id="options-menu-0-item-2">Delete<span class="sr-only">,
                                GraphQL
                                API</span></a>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>
