@props(['id', 'maxWidth'])

@php
    $id = $id ?? md5($attributes->wire('model'));

    $maxWidth = [
        'sm' => 'sm:max-w-sm',
        'md' => 'sm:max-w-md',
        'lg' => 'sm:max-w-lg',
        'xl' => 'sm:max-w-xl',
        '2xl' => 'sm:max-w-2xl',
    ][$maxWidth ?? '2xl'];
@endphp

<div class="absolute inset-0 w-full h-full bg-gray-500 opacity-75
    flex justify-center items-center">
    {{-- 마스크 레이어--}}
    <div class="bg-white">{{$slot}}</div>
</div>
