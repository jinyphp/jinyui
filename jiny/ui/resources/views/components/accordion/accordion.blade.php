<div {{ $attributes->merge(['class' => 'accordion']) }} id="{{uiStack()->accordionId()}}">
    {{$slot}}
</div>
{{uiStack()->clear()}} {{-- 아코디언 아이디 초기화--}}