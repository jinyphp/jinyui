<div class="flex flex-row" style="height:inherit">
    {{-- 테마 sidebar.blade.php 적용 --}}
    <x-jinyui-theme-sidebar class="scroll z-20 sidebar-left" data-sidebar="menu1">
        
    </x-jinyui-theme-sidebar>


    <div class="flex-grow">
        {{-- 테마 main.blade.php 적용--}}
        <x-jinyui-theme-main>
            {{$slot}}
        </x-jinyui-theme-main>
    </div>

</div>

