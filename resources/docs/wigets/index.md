---
theme: "adminkit"
layout: "markdown"
title: "..."
breadcrumb:
    - "Docs"
---

# Widget
지니UI는 다양한 형식으로 만들어놓은 UI스타일과 데이터를 결합하여 화면 출력이 가능합니다.

## x테그의 한계
지니UI가 제공하는 x테그는 이미 많이 알려져 있는 UI구성요소들을 보다 쉽게 처리하기 위한 컴포넌트 입니다. 
하지만, 다양한 사용자의 요구를 만족하기 위한 모든 UI를 설계하여 제공할 수 없습니다.

일부 x컴포넌트는 스택, 싱글턴 클래스등을 결합하여 복잡하게 설계되는 반면에 어떠한 컴포넌트는 단순한 UI의 배치와 값을 출력하는 형태도 존재합니다.
지니UI는 간단한 형식의 컴포넌트를 사용자가 직접 구현하여 처리할 수 있도록 widget 디렉티브를 제공합니다.


## `@widget` 디렉티브
widget 디렉티브는 UI의 레이아웃이 되는 blade 파일을 읽어와서 주어진 데이터와 결합을 하여 출력하는 역할을 합니다.

view를 설계할때 다음과 같이 코드를 삽입하면 됩니다.
```php
@widget("jinyui::demo.widgets.pages.title",[
    'title'=>"이미지 출력",
    'subtitle'=>"x-img 테그는 이미지를 다양한 속성을 이용하여 출력할 수 있습니다."
])
```

widget 디렉티브는 `jinyui::demo.widgets.pages.title` 리소스를 읽고, 다음 인자로 주어진 `배열` 데이터를 사용합니다.
배열은 키:값 형식의 연상배열로 전달되며, 위젯 안에서는 키값을 변수명으로 하여 사용을 합니다.

`jinyui::demo.widgets.pages.title` 리소스의 예시는 다음과 같습니다.
```php
<!-- start page title -->
<x-row >
    <x-col class="col-8">
        <div class="page-title-box">                        
            <div class="mb-3">
                @if (isset($title))
                    <h1 class="h3 d-inline align-middle">{{$title}}</h1>
                @endif
                @if (isset($subtitle))
                    <p>{{$subtitle}}</p>
                @endif                
            </div>
        </div>
    </x-col>
</x-row>  
<!-- end page title -->
```

