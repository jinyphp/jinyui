---
theme: "adminkit"
layout: "markdown"
title: "..."
breadcrumb:
    - "Docs"
---

# alert
지니ui는 경과를 쉽게 출력할 수 있는 alert 컴포넌트를 제공합니다.

`<x-alert-타입>` 형태의 테그를 지원합니다.

```php
<x-alert-primary>
    <strong>Hello there!</strong> A simple primary alert—check it out!
</x-alert-primary>

<x-alert-secondary>
    <strong>Hello there!</strong> A simple secondary alert—check it out!
</x-alert-secondary>

<x-alert-success>
    <strong>Hello there!</strong> A simple success alert—check it out!
</x-alert-success>

<x-alert-danger>
    <strong>Hello there!</strong> A simple danger alert—check it out!
</x-alert-danger>

<x-alert-warning>
    <strong>Hello there!</strong> A simple warning alert—check it out!
</x-alert-warning>

<x-alert-info>
    <strong>Hello there!</strong> A simple info alert—check it out!
</x-alert-info>
```

## 아이콘 포함시키기
alert 경고문에 아이콘을 포함하고자 하는 경우 x-slot 테그를 이용하여 아이콘을 지정합니다.

```php
<x-alert-primary>
    <x-slot name="icon">
        <x-icon.bell-outline></x-icon.bell-outline>
    </x-slot>    
    <strong>Hello there!</strong> A simple primary alert—check it out!
</x-alert-primary>
```

## outline

```php
<x-alert-primary-outline>
    <x-slot name="icon">
        <x-icon.bell-outline></x-icon.bell-outline>
    </x-slot>    
    <strong>Hello there!</strong> A simple primary alert—check it out!
</x-alert-primary-outline>
```


