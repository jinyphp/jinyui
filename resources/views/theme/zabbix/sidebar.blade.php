{{-- 테마 사이드바--}}
<div class="flex flex-col justify-between h-full bg-gray-800" >
    <div class="p-4 text-lg text-white">
        JinyERP
    </div>
    <x-jiny-scroll-bar class="flex-grow">
        @include2(".menu-json")
    </x-jiny-scroll-bar>
</div>


