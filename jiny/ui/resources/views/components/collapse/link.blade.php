{{-- Bootstrap Code --}}
<div>
    @php
        $collapse = uniqid("collpase_");
    @endphp
    
    <a {{ $attributes->merge(['class' => '']) }} data-bs-toggle="collapse" href="#{{$collapse}}" role="button" aria-expanded="false" aria-controls="{{$collapse}}">
        {{$title}}
    </a>

    <div class="collapse" id="{{$collapse}}">
        {{$slot}}
    </div>
</div>