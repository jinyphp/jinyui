---
theme: "adminkit"
layout: "markdown"
title: "..."
breadcrumb:
    - "Docs"
---

# 아코디언
아코디어은 collpase 기능을 활용하여 많은 데이터를 그룹화 하여 화면에 출력하는 UI기능입니다.
아코디언은 일정 영역의 데이터를 수직으로 접어서 표시를 할 수 있기 때문에 많은 데이터를 출력하기에 용이합니다.

지니UI는 부트스트랩의 아이코디언을 손쉽게 출력할 수 있는 `<x-accordion>`기능을 제공합니다.

## 기존 부트스트랩
> https://getbootstrap.com/docs/5.0/components/accordion/
부트스트랩 순수 코드를 이용하여 아코디언을 출력하기 위해서는 다음과 같은 복잡한 html 코드를 작성해야만 합니다.

```html
<div class="accordion" id="accordionExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        Accordion Item #1
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Accordion Item #2
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Accordion Item #3
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
</div>
```

### 기존 코드의 문제점 
많은 div의 중첩과 클래스 속성으로 쉽게 아코디언 코드를 파악하기 쉽습니다.
또한 아코디언을 구현하기 위해서 해더와 본문 내용을 연결해 주는 역할인 유일한 id값을 생성해 주어야 합니다. 


## x-accordion 테그
지니ui의 `<x-accordion>` 테그를 이용하면 쉽게 부트스트랩의 아코디언을 구현할 수 있습니다.

```php
<x-accordion>
항목...
</x-accordion>
```

`div`테그보다 직관적인 시만텍 테그로 아코디언 기능이라는 것을 쉽게 파악할 수 있습니다.

### 아코디언 항목 추가하기

```php
<x-accordion>
    <x-accordion-item>
        <x-accordion-header>
            아코디언 해더 (링크, 버튼등...)
        </x-accordion-header>

        접히는 아코디언 내용
    </x-accordion-item>
</x-accordion>
```

`<x-accordion-item>`과 `<x-accordion-header>`를 같이 이용하면 쉽게 아이코디언 항목을 추가할 수 있으며,
기존에 유일한 id를 생성해야 하는 버거로움도 없어 집니다.


