---
theme: "adminkit"
layout: "markdown"
title: "xLink"
breadcrumb:
    - "Docs"
---

# xBreadCrumb

## Native PHP 코드로 작성하기

```php
<nav aria-label="breadcrumb">
    {{ xBreadCrumb()->addLink("Home",'#') }}
    {{ xBreadCrumb()->addLink("Library") }}
    {!! xBreadCrumb()->show() !!}
</nav>
```

## Array 값을 이용하여 다중 설정하기

```php
<nav aria-label="breadcrumb">
    {!! xBreadCrumb()->setLinks([
        ['title'=>"Home", 'href'=>"#"],
        ['title'=>"Library", 'href'=>"#"],
        ['title'=>"Data", 'href'=>""]
    ])->show() !!}
</nav>
```

## 테그 사용

```php
<x-breadcrumb>
    <x-breadcrumb-item href="#">
        Home
    </x-breadcrumb-item>
    <x-breadcrumb-item>
        Data
    </x-breadcrumb-item>
</x-breadcrumb>
```
