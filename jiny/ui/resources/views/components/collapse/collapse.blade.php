<div {{ $attributes->merge(['class' => '']) }}>
    {{$slot}}
</div>
{{uiStack()->clear()}} {{-- 아코디언 아이디 초기화--}}