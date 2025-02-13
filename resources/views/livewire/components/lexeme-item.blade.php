<div>
    <button class="p-1 rounded bg-{{ $backgroundColor }}-200 border border-{{ $backgroundColor }}-400"
        wire:click="$dispatch('openModal', {
            component: 'components.edit-lexeme-modal',
            arguments: {
                lexemeId: {{ $lexemeId }},
                word: '{{ $word }}',
                lessonLanguage: '{{ $lessonLanguage }}',
                lessonId: {{ $lessonId }}
            }
        })">
        <p class="text-black">{{ $word }}</p>
    </button>
</div>
