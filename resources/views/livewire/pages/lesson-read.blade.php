<div>
    <livewire:components.page-header :$title />

    @foreach (explode(' ', $lesson->text) as $word)
        <livewire:components.lexeme-item :word="$word" :key="$word" />
    @endforeach
</div>
