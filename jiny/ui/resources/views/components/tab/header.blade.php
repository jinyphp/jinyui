<nav {{ $attributes->merge(['class' => 'nav']) }}>
    {{$slot}}

    @php
        $tab = xTab()->setTabAttrs($attributes);
    @endphp

    @foreach (xTab()->popHeaders() as $item)
        {!! $item !!}
    @endforeach
</nav>