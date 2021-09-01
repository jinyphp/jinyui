@php
    $id = uniqid($title."_");
@endphp

<x-sidebar-link 
    {{$attributes->merge(['class' => 'collapsed'])}}
    data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="{{$id}}" 
    href="#{{$id}}">{{$title}}
</x-sidebar-link>

<ul class="sidebar-dropdown list-unstyled collapse" id="{{$id}}">
    {{$slot}}
</ul>