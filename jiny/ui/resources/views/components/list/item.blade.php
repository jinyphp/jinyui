{{--
<li {{ $attributes->merge(['class' => 'list-group-item']) }}>
    {{$slot}}
</li>
--}}
{{ xList()->addItem($slot, $attributes->merge(['class' => 'list-group-item'])) }}
