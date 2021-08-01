<div {{ $attributes->merge(['class' => '']) }} role="tablist">
    {{$slot}}

    @foreach (BootTab()->popHeaders() as $item)
        {!! $item !!}
    @endforeach
</div>