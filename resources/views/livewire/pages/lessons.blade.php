<div>
    <livewire:components.page-header :$pageTitle />

    @if ($lessons->total() > 0)
        @include('components.ui.header-and-sort', [
            'actionButtonRoute' => route('lessons.create'),
            'actionButtonText' => __('Create new lesson'),
            'actionButtonIcon' => 'plus',
        ])

        <ul role="list" class="divide-y divide-gray-100 mt-8 md:mt-16">
            @foreach ($lessons as $lesson)
                <li class="flex items-center justify-between gap-x-6 py-5">
                    <div class="min-w-0">
                        <div class="flex items-start gap-x-3">
                            <p class="text-sm font-semibold leading-6 text-gray-900">{{ $lesson['title'] }}</p>
                            @if ($lesson['progress'] === 0)
                                <p
                                    class="mt-0.5 whitespace-nowrap rounded-md bg-green-50 px-1.5 py-0.5 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20">
                                    {{ __('Not started') }}
                                </p>
                            @elseif ($lesson['progress'] === 100)
                                <p
                                    class="mt-0.5 whitespace-nowrap rounded-md bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                                    {{ __('Complete') }}
                                </p>
                            @else
                                <p
                                    class="mt-0.5 whitespace-nowrap rounded-md bg-yellow-50 px-1.5 py-0.5 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">
                                    {{ __(':percent% completed', ['percent' => $lesson['progress']]) }}
                                </p>
                            @endif
                        </div>
                        <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
                            <p class="whitespace-nowrap">
                                {{ __('Last practiced:') }}
                                <time datetime="{{ \Carbon\Carbon::parse($lesson['updated_at'])->format('Y-m-d') }}">
                                    {{ \Carbon\Carbon::parse($lesson['updated_at'])->format('j F, Y') }}
                                </time>
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
                        <x-button href="{{ route('lessons.read', ['lessonId' => $lesson['id']]) }}" size="sm"
                            outline="true">
                            {{ __('Open lesson') }}
                        </x-button>
                        @include('components.ui.item-options-dropdown', [
                            'menuId' => 'lesson-menu-' . $loop->iteration,
                            'modalComponent' => 'components.delete-lesson-modal',
                            'idKey' => 'lessonId',
                            'itemId' => $lesson['id'],
                            'itemName' => $lesson['title'],
                        ])
                    </div>
                </li>
            @endforeach
        </ul>
        {{ $lessons->links('components.pagination') }}
    @else
        @php
            $emptyTitle = __('No lessons');
            $emptyMessage = __('Get started by creating a new lesson.');
            $emptyButtonRoute = route('lessons.create');
            $emptyButtonText = __('Create new lesson');
        @endphp
        @include(
            'components.ui.empty-state',
            compact('emptyTitle', 'emptyMessage', 'emptyButtonRoute', 'emptyButtonText'))
    @endif
</div>
