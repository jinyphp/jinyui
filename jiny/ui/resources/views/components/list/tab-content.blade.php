{{-- 텝 컨덴츠--}}
<div {{ $attributes->merge(['class' => 'tab-pane fade']) }} role="tabpanel">
    {{$slot}}
</div>