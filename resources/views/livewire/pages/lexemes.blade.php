<div>
    <livewire:components.page-header :$pageTitle />

    @if ($lexemes->total() > 0)
        @include('components.ui.header-and-sort')

        <ul role="list" class="divide-y divide-gray-100 mt-8 md:mt-16">
            @foreach ($lexemes as $lexeme)
                <li class="flex items-center justify-between gap-x-6 py-5">
                    <div class="min-w-0">
                        <div class="flex items-start gap-x-3">
                            <p class="text-sm font-semibold leading-6 text-gray-900">{{ $lexeme['text'] }}</p>
                            {{-- TODO: adding colored state of lexeme --}}
                        </div>
                        <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                            <p class="whitespace-nowrap">
                                {{ __('Last practiced:') }}
                                <time datetime="{{ \Carbon\Carbon::parse($lexeme['updated_at'])->format('Y-m-d') }}">
                                    {{ \Carbon\Carbon::parse($lexeme['updated_at'])->format('j F, Y') }}
                                </time>
                            </p>
                            <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
                                <circle cx="1" cy="1" r="1" />
                            </svg>
                            <p class="truncate">
                                {{ __('Meaning: :meaning', ['meaning' => $lexeme['meaning']]) }}
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-none items-center gap-x-4">
                        @include('components.ui.item-options-dropdown', [
                            'menuId' => 'lexeme-menu-' . $loop->iteration,
                            'modalComponent' => 'components.delete-lexeme-modal',
                            'idKey' => 'lexemeId',
                            'itemId' => $lexeme['id'],
                            'itemName' => $lexeme['text'],
                        ])
                    </div>
                </li>
            @endforeach
        </ul>
        {{ $lexemes->links('components.pagination') }}
    @else
        @php
            $emptyTitle = __('No words or expressions');
            $emptyMessage = __('Get started by reading your lessons.');
            $emptyButtonRoute = route('lessons.index');
            $emptyButtonText = __('Go to lessons');
        @endphp
        @include(
            'components.ui.empty-state',
            compact('emptyTitle', 'emptyMessage', 'emptyButtonRoute', 'emptyButtonText'))
    @endif
</div>
