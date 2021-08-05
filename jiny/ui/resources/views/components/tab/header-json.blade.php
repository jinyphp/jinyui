{{-- tab 스택에 목록추가--}}
{{ BootTab()->links(json_decode($slot,true), $active) }}

    {{-- 텝 목록을 출력--}}
    @foreach (BootTab()->popHeaders() as $item)
        {!! $item !!}
    @endforeach
