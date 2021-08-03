{{--
<div {{ $attributes->merge(['class' => 'carousel-item']) }}>
    {{$slot}}
</div>
--}}
{{BootCarousel()->addItem($slot, $attributes)}}