{{-- 네이게이션 텝 컨덴츠를 출력합니다. --}}
<div class="tab-content">
    @foreach (BootNav()->popContents() as $item)
        {!! $item !!}
    @endforeach

    {{-- 직접 작성한 코드 삽입 --}}
    {{$slot}}
</div>