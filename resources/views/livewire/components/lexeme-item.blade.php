<div>
    <button class="p-1 rounded {{ $backgroundColor }}"
        wire:click="$dispatch('openModal', {
            component: 'components.edit-lexeme-modal',
            arguments: {
                lexemeId: {{ $lexemeId ? $lexemeId : 'null' }},
                word: '{{ $word }}',
                lessonLanguage: '{{ $lessonLanguage }}',
                lessonId: {{ $lessonId }}
            }
        })">
        <p class="text-black">{{ $word }}</p>
    </button>
</div>
