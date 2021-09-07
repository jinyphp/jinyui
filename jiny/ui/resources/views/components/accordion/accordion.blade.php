<div {{ $attributes->merge(['class' => 'accordion']) }} id="{{xAccordion()->accordionId()}}">
    {{$slot}}
</div>
{{xAccordion()->clear()}} {{-- 아코디언 아이디 초기화--}}