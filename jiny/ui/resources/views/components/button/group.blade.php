{{--
<div {{ $attributes->merge(['class' => 'btn-group']) }}>
{{$slot}}
</div>
--}}

{!! xGroup()->setButton()->setAttrs($attributes)->addHtml($slot) !!}
