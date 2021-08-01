{{-- Bootstrap Code --}}
<a {{ $attributes }} data-bs-toggle="collapse" href="#{{uistack()->collapseId()}}" role="button" aria-expanded="false">
    {{$slot}}
</a>

