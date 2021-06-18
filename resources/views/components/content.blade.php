<div {{ $attributes->merge(['class' => '']) }}>
    {{-- 상위 레이아웃으로 주입--}}
    <x-slot name="title">
        @if ($title)
            {{$title}}
        @endif        
    </x-slot>
    <x-slot name="control">
        @if ($control)
            {{$control}}
        @endif        
    </x-slot>

    {{$slot}}
</div>