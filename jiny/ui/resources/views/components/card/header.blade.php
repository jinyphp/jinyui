{{--
<div {{ $attributes->merge(['class' => 'card-header']) }}>
    {{$slot}}
</div>
--}}

{{ BCard()->setHeader($slot, $attributes) }}