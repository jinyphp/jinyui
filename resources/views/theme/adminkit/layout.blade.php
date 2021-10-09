{{-- 
    사이트 레이아웃을 자유롭게 작성할 수 있습니다.
--}}

<x-theme-sidebar class="sidebar scroll z-20 sidebar-left" data-sidebar="menu1">
    {{-- 테마폴더 안에 있는 sidebar.blade.php 레이아웃을 적용 합니다. --}}
</x-theme-sidebar>

<x-theme-main>
    {{-- 테마폴더 안에 있는 main.blade.php 레이아웃을 적용 합니다. --}}
    {{$slot}}
</x-theme-main>
