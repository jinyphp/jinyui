<div class="flex flex-row" style="height:inherit">
    gflkgsd;l
    {{-- 왼쪽 사이드바 메뉴--}}
    {{--
    <x-jinyui-sidebar-layout class="scroll z-20 sidebar-left " data-width="250px" data-sidebar="menu1">
         @include2('sidenav',['logo'=>"menu1"]) 
    </x-jinyui-sidebar-layout>
    --}}

    {{-- 사이드바--}}
    <x-jinyui-theme-sidebar :theme="$theme_name" class="scroll z-20 sidebar-left" data-sidebar="menu1">

    </x-jinyui-theme-sidebar>

    <x-jinyui::flex.col>
        <button class="sidebar-toggle" data-target="menu1">
            <x-jinyui-icon name="menu"/>
        </button>
    </x-jinyui::flex.col>



    {{-- 오른쪽 컨덴츠, 본문 내용을 출력합니다. --}}
    <div class="flex-grow">
        {{-- 테마 main.blade.php로 레이아웃 조정--}}
        {{--
        @include2("main",['slot'=>$slot])
        --}}
        <x-jinyui-theme-main :theme="$theme_name">
            dfasdfas
        </x-jinyui-theme-main>
    </div>

</div>

