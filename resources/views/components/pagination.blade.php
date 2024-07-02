<div>
    @if ($paginator->hasPages())
        <nav class="flex items-center justify-between border-t border-gray-100 px-4 sm:px-0">
            <div class="-mt-px flex w-0 flex-1">
                @if (!$paginator->onFirstPage())
                    <button
                        class="inline-flex items-center border-t-2 border-transparent pr-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"
                        wire:click="previousPage" wire:loading.attr="disabled" rel="prev">
                        <svg class="mr-3 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M18 10a.75.75 0 01-.75.75H4.66l2.1 1.95a.75.75 0 11-1.02 1.1l-3.5-3.25a.75.75 0 010-1.1l3.5-3.25a.75.75 0 111.02 1.1l-2.1 1.95h12.59A.75.75 0 0118 10z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ __('Previous') }}
                    </button>
                @endif
            </div>
            <div class="hidden md:-mt-px md:flex">
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span
                            class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500">{{ $element }}</span>
                    @endif
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            <span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
                                @if ($page == $paginator->currentPage())
                                    <span
                                        class="inline-flex items-center border-t-2 border-indigo-500 px-4 pt-4 text-sm font-medium text-indigo-600"
                                        aria-current="page">{{ $page }}</span>
                                @else
                                    <button type="button"
                                        wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                        aria-label="{{ __('Go to page :page', ['page' => $page]) }}"
                                        class="inline-flex items-center border-t-2 border-transparent px-4 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700">{{ $page }}</button>
                                @endif
                            </span>
                        @endforeach
                    @endif
                @endforeach
            </div>
            <div class="-mt-px flex w-0 flex-1 justify-end">
                @if (!$paginator->onLastPage())
                    <button
                        class="inline-flex items-center border-t-2 border-transparent pl-1 pt-4 text-sm font-medium text-gray-500 hover:border-gray-300 hover:text-gray-700"
                        wire:click="nextPage" wire:loading.attr="disabled" rel="next">
                        {{ __('Next') }}
                        <svg class="ml-3 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                            aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif
            </div>
        </nav>
    @endif
</div>
