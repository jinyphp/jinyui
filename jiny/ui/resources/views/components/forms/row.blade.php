{{--
<div {{ $attributes->merge(['class' => 'mb-3']) }}>
    {{ BootFormItem()->start() }}

  
    {!! BootFormItem()->getLabel(['class'=>"form-label"]) !!}
    {!! BootFormItem()->getItem() !!}
    {{$slot}}

    {{ BootFormItem()->clear() }}

</div>
--}}

{!! xFormItem()->setSlot($slot)
    ->vertical()->addClass('mb-3') !!}