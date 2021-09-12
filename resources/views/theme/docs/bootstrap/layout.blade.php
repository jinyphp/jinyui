@theme(".header")
{{-- @theme(".nav") --}}

<div class="container-xxl my-md-4 bd-layout">
    <aside class="bd-sidebar">
        @theme(".menu")
    </aside>

    {{-- 페이지 메인 내용--}}
    <main class="bd-main order-1">
        {{$slot}}
    </main>
</div>

{{-- 상대경로, 푸터를 삽입합니다. --}}
@theme(".footer")