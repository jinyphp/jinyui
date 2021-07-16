{{-- 테마 사이드바--}}
{{--
<nav {{ $attributes->merge(['class' => 'sidebar']) }}>
    {!! $menuJson()->makeNavigation($slot) !!}
</nav>
--}}

<x-jinyui-sidebar-layout>
    <x-jinyui-sidebar-content>
        <x-jinyui-sidebar-logo>
            <a href="index.html">
                <span class="logo-text align-middle">
                    @if (isset($logo))
                        {{$logo}}
                    @else                
                        JinyUI-Kit
                    @endif
                    
                </span>
            </a>
        </x-jinyui-sidebar-logo>

        {{-- json 설정을 통하여 메뉴트리 생성 --}}
        {!! $menuJson()->makeNavigation($slot) !!}

    </x-jinyui-sidebar-content>        
</x-jinyui-sidebar-layout>