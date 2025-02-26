<div>
    <livewire:components.page-header :$pageTitle />
    <div class="mx-auto max-w-3xl mt-10 lg:mt-20 flex flex-wrap items-center gap-y-3">
        @foreach ($tokens as $token)
            @if ($token['type'] === 'word')
                <livewire:components.lexeme-item 
                    :word="$token['content']" 
                    :$language 
                    :$lessonId 
                    key="{{ $loop->index }}" 
                    class="mx-0.5"
                />
            @elseif ($token['type'] === 'space')
                <span class="w-1"></span>
            @elseif ($token['type'] === 'paragraph-break')
                </div><div class="w-full h-8"></div><div class="mx-auto max-w-3xl flex flex-wrap items-center gap-y-3">
            @else
                <span class="mx-0.5">{{ $token['content'] }}</span>
            @endif
        @endforeach
    </div>
</div>
