@props(['scrollwidth' => 5 ])
<div {{ $attributes->merge(['class' => 'scroll x-scroll']) }} >
    {{$slot}}

    @foreach (range(1,100) as $item)
    {{ $item }} <br>
    @endforeach

</div>

