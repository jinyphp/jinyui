<button type="button" {{ $attributes->merge(['class' => 'btn']) }} data-bs-toggle="modal" >
    {{$slot}}
</button>