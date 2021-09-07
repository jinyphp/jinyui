{{--
<li {{ $attributes->merge(['class' => 'nav-item']) }}>
    {{$slot}}
</li>
--}}

{!! xNav()->addItem($slot) !!}