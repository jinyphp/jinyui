{{-- 리스트 목록 --}}
<div {{ $attributes->merge(['class' => 'list-group list-group-flush']) }}>
    {{$slot}}
</div>