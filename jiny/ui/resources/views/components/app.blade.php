<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>
        @if (isset($seo_title))
            {{$seo_title}}
        @endif
    </title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- 마크다운 / 코드 하이라이트 -->
    <!--
    <link rel="stylesheet" href="{{ asset('css/markdown.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/styles/atom-one-dark.min.css">
    -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- ChartJS https://www.chartjs.org/ -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    @livewireStyles
</head>

<body>
    <div {{ $attributes->merge(['class' => 'app']) }}>
        {{$slot}}
    </div>

    <script src="{{ asset('js/app.js') }}"></script>


    <!-- 코드 하이라이트 -->
    <!--
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
    -->

    

    @livewireScripts
</body>

</html>
