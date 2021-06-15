<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Admin Layout</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    @livewireStyles
</head>

<body>
    
    <x-layout>
        {{--
            테마 레이아웃, config/view.php 경로추가
            custom directive, AppServiceProvider.php 추가
        --}}
        @theme("layout")
    </x-layout>
    
    
    <script src="js/app.js"></script>
    @livewireScripts
</body>

</html>
