{{-- .main / 주요 내용을 출력--}}
<div class="main">
    {{-- header --}}
    @include("theme.jinyerp.navbar")

    {{-- 컨덴츠--}}
    <x-jinyui-main-content>
        {{$slot}}
    </x-jinyui-main-content>

    {{-- footer --}}
    @include("theme.jinyerp.footer")
</div>