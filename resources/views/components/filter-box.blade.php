<div {{ $attributes->merge(['class' => 'flex flex-row justify-center bg-white p-4 border']) }}>
    <div class="container max-w-screen-sm">
        {{$slot}}
    </div>
</div>