{{-- Bootstrap Code --}}
<div>
    @php
        $collapse = uniqid("collpase_");
    @endphp

    <button {{ $attributes->merge(['class' => '']) }} type="button" data-bs-toggle="collapse" data-bs-target="#{{$collapse}}" role="button" aria-expanded="false" aria-controls="{{$collapse}}">
        {{$title}}
    </button>

    <div class="collapse" id="{{$collapse}}">
        {{$slot}}
    </div>
</div>