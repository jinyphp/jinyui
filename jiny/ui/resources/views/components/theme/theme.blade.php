<x-theme-app>
    {{-- 페이지 타이틀 설정--}}
    @if (isset($seo_title)) 
        <x-slot name="seo_title">{{$seo_title}}</x-slot>
    @endif
    
    <x-jinyui::layout.wrapper {{ $attributes }}>
        {{-- 테마를 선택합니다 --}}
        @if (isset($theme_name))
            <x-jinyui-theme-layout :theme="$theme_name">
                {{$slot}}
            </x-jinyui-theme-layout>
        @else
            {{$slot}}
        @endif
    </x-jinyui::layout.wrapper>
</x-theme-app>