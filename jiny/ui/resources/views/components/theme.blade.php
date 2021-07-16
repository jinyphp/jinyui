<x-app>
    @if (isset($seo_title)) 
        <x-slot name="seo_title">{{$seo_title}}</x-slot>
    @endif
    
    <x-layout {{ $attributes }}>
        @if (isset($theme))
            {{-- 
            @include("theme.".$theme.".layout")
            --}}
            <x-jinyui-theme-layout :theme="$theme">
                {{$slot}}
            </x-jinyui-theme-layout>
        @else
            {{$slot}}
        @endif
    </x-layout>
</x-app>
    
    