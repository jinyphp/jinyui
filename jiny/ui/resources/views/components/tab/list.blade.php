{{--
<div {{ $attributes->merge(['class' => '']) }} role="tablist">
    {{$slot}}

    @foreach (xTab()->popHeaders() as $item)
        {!! $item !!}
    @endforeach
</div>
--}}
<nav {{ $attributes->merge(['class' => 'nav']) }}>
    {{$slot}}

    @php
        $tab = xTab();
        $tab->tabStyle("list");
        $tab->setTabAttrs($attributes);
    @endphp

    @foreach (xTab()->popHeaders() as $item)
        {!! $item !!}
    @endforeach
</nav>