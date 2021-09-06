<div {{ $attributes->merge(['class' => 'tab-content']) }}>
    {{$slot}}                        

    @foreach (xTab()->popContents() as $item)
        {!! $item !!}
    @endforeach
</div>