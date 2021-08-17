---
theme: "adminkit"
layout: "markdown"
title: "Badges Manual"
demo: "/jinyui/ui/buttons/badges"
breadcrumb:
    - "Docs"
---
# Badges
지니UI는 다양한 유형의 베지를 출력할 수 있도록 `<x-badge>` 테그를 제공합니다.


## `x-badge` 테그
x-badge 테그는 보다 쉽게 배치를 출력할 수 있습니다.

사용법은 다음과 같습니다.
```php
<x-badge>내용</x-badge>
```

배지에 색상을 추가하는 방법은 다음과 같이 클래스를 추가하는 것입니다.

```php
<x-badge class="bg-primary">Primary</x-badge>
<x-badge class="bg-secondary">Secondary</x-badge>
<x-badge class="bg-success">Success</x-badge>
<x-badge class="bg-danger">Danger</x-badge>
<x-badge class="bg-warning">Warning</x-badge>
<x-badge class="bg-info">Info</x-badge>
<x-badge class="bg-light text-dark">Light</x-badge>
<x-badge class="bg-dark">Dark</x-badge>
```

기모양은 약간의 라운드가 처리된 사각 박스 입니다.

## Pill 라운드
라운드 모양의 베지를 사용하과 할때에는 `rounded-pill` 클래스를 추가합니다.

```php
<x-badge class="bg-primary rounded-pill">Primary</x-badge>
<x-badge class="bg-secondary rounded-pill">Secondary</x-badge>
<x-badge class="bg-success rounded-pill">Success</x-badge>
<x-badge class="bg-danger rounded-pill">Danger</x-badge>
<x-badge class="bg-warning rounded-pill">Warning</x-badge>
<x-badge class="bg-info rounded-pill">Info</x-badge>

<x-badge class="rounded-pill bg-light text-dark">Light</x-badge>
<x-badge class="rounded-pill bg-dark">Dark</x-badge>
```

## Light 배치
밝은 색의 베지를 출력하고자 할때에는 기존 `badge-primary` 대신에 `*-lighten`를 사용합니다.

```php
<x-badge class="primary lighten">Primary</x-badge>
<x-badge class="secondary lighten">Secondary</x-badge>
<x-badge class="success lighten">Success</x-badge>
<x-badge class="danger lighten">Danger</x-badge>
<x-badge class="warning lighten">Warning</x-badge>
<x-badge class="info lighten">Info</x-badge>
<x-badge class="light lighten">Light</x-badge>
<x-badge class="dark lighten">Dark</x-badge>
```

## 외각선
외각선만 표시된 베지를 출력할때

```php
<x-badge class="outline primary">Primary</x-badge>
<x-badge class="outline secondary">Secondary</x-badge>
<x-badge class="outline success">Success</x-badge>
<x-badge class="outline danger">Danger</x-badge>
<x-badge class="outline warning">Warning</x-badge>
<x-badge class="outline info">Info</x-badge>
<x-badge class="outline light">Light</x-badge>
<x-badge class="outline dark">Dark</x-badge>
```

## 인디게이터
알람등의 표시용으로 베지를 사용할때 적합한 모양입니다.
기본적으로 원형으로 표시되며, 내용이 많아지는 경우 타원형으로 변경됩니다.


별도의 `<x-indicator>` 테그를 지원합니다.

```php
<x-indicator class="bg-primary rounded-pill">1</x-indicator>
<x-indicator class="bg-secondary rounded-pill">2</x-indicator>
<x-indicator class="bg-success rounded-pill">3</x-indicator>
<x-indicator class="bg-danger rounded-pill">4</x-indicator>
<x-indicator class="bg-warning rounded-pill">5</x-indicator>
<x-indicator class="bg-info rounded-pill">6</x-indicator>
<x-indicator class="rounded-pill bg-light text-dark">7</x-indicator>
<x-indicator class="rounded-pill bg-dark">8</x-indicator>
```

인디케이터를 SVG 아이콘과 결합하여 출력할 수 있습니다. 
이런경우 SVG아이콘과 겹쳐서 출력되는 경우가 많습니다. 아이콘과 인디테이터의 배치를 relative로 묽어 주고
인디케이트는 absolute로 배치를 합니다.

```php
<span class="relative">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
    </svg>							
    <x-indicator class="indicator bg-primary text-white ">5</x-indicator>
</span>
```


## 코드로 삽입하기
배지를 PHP 객체코드로 삽입할 수 있습니다.

```php
xBadge("이름", "스타일");
```
