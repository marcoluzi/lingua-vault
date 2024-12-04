<div>
    <p>
        <strong>Word:</strong> {{ $word }}
    </p>

    @if ($lexemeExists)
        <p>
            <strong>Meaning:</strong> {{ $lexeme->meaning }} <br>
            <strong>Language:</strong> {{ $lexeme->language }} <br>
            <strong>E-Factor:</strong> {{ $lexeme->e_factor }}
        </p>
    @else
        <p>No lexeme found for this word.</p>
        <button wire:click="addLexeme">Add Lexeme</button>
    @endif
</div>
