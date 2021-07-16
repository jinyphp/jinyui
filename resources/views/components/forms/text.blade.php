<x-forms.input type="text"
    {{ $attributes->merge(['class' => 'focus:border-blue-300 bg-white border-gray-300']) }}>
    {{$slot}}
</x-forms.input>