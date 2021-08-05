{{--
<div {{ $attributes->merge(['class' => '']) }} role="tablist">
    {{$slot}}

    @foreach (BootTab()->popHeaders() as $item)
        {!! $item !!}
    @endforeach
</div>
--}}
<nav {{ $attributes->merge(['class' => 'nav']) }}>
    {{$slot}}

    @php
        $tab = BootTab();
        $tab->tabStyle("list");
        $tab->setTabAttrs($attributes);
    @endphp

    @foreach (BootTab()->popHeaders() as $item)
        {!! $item !!}
    @endforeach
</nav>