{{-- Bootstrap Code --}}
<a {{ $attributes }} data-bs-toggle="collapse" href="#{{xCollapse()->collapseId()}}" role="button" aria-expanded="false">
    {{$slot}}
</a>

