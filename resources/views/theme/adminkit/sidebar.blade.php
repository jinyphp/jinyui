{{-- 테마 사이드바--}}
<x-jinyui-sidebar-layout {{ $attributes }}>
    <x-jinyui-sidebar-content>

        <div class="logo">
            <a href="index.html">
                <span class="logo-text align-middle">
                    @if (isset($logo))
                        {{$logo}}
                    @else                
                        JinyUI-Kit
                    @endif                    
                </span>
            </a>
        </div>


        {{-- json 설정을 통하여 메뉴트리 생성 --}}
        <x-jinyui-menu json="menu/default.json">
            
        </x-jinyui-menu>          
     

        
        
    </x-jinyui-sidebar-content>
</x-jinyui-sidebar-layout>