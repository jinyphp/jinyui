{{-- Bootstrap Code --}}
{{--
<button {{ $attributes->merge(['class' => 'btn btn-primary']) }} type="button" data-bs-toggle="collapse" 
    data-bs-target="#{{xCollapse()->collapseId()}}" role="button" aria-expanded="false">
    {{$slot}}
</button>
--}}

{!! xButton($slot)
    ->setAttrs($attributes)
    ->setAttribute("data-bs-toggle", "collapse")
    ->setAttribute("data-bs-target", "#". xCollapse()->collapseId() )
    ->setAttribute("role", "button")
    ->setAttribute("aria-expanded", "false")
!!}