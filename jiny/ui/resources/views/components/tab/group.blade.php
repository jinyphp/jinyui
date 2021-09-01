<nav {{ $attributes->merge(['class' => 'nav']) }}>
    {{$slot}}

    @php
        $tab = BootTab();
        $tab->tabStyle("group");
        $tab->setTabAttrs($attributes);
    @endphp

    @foreach (BootTab()->popHeaders() as $item)
        {!! $item !!}
    @endforeach
</nav>