{{--
<div {{ $attributes->merge(['class' => 'card-footer']) }}>
    {{$slot}}
</div>
--}}
{{ BCard()->setFooter($slot, $attributes) }}
