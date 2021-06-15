<div {{ $attributes->merge(['class' => 'flex-grow']) }}>
    <x-flex-col class="min-h-full justify-between">
        {{$slot}}
    </x-flex-col>  
</div>