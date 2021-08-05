{{-- 네비게이션 탭의 항목을 출력합니다. --}}
<ul {{ $attributes->merge(['class' => 'nav nav-tabs']) }} >
    @foreach (BootNav()->popHeaders() as $item)
        <li class="nav-item">
            {!! $item !!}
        </li>
    @endforeach

    {{-- 직접 작성한 코드 삽입 --}}
    {{$slot}}
</ul>