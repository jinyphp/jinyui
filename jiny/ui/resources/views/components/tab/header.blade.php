<nav {{ $attributes->merge(['class' => 'nav']) }}>
    {{$slot}}

    @php
        $tab = BootTab()->setTabAttrs($attributes);
    @endphp

    @foreach (BootTab()->popHeaders() as $item)
        {!! $item !!}
    @endforeach
</nav>