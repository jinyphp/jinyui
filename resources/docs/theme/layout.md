# 테마 레이아웃
테마는 사이트의 스타일과 요소들을 일괄적으로 적용하기 위한 UI 구현기법입니다.

지니UI는 다양한 테마를 관리할 수 있는 기능을 제공합니다.

## 테마폴더
테마폴더는 resource/views/theme 폴더안에 존재합니다.
해당 폴더 안에 테마명과 동일한 이름의 폴더를 생성한 후에 파일을 생성하면 됩니다.

## layout 파일
`layout.blade.php` 파일은 컨텐츠화 theme-app html 골격을 결합하는 역할을 합니다.

layout을 호출하는 방법은 `<x-theme theme="테마명">`을 사용하는 것입니다.

```php
<x-theme theme="jinyuikit">
컨덴츠 내용...
</x-theme>
```

> x-theme는 컨덴츠를 layout에 정의한 스타일로 배치한 후에 theme-app 파일과 결합합니다.


## x-theme 자세히 살펴보기
x-theme 테그의 내용을 살펴 봅니다.
components/theme/theme.blade.php

```php
<x-theme-app>
    {{-- 페이지 타이틀 설정--}}
    @if (isset($seo_title)) 
        <x-slot name="seo_title">{{$seo_title}}</x-slot>
    @endif
    
    <x-jinyui::layout.wrapper {{ $attributes }}>
        {{-- 테마를 선택합니다 --}}
        @if (isset($theme_name))
            <x-jinyui-theme-layout :theme="$theme_name">
                {{$slot}}
            </x-jinyui-theme-layout>
        @else
            {{$slot}}
        @endif
    </x-jinyui::layout.wrapper>
</x-theme-app>
```


