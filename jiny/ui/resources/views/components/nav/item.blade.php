{{-- 네비게이션의 아이템 추가 --}}
<li {{ $attributes->merge(['class' => 'nav-item']) }}>
    {{$slot}}
</li>