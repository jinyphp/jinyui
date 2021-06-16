<div {{ $attributes->merge(['class' => '']) }} style="margin: 0 0 10px;
    background-color: #ffffff;
    border: 1px solid #dfe4e7;
    padding: 10px;
    text-align: left;">

    @if (isset($header))
        {{$header}}
    @endif

    {{$slot}}

    @if (isset($footer))
        {{$footer}}
    @endif
</div>