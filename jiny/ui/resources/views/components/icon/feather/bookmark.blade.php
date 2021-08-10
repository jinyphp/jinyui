{{-- https://heroicons.com/ --}}
<svg 
@if (isset($attributes)) 
{{$attributes->merge(['class' => 'feather align-middle'])}} 
@else 
    class="feather align-middle"
@endif  
    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bookmark align-middle me-2"><path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path></svg>
