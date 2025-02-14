<div>
    <livewire:components.page-header :$title />
    <div class="mx-auto max-w-3xl mt-10 lg:mt-20 flex flex-wrap gap-1">
        @php
            // Use regex splitting to handle punctuation and multiple spaces
            $words = preg_split('/[\s,.;:?!]+/u', $text, -1, PREG_SPLIT_NO_EMPTY);
        @endphp

        {{-- TODO: Punctuation should stay in but not be counted as a word --}}

        @foreach ($words as $word)
            <livewire:components.lexeme-item
                :$word
                :$lessonLanguage
                :$lessonId
                key="{{ $loop->index }}"
            />
        @endforeach
    </div>
</div>
