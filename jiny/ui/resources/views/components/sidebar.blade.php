{{-- 컴포넌트: 사이드바--}}
<div {{ $attributes->merge(['class' => 'relative']) }}  x-data="{show:'w-52'}">

    {{-- 토글 버튼--}}
    <x-jiny-sidebar-button class="top-2 -right-8">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
        </svg>
    </x-jiny-sidebar-button>

    <div class="transition-all duration-300 h-full" :class="show ? 'w-52' : 'w-0'">
        {{$slot}}
    </div>
</div>