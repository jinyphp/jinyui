{{-- class=" text-gray-500 text-right text-sm mb-1 pr-4" for="__country_name" --}}
<label {{ $attributes->merge(['class' => 'block']) }}>
    {{$slot}}       
</label>