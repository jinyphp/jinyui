{{-- 가로 중앙정렬 --}}
<div {{ $attributes->merge(['class' => 'row justify-content-center']) }}>
    {{-- 
    <div class="col-auto">
        {{$slot}}
    </div>
    --}}
    {{$slot}}
</div>