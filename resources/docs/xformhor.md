---
theme: "adminkit"
layout: "markdown"
title: "xGroup"
breadcrumb:
    - "Docs"
---

# xFormItem()
폼의 요소를 가로로 출력합니다.
xFormItem는 싱글턴 타입으로 가로 출력할 요소들을 기억한 후에 show() 메소드를 통하여 출력하게 됩니다.

```php
{{ xFormItem()->setLabel('이메일11') }}
{{ xFormItem()->setItem( xInputEmail('email')->setWidth("standard")->setPlaceholder('Email') ) }}
{!! xFormItem()->horizontal() !!}
```

## 라벨지정하기

### xFormItem()->setLabel()
setLabel() 메소드는 입력폼의 라벨명을 지정합니다.

```php
{{ xFormItem()->setLabel('이메일11') }}
```

### 테그

## 아이템지정하기
setItem() 메소드는 출력할 input 요소를 지정합니다.


### 테그

## 출력

### 수평출력

```php
->horizontal() 
```

### 수직출력
```php
->vertical() 
```