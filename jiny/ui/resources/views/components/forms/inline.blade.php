{{-- 
<div {{ $attributes->merge(['class' => 'col-12']) }}>
    {{ BootFormItem()->start() }}

    {!! BootFormItem()->getLabel(['class'=>"visually-hidden"]) !!}
    {!! BootFormItem()->getItem() !!}
    {{$slot}}

    {{ BootFormItem()->clear() }}

</div>
--}}

{!! xFormItem()->setSlot($slot)
    ->inline()->addClass('mb-3') !!}