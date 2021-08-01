<div {{ $attributes->merge(['class' => 'card']) }}>
    {!! BCard()->before !!}
    {!! BCard()->getHeader() !!}

    {!! BCard()->getBody() !!}
    {{$slot}}

    {!! BCard()->getfooter() !!}
    {!! BCard()->after !!}

    {{ BCard()->clear() }}
</div>