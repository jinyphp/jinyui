{{-- https://heroicons.com/ --}}
<svg 
@if (isset($attributes)) 
{{$attributes->merge(['class' => 'feather align-middle'])}} 
@else 
    class="feather align-middle"
@endif  
    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 13l-7 7-7-7m14-8l-7 7-7-7" />
</svg>