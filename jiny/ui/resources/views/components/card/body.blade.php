{{--
<div {{ $attributes->merge(['class' => 'card-body']) }}>
    {{$slot}}
</div>
--}}

{{ BCard()->setBody($slot, $attributes) }}