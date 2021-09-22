{{--
<input {{ $attributes->merge(['class' => 'form-control']) }}>
--}}

{!! xInput()->setAttrs($attributes)->setValue($slot) !!}