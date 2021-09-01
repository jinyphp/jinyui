<div {{ $attributes->merge(['class' => 'col-12']) }}>
    {{ BootFormItem()->start() }}

    {{-- 라벨 --}}
    {!! BootFormItem()->getLabel(['class'=>"visually-hidden"]) !!}
    {!! BootFormItem()->getItem() !!}
    {{$slot}}

    {{ BootFormItem()->clear() }}

</div>