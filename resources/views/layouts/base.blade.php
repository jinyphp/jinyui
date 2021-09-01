<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>Base Livewire</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    @livewireStyles
</head>

<body>
    
    
    

    {{$slot}}
    
    @livewireScripts
    <script src="{{ asset('js/app.js') }}"></script>
    
</body>

</html>
