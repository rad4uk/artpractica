<div>
    <p>Name: {{ $name }}</p>

    <p>Phone: {{ $phone }}</p>

    @if($text !== null)
        <p>Text: {{ $text }}</p>
    @endif
</div>
