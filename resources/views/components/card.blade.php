<div {{ $attributes->merge(['class' => 'border']) }}>

    @if (isset($header))
        {{$header}}
    @endif

    {{$slot}}

    @if (isset($footer))
        {{$footer}}
    @endif
</div>