{{-- 테마 사이드바--}}
<x-jinyui-sidebar-layout {{ $attributes }}>
    <x-jinyui-sidebar-content>
        <!-- 사이드바 로고-->
        <a class="sidebar-brand" href="/jinyui">
            <span class="sidebar-brand-text align-middle">
                @if (isset($logo))
                    {{$logo}}
                @else                
                    JinyUIKit
                @endif 
            </span>
        </a>

        <!-- 사이드바 메뉴 -->
        <x-menu json="menu/default.json">
            {{-- json 설정을 통하여 메뉴트리 생성 --}}
        </x-menu>                  
        

    </x-jinyui-sidebar-content>
</x-jinyui-sidebar-layout>