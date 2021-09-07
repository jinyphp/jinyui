<div {{ $attributes->merge(['class' => '']) }}>
    {{$slot}}
</div>
{{xCollapse()->clear()}} {{-- 아코디언 아이디 초기화--}}