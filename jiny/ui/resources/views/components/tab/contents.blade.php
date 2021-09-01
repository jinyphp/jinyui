<div {{ $attributes->merge(['class' => 'tab-content']) }}>
    {{$slot}}                        

    @foreach (BootTab()->popContents() as $item)
        {!! $item !!}
    @endforeach
</div>