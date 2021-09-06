---
theme: "adminkit"
layout: "markdown"
title: "xGroup"
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