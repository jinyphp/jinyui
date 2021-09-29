---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tab"
breadcrumb:
    - "Docs"
---

텝은 여러개의 화면을 텝을 이용하여 분리합니다. 지니UI는 다양한 형태의 텝을 생성 관리할 수 있습니다. 

* 가로 선택형
* 세로 선택형
* 분리형

## 탭의 구성
텝은 항목을 선택할 수 있는 링크와 내용을 담고 있는 content 박스로 나누어 집니다.



## 탭 링크
지니UI는 텝의 링크를 생성할 수 있는 테그를 제공합니다.

```php
<x-jinyui::tab.link class="active" href="#account">Account</x-jinyui::tab.link>
<x-jinyui::tab.link href="#password">Password</x-jinyui::tab.link>
<x-jinyui::tab.link href="#">Privacy and safety</x-jinyui::tab.link>
<x-jinyui::tab.link href="#">Email notifications</x-jinyui::tab.link>
<x-jinyui::tab.link href="#">Web notifications</x-jinyui::tab.link>
<x-jinyui::tab.link href="#">Widgets</x-jinyui::tab.link>
<x-jinyui::tab.link href="#">Your data</x-jinyui::tab.link>
<x-jinyui::tab.link href="#">Delete account</x-jinyui::tab.link>
```


## 인스턴스를 이용한 설정
```php
<x-jinyui::tab.header class="list-group list-group-flush">
                            {{ \Jiny\UI\CTab::instance()->links(
                                [
                                    'account'=>"Account", 
                                    'passowrd'=>"password",
                                    '#1'=>"Privacy and safety",
                                    '#2'=>"Email notifications",
                                    '#3'=>"Web notifications",
                                    '#4'=>"Widgets",
                                    '#5'=>"Your data",
                                    '#6'=>"Delete account",
                                ],
                                "account") }}
</x-jinyui::tab.header>
```


## 텝 내용출력

```php
{{-- 텝출력--}}
<x-jinyui::tab.content>
    {{-- 텝 컨덴츠 생성--}}
    <x-jinyui::tab.item class="active show" id="account">
        @include('jinyui::demo.pages.page.settings.tab-account')                            
    </x-jinyui::tab.item>

    {{-- 텝 컨덴츠 생성--}}
    <x-jinyui::tab.item id="password">                        
        @include('jinyui::demo.pages.page.settings.tab-password')
    </x-jinyui::tab.item>
</x-jinyui::tab.content>

```


## Navigation 을 활용한 텝
부트스트랩은 `nav`테그를 이용하여 어러개의 컨덴츠를 선택할 수 있는 텝바 구현을 지원합니다.
이를 간단하게 하기 위해서 지니UI는 nav 컴포넌트 하위로 tab 기능을 제공합니다.

```php
<x-jinyui::nav.tab class="스타일">
    텝항목...                   
</x-jinyui::nav.tab>
```

텝의 스타일은 클래스 속성을 추가하여 변경할 수 있습니다.
* nav-tabs

### NavTab 항목추가


```php
<x-jinyui::nav.tab-item class="active" >
                        <x-jinyui::nav.tab-link href="#tab-1" class="active">Home</x-jinyui::nav.tab-link>
                        <h4 class="tab-title">Default tabs</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor tellus eget condimentum
                        rhoncus. Aenean massa. Cum sociis natoque penatibus et magnis neque dis parturient montes, nascetur ridiculus mus.
                        </p>
                        <p>Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede
                            justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae,
                            justo.</p>
</x-jinyui::nav.tab-item>
```

### 텝 출력하기
텝의 출력은 크게 2개의 영역으로 구분됩니다. 컨덴츠를 선택하는 항목과 내용을 출력하는 컨덴츠 부분입니다.

항목출력하기
```php
<x-jinyui::nav.list>
//추가내용
</x-jinyui::nav.list>
```

컨덴츠 출력하기
```php
<x-jinyui::nav.contents>
// 추가내용
</x-jinyui::nav.contents>
```

#### 동시출력하기
텝의 항목과 컨덴츠를 동시에 출력할 수 있습니다.

```php
<x-jinyui::nav.tab class="스타일">
    텝항목...                   
</x-jinyui::nav.tab>
```