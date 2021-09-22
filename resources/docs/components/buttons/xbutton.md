---
theme: "docs.bootstrap"
layout: "markdown"
title: "xButton"
breadcrumb:
    - "Docs"
---

# xButton
xButton 객체는 button 컴포넌트를 생성합니다.


## 기본 사용법

```php
{!! xButton("Left") !!}
```
xButton은 부트스트랩의 'btn' 클래스를 부여합니다.


## 색상 적용하기

```php
->setColor($color)
```
컬러 값으로는 부트스트랩의 기본 색상값을 사용할 수 있습니다.
* primary
* secondary
* success
* danger 
* warning
* info

```php
{!! xButton("Left")->setColor('primary') !!}
```

## 버튼에 링크걸기
`<button>`요소는 `<a>`링크와 달리 href를 통하여 링크를 걸 수 없습니다. 대신, onclick 이밴트를 통하여 페이지 이동이 가능합니다. 
하지만, xButton 객체는 지원하지 않는 href 속성값을 자동으로 onclick 이벤트로 변경 처리하여 페이지 이동이 자동으로 처리 될 수 있도록 기능을 변경합니다.

```php
->setHref($url)
```

## 모양 적용하기

### 라운드 모형
버튼의 모서리를 라운드 처리하여 부드럽게 표시를 합니다.
```php
->setRound()
```

### 각진 모형
버튼의 모서리를 각진 형태의 사각형으로 표시를 합니다.
```php
->setSqure()
```

## 크기
버튼의 크기를 지정합니다.

* large
* small

```php
setSize($size)
```


## 속성적용하기
