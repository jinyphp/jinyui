<button type="button" {{ $attributes->merge(['class' => 'border border-blue-500 
    text-blue-500
    m-0 px-3 h-6 rounded-2 cursor-pointer
    transition duration-500 ease-in-out
    hover:bg-blue-500 hover:text-white']) }}>
    {{$slot}}
</button>