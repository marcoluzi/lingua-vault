<div>
    <livewire:components.page-header :$title />

    <div class="mx-auto max-w-3xl mt-10 lg:mt-20 flex flex-wrap gap-1">
        @foreach (explode(' ', $this->text) as $word)
            <livewire:components.lexeme-item :$word :$lessonLanguage />
        @endforeach
    </div>
</div>
