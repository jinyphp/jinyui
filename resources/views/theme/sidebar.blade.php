{{-- 사이드바 상단(로고)--}}
@include("theme.sidebar-header")

{{-- 사이드바 메뉴트리--}}
@include("theme.sidebar-menu")

@foreach (range(1,100) as $item)
    {{$item}} <br>
@endforeach

{{-- 사이드바 하단--}}
@include("theme.sidebar-footer")
