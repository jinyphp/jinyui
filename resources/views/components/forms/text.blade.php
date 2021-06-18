{{-- class=" "
    style="
        font-family: Arial, Tahoma, Verdana, sans-serif;
        min-height: 24px;
        box-sizing: border-box;
        color: #1f2c33;
        outline: 0;
        transition: border-color .2s ease-out, box-shadow .2s ease-out;
    " --}}
<x-forms.input type="text"
    {{ $attributes->merge(['class' => 'focus:border-blue-300 bg-white border-gray-300']) }}>
    {{$slot}}
</x-forms.input>