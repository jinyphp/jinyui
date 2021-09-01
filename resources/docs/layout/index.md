---
theme: "adminkit"
layout: "markdown"
title: "..."
breadcrumb:
    - "Docs"
---

# 레이아웃
웹사이트 디자인의 처음은 레이아웃에서 시작됩니다.
지니UI는 다양한 레이아웃의 웹사이트를 보다 쉽게 구현하기 위하여 몇 개의 레이아웃 컴포넌트와 셈플들을 같이 제공합니다.

새로운 화면을 출력한 뷰파일을 생성합니다. 
파일명: demo.blade.php
```php
<x-jinyui-theme theme="테마명">
내용
</x-jinyui-theme>
```

`<x-jinyui-theme>` 테그는 손쉽게 라라벨 프레임워크로 시작되는 기본 HTML 코드를 생성합니다.

## 테마
테마는 하나의 주제로 묶여진 UI화면 그룹입니다. 테마는 `resource/view/theme` 폴더안에 `테마명`으로 분류되어 처리 됩니다.
`<x-jinyui-theme>` 는 다양한 UI그룹으로 묶여진 화면 UI를 처리합니다.

테마를 지정할때는 `theme`속성값을 사용합니다. 아래와 같이 코드를 작성하면 지정한 테마의 layout.blade.php 파일과 결합된 HTML을 코드를 얻을 수 있습니다.
```php
<x-jinyui-theme theme="테마명">
컨덴츠 내용
</x-jinyui-theme>
```

`x-jinyui-theme` 테그는 다음과 같은 HTML 코드를 생성합니다.
```php
<x-app>
    @if (isset($seo_title)) 
        <x-slot name="seo_title">{{$seo_title}}</x-slot>
    @endif
    
    <x-jinyui::layout.wrapper {{ $attributes }}>
        @if (isset($theme_name))
            <x-jinyui-theme-layout :theme="$theme_name">
                {{$slot}}
            </x-jinyui-theme-layout>
        @else
            {{$slot}}
        @endif
    </x-jinyui::layout.wrapper>
</x-app>
```

테마는 다시 `x-app` 코드로 감사져 있는 것을 볼 수 있습니다. 
x-jiny-theme는 wrapper 클래스 속성을 가지는 div로 감싸는 코드를 생성합니다.
그리고 컨덴츠 내용을 slot으로 대체합니다.

x-app은 html의 기본 코드를 생성합니다.
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

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- 마크다운 / 코드 하이라이트 -->
    <link rel="stylesheet" href="{{ asset('css/markdown.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/styles/atom-one-dark.min.css">

    @stack('style')

    <script src="//unpkg.com/alpinejs" defer></script>
    
    @livewireStyles
</head>

<body>
    
    {{$slot}}
    
    
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')

    <!-- 코드 하이라이트 -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.1.0/highlight.min.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>

    @livewireScripts
</body>

</html>
```


즉, 테마는 기본 뼈대를 가지는 x-app > x-theme ==> layout > 사용자 뷰 형태로 재귀적인 결합을 합니다.




layout.blade.php 파일은 다음과 같습니다.
```php
<div class="flex flex-row" style="height:inherit">
 내용...
</div>
```


