{{--
<li class="nav-item">
    <a {{ $attributes->merge(['class' => 'nav-link']) }} data-bs-toggle="tab" role="tab">
        {{$slot}}
    </a>
</li>
--}}
{{-- 스텍에 텝메뉴를 추가합니다. --}}
{{ BootNav()->setTab($slot, $attributes) }}


