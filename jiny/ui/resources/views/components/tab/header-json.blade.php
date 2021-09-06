{{-- Jiny\UI\View\Components\Tab\HeaderJson --}}
{{-- json 데이터를 tab 스택에 추가--}}

{{ xTab()->links(json_decode($slot,true), $active) }}


{{-- 텝 목록을 출력--}}
@foreach (xTab()->popHeaders() as $item)
    {!! $item !!}
@endforeach
