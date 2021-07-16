<div class="flex flex-row" style="height:inherit">
    {{-- 왼쪽 사이드바 메뉴--}}
    {{--
    <x-jinyui-sidebar-layout class="scroll z-20 sidebar-left " data-width="250px" data-sidebar="menu1">
         @include2('sidebar',['logo'=>"menu1"]) 
        @include2('sidejson',['logo'=>"JSON-MenuTree"])
    </x-jinyui-sidebar-layout>
    --}}

  
    <x-jinyui-theme-sidebar :theme="$theme" class="scroll z-20 sidebar-left " data-width="250px" data-sidebar="menu1">
    </x-jinyui-theme-sidebar>



    <x-jinyui::flex.col>
        <button class="sidebar-toggle" data-target="menu1">
            <x-jinyui-icon name="menu"/>
        </button>
    </x-jinyui::flex.col>



    {{-- 오른쪽 컨덴츠, 본문 내용을 출력합니다. --}}
    <div class="flex-grow">
        {{$slot}}
    </div>

</div>

