# theme-app
지니UI는 최초의 HTML골격을 형성하기 위하여 component/theme/app 을 호출합니다.
app 컴포넌트는 HTML의 기본 골력파일과 CSS/Javascript 파일을 로드합니다.

```php
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

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @stack('css')

        <script src="//unpkg.com/alpinejs" defer></script>
        <!-- ChartJS https://www.chartjs.org/ -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @livewireStyles
    </head>

    <body>
        <div {{ $attributes->merge(['class' => 'app']) }}>
            {{$slot}}
        </div>

        <script src="{{ asset('js/app.js') }}" defer></script>
        @stack('scripts')
        @livewireScripts
    </body>
</html>
```

또한 지니UI는 라이브와이어를 같이 사용할 수 있도록 스크립트도 삽입되어 있습니다.

## theme-app 사용하기
블레이드 뷰에서 `<x-theme-app>` 테그를 이용하여 html 골력을 로드합니다.

```php
<x-theme-app>
내용...
</x-theme-app>
```
출력할 내용을 `<x-theme-app>` 테그로 감싸기만 하면 app html 파일에 있는 `slot` 변수에 대입되어 
내용이 치환됩니다.

이때 적용되는 컴포넌트는 component/theme/app.blade.php 입니다.

## 테마 폴더에 있는 theme-app 적용하기
테마폴더 안에 있는 app.blade.php 파일을 이용하여 골격을 생성할 수 있습니다.
이때에는 `thene=테마명` 속성을 부여하여 적용할 수 있습니다.

```php
<x-theme-app theme="jinyuikit">
내용...
</x-theme-app>
```

테마명이 지정되면 기본 컴포넌트의 app.blade.php를 사용하지 않고 테마 폴더 안에 있는 app.blade.php 파일로 적용합니다.






