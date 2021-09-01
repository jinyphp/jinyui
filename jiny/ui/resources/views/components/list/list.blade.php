{{--
<ul {{ $attributes->merge(['class' => 'list-group']) }}>
    {{$slot}}
</ul>
--}}
{!! xList($attributes)->addClass("list-group") !!}