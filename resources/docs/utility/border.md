---
theme: "docs.bootstrap"
layout: "markdown"
title: "Border"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
    - "Border"
---

<style>
.sample {
    padding: 1.5rem;
    margin-right: 0;
    margin-left: 0;
    border-width: 1px;
    border-top-left-radius: .25rem;
    border-top-right-radius: .25rem;
}
.sample span {
    display: inline-block;
    width: 5rem;
    height: 5rem;
    margin: .25rem;
    background-color: #f5f5f5;
}
</style>

## Borders
테두리 클래스는 HTML 요소에 빠르게 테두리 설정과 스타일을 적용합니다. 테두리 요소는 이미지, 버튼 또는 기타 요소들에게 적합합니다.


## 전체적용
`border` 클래스는 요소에 1px의 테투리 속성을 부여합니다.
<div class="sample">
    <span class="border"></span>
</div>

```html
<span class="border"></span>
```

## 데투리 추가하기
모든 면에 테두리를 설정하는 것이 아닌, 특정 면에서만 설정을 하는 경우 `border-위치` 클래스를 사용할 수 있습니다.

<div class="sample">
    <span class="border-top"></span>
    <span class="border-end"></span>
    <span class="border-bottom"></span>
    <span class="border-start"></span>
</div>



## 데투리 빼기하기
테두리가 설정되어 있는 상태에서 특정 면의 테두리를 제거 합니다. 이때 `border-*-0` 형태의 클래스를 사용합니다.

<div class="sample">
    <span class="border border-0"></span>
    <span class="border border-top-0"></span>
    <span class="border border-end-0"></span>
    <span class="border border-bottom-0"></span>
    <span class="border border-start-0"></span>
</div>

<br>
```html
<span class="border border-0"></span>
<span class="border border-top-0"></span>
<span class="border border-end-0"></span>
<span class="border border-bottom-0"></span>
<span class="border border-start-0"></span>
```


## Border color
테두리의 색을 변경합니다. 테두리 색상의 클래스명을 추가합니다.

<div class="sample">
    <span class="border border-primary"></span>
    <span class="border border-secondary"></span>
    <span class="border border-success"></span>
    <span class="border border-danger"></span>
    <span class="border border-warning"></span>
    <span class="border border-info"></span>
    <span class="border border-light"></span>
    <span class="border border-dark"></span>
    <span class="border border-white"></span>
</div>

<br>
```html
<span class="border border-primary"></span>
<span class="border border-secondary"></span>
<span class="border border-success"></span>
<span class="border border-danger"></span>
<span class="border border-warning"></span>
<span class="border border-info"></span>
<span class="border border-light"></span>
<span class="border border-dark"></span>
<span class="border border-white"></span>
```


## Border-width
테두리 선의 두깨 설정

<div class="sample">
    <span class="border border-1"></span>
    <span class="border border-2"></span>
    <span class="border border-3"></span>
    <span class="border border-4"></span>
    <span class="border border-5"></span>
</div>

## Border-radius
Add classes to an element to easily round its corners.

<img src="..." class="rounded" alt="...">
<img src="..." class="rounded-top" alt="...">
<img src="..." class="rounded-end" alt="...">
<img src="..." class="rounded-bottom" alt="...">
<img src="..." class="rounded-start" alt="...">
<img src="..." class="rounded-circle" alt="...">
<img src="..." class="rounded-pill" alt="...">


# Sizes
Use the scaling classes for larger or smaller rounded corners. 
Sizes range from 0 to 3, and can be configured by modifying the utilities API.

<img src="..." class="rounded-0" alt="...">
<img src="..." class="rounded-1" alt="...">
<img src="..." class="rounded-2" alt="...">
<img src="..." class="rounded-3" alt="...">



