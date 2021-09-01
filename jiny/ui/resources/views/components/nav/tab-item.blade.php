{{--
<div {{ $attributes->merge(['class' => 'tab-pane']) }} role="tabpanel">
    {{$slot}}
</div>
--}}

{{-- 스택에 탭내용을 삽입합니다. --}}
{{ BootNav()->setContent($slot, $attributes) }}