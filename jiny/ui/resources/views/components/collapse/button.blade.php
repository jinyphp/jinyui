{{-- Bootstrap Code --}}
<button {{ $attributes->merge(['class' => 'btn btn-primary']) }} type="button" data-bs-toggle="collapse" 
    data-bs-target="#{{uistack()->collapseId()}}" role="button" aria-expanded="false">
    {{$slot}}
</button>