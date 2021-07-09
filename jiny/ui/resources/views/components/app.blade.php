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
    @livewireStyles
</head>

<body>
    
    <x-jiny-layout>
        <div class="w-16 bg-gray-800">
            Sidebar
        </div>
        <div class="content flex-grow">
            {{$slot}}
        </div>
    </x-jiny-layout>
    
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
    
</body>

</html>
