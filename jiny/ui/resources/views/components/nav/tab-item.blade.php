{{--
<div {{ $attributes->merge(['class' => 'tab-pane']) }} role="tabpanel">
    {{$slot}}
</div>
--}}

{{ BNav()->setContent($slot, $attributes) }}