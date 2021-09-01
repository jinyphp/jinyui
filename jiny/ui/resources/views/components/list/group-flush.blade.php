{{--
<div {{ $attributes->merge(['class' => 'list-group list-group-flush']) }}>
    {{$slot}}
</div>
--}}
{!! 
    xList($attributes)
        ->addClass("list-group") 
        ->addClass("list-group-flush")
!!}