<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>
        
    </title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        html,body {
            height: 100%;
        }
    </style>
    <script src="//unpkg.com/alpinejs" defer></script>
    @livewireStyles
</head>

<body>

    <x-jiny-layout {{ $attributes->merge(['class' => 'overflow-x-hidden']) }}>
        @if (isset($theme))
            @include("theme.".$theme.".layout")
        @else
         {{$slot}}          
        @endif
    </x-jiny-layout>


    
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
    
</body>

</html>
