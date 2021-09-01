{{-- 가로줄 --}}
<div {{ $attributes->merge(['class' => 'row']) }}>
    {{$slot}}
</div>