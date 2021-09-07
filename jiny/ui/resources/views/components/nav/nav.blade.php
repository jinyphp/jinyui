{{-- ul 기반의 네비게이션 리스트 --}}
{{--
<ul {{ $attributes->merge(['class' => 'nav']) }}>
    {{$slot}}
</ul>
--}}

{!! 
    xNav()
    ->setHtml($slot)
    ->setTagAttrs($attributes)
    ->show() 
!!}