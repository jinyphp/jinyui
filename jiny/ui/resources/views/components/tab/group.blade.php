<nav {{ $attributes->merge(['class' => 'nav']) }}>
    {{$slot}}

    @php
        $tab = xTab();
        $tab->tabStyle("group");
        $tab->setTabAttrs($attributes);
    @endphp

    @foreach (xTab()->popHeaders() as $item)
        {!! $item !!}
    @endforeach
</nav>