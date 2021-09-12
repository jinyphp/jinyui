{{--
<a {{$attributes}}>
    {{$slot}}
</a>
--}}

{!! xLink($slot)->setAttrs($attributes) !!}