{{--
<a {{$attributes}}>
    {{$slot}}
</a>
--}}

{!! xLink($slot)->setTagAttrs($attributes) !!}