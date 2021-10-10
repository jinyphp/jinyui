<!doctype html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=".">
    <meta name="author" content="hojinlee">
    <meta name="generator" content="jinyui">

    <title>JinyUI-TailwindCSS</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('css')
    
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/styles/github.min.css">

    <script src="//unpkg.com/alpinejs" defer></script>
    
    @livewireStyles

</head>

<body>
    {{-- 레이아웃 적용 --}}
    <x-theme-layout>
        {{$slot}}
    </x-theme-layout>

    <script src="{{ asset('js/app.js') }}" defer></script>
    
    @stack('scripts')
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.2.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>

    @livewireScripts

</body>

</html>
