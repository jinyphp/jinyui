{{-- Bootstrap Code --}}
<li class="sidebar-item">
    @php
        $collapse = uniqid("collpase_");
    @endphp
    
    <a {{ $attributes->merge(['class' => 'sidebar-link collapsed']) }} data-bs-toggle="collapse" href="#{{$collapse}}" role="button" aria-expanded="false" aria-controls="{{$collapse}}">
        {{$title}}
    </a>

    <ul id="{{$collapse}}" class="sidebar-dropdown list-unstyled collapse">
        {{$slot}}
    </ul>
</li>

