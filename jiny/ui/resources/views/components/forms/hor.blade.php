{{--
<div {{ $attributes->merge(['class' => 'row mb-3']) }}>
    {{ BootFormItem()->start() }}

    <div class="col-sm-2 text-sm-end">
        {!! BootFormItem()->getLabel(['class'=>"col-form-label"]) !!}
    </div>                

    {!! BootFormItem()->getItem(['class'=>"col-sm-10"]) !!}
    
    {{ BootFormItem()->clear() }}
</div>
--}}


{{-- BootFormItem()->hor($attributes->merge(['class' => 'mb-3'])) --}}

{!! xFormItem()->setSlot($slot)
    ->horizontal()->addClass('mb-3') !!}
