@props(['messages'])

@if ($messages)
    @foreach ((array) $messages as $message)
        <div class="invalid-feedback mt-2">{{ $message }}</div>
    @endforeach
@endif
