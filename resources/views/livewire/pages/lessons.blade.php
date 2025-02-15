<div>
    <livewire:components.page-header :$title />
    @if ($lessons->total() > 0)
        <div class="md:max-w-xs mt-8 md:mt-16">
            <x-select-menu class="max-w-48" :items="$sortItems" :selectedItem="$selectedSortItem" label="{{ __('Sort by') }}" />
        </div>
        <ul role="list" class="divide-y divide-gray-100 mt-8 md:mt-16">
            @foreach ($lessons as $lesson)
                <li class="flex items-center justify-between gap-x-6 py-5">
                    <div class="min-w-0">
                        <div class="flex items-start gap-x-3">
                            <p class="text-sm font-semibold leading-6 text-gray-900">{{ $lesson['title'] }}</p>
                            @if ($lesson['progress'] === 0)
                                <p class="mt-0.5 whitespace-nowrap rounded-md bg-green-50 px-1.5 py-0.5 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">
                                    {{ __('Not started') }}
                                </p>
                            @elseif ($lesson['progress'] === 100)
                                <p class="mt-0.5 whitespace-nowrap rounded-md bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                    {{ __('Complete') }}
                                </p>
                            @else
                                <p class="mt-0.5 whitespace-nowrap rounded-md bg-yellow-50 px-1.5 py-0.5 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">
                                    {{ __(':percent% completed', ['percent' => $lesson['progress']]) }}
                                </p>
                            @endif
                        </div>
                        <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                            <p class="whitespace-nowrap">{{ __('Last practiced:') }}
                                <time datetime="{{ \Carbon\Carbon::parse($lesson['updated_at'])->format('Y-m-d') }}">{{ \Carbon\Carbon::parse($lesson['updated_at'])->format('j F, Y') }}</time>
                            </p>
                            <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
                                <circle cx="1" cy="1" r="1" />
                            </svg>
                            <p class="truncate">
                                {{ __('Total words: :word_count', ['word_count' => $lesson['word_count']]) }}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-none items-center gap-x-4">
                        <a href="{{ route('lessons.read', ['lessonId' => $lesson['id']]) }}" class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:block">
                            {{ __('Open lesson') }}
                        </a>
                        <div x-data="{ open: false }" class="relative flex-none">
                            <button
                                type="button"
                                class="-m-2.5 block p-2.5 text-gray-500 hover:text-gray-900"
                                id="lesson-menu-{{ $loop->iteration }}-button"
                                :aria-expanded="open.toString()"
                                aria-haspopup="true"
                                @click="open = !open"
                            >
                                <span class="sr-only">{{ __('Open options') }}</span>
                                <svg
                                    class="h-5 w-5"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                    aria-hidden="true"
                                    data-slot="icon"
                                >
                                    <path d="M10 3a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM10 8.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM11.5 15.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                                </svg>
                            </button>
                            <div class="absolute right-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                                role="menu"
                                aria-orientation="vertical"
                                aria-labelledby="lesson-menu-{{ $loop->iteration }}-button"
                                tabindex="-1"
                                x-show="open"
                                x-transition:enter="transition ease-out duration-10"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                @click.away="open = false"
                            >
                                {{-- TODO: Edit --}}
                                <a
                                    href="#"
                                    class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50"
                                    role="menuitem"
                                    tabindex="-1"
                                >
                                    {{ __('Edit') }}
                                    <span class="sr-only">{{ $lesson['title'] }}</span>
                                </a>
                                <button
                                    class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50 w-full text-left"
                                    role="menuitem"
                                    tabindex="-1"
                                    wire:click="$dispatch('openModal', { component: 'components.delete-lesson-modal', arguments: { lessonId: {{ $lesson['id'] }} }})"
                                >
                                    {{ __('Delete') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        {{ $lessons->links('components.pagination') }}
    @else
        <div class="flex justify-center items-center mt-8 md:mt-16">
            <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    aria-hidden="true">
                    <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                </svg>
                <h3 class="mt-2 text-sm font-semibold text-gray-900">{{ __('No lessons') }}</h3>
                <p class="mt-1 text-sm text-gray-500">{{ __('Get started by creating a new lesson.') }}</p>
                <div class="mt-6">
                    {{-- TODO: create --}}
                    <button type="button"
                        class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        <svg class="-ml-0.5 mr-1.5 h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path
                                d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                        </svg>
                        {{ __('New lesson') }}
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
