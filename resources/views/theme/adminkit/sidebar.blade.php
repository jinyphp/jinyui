{{-- 테마 사이드바--}}
<nav id="sidebar" class="sidebar js-sidebar">
    <x-simplebar class="sidebar-content">

        <a class="sidebar-brand" href="/jinyui">
            <span class="sidebar-brand-text align-middle">
                JinyUI
            </span>
        </a>

        <!-- 사이드바 메뉴 -->
        <x-menu json="menu/default.json">
            {{-- json 설정을 통하여 메뉴트리 생성 --}}
        </x-menu>

    </x-simplebar>
</nav>
