---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind layout"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---

# 05.layout





# 05.3 Box Sizing

Utilities for controlling how the browser should calculate an element's total size.

브라우저가 요소의 전체 크기를 계산하는 방법을 제어하는 유틸리티입니다.



## 05.3.1 Default class reference

| Class       | Properties               |
| ----------- | ------------------------ |
| box-border  | box-sizing: border-box;  |
| box-content | box-sizing: content-box; |



## 05.3.2 Include borders and padding

Use `box-border` to set an element’s `box-sizing` to `border-box`, telling the browser to include the element’s borders and padding when you give it a height or width.

This means a 100px × 100px element with a 2px border and 4px of padding on all sides will be rendered as 100px × 100px, with an internal content area of 88px × 88px.

Tailwind makes this the default for all elements in our [preflight base styles](https://tailwindcss.com/docs/preflight).

사용 `box-border`요소의 설정 `box-sizing`에를 `border-box`당신이 그것을 높이 또는 너비를 줄 때 요소의 테두리와 패딩을 포함하도록 브라우저를 말하고.

즉, 테두리가 2px이고 패딩이 4px 인 100px × 100px 요소 는 내부 콘텐츠 영역이 88px × 88px 인 100px × 100px 로 렌더링됩니다 .

Tailwind는이를 [프리 플라이트 기본 스타일](https://tailwindcss.com/docs/preflight) 의 모든 요소에 대한 기본값으로 설정 [합니다](https://tailwindcss.com/docs/preflight) .

```html
<div class="box-border h-32 w-32 p-4 border-4 ...">
  <!-- ... -->
</div>
```



## 05.3.3 Exclude borders and padding

Use `box-content` to set an element’s `box-sizing` to `content-box`, telling the browser to add borders and padding on top of the element’s specified width or height.

사용 `box-content`요소의를 설정 `box-sizing`하기 위해 `content-box`, 브라우저를 이야기하는 요소의 지정된 너비 또는 높이의 상단에 테두리와 패딩을 추가 할 수 있습니다.

This means a 100px × 100px element with a 2px border and 4px of padding on all sides will actually be rendered as 112px × 112px, with an internal content area of 100px × 100px.

즉, 테두리가 2px이고 패딩이 4px 인 100px × 100px 요소가 실제로 112px × 112px 로 렌더링되며 내부 콘텐츠 영역은 100px × 100px입니다.

```html
<div class="box-content h-32 w-32 p-4 border-4 ...">
  <!-- ... -->
</div>
```



## 05.3.4 Responsive

To control the box-sizing at a specific breakpoint, add a `{screen}:` prefix to any existing box-sizing utility. 

For example, use `md:box-content` to apply the `box-content` utility at only medium screen sizes and above.

특정 중단 점에서 상자 크기 조정을 제어하려면 `{screen}:`기존 상자 크기 조정 유틸리티에 접두사를 추가하십시오 . 

예를 들어 중간 화면 크기 이상에서만 유틸리티 `md:box-content`를 적용하는 데 사용 합니다 `box-content`.

```html
<div class="box-border md:box-content ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

Tailwind의 반응 형 디자인 기능에 대한 자세한 내용은 [반응 형 디자인](https://tailwindcss.com/docs/responsive-design) 문서를 확인하세요 .



## 05.3.5 Customizing

### Variants

By default, only responsive variants are generated for box-sizing utilities.

You can control which variants are generated for the box-sizing utilities by modifying the `boxSizing` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

기본적으로 상자 크기 조정 유틸리티에 대해 반응 형 변형 만 생성됩니다.

파일 섹션의 속성 을 수정하여 상자 크기 조정 유틸리티에 대해 생성되는 변형을 제어 할 수 있습니다 . `boxSizing``variants` `tailwind.config.js`

예를 들어이 구성은 호버 및 포커스 변형 도 생성합니다 .

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       boxSizing: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the box-sizing utilities in your project, you can disable them entirely by setting the `boxSizing` property to `false` in the `corePlugins` section of your config file:

프로젝트에서 상자 크기 조정 유틸리티 를 사용하지 않으려는 경우 구성 파일 섹션 에서 속성 을 로 설정하여 완전히 비활성화 할 수 있습니다 . `boxSizing` `false` `corePlugins`

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     boxSizing: false,
    }
  }
```



---



# 05.4 Display

Utilities for controlling the display box type of an element.

요소의 표시 상자 유형을 제어하기위한 유틸리티입니다.



## 05.4.1 Default class reference

| Class              | Properties                   |
| ------------------ | ---------------------------- |
| block              | display: block;              |
| inline-block       | display: inline-block;       |
| inline             | display: inline;             |
| flex               | display: flex;               |
| inline-flex        | display: inline-flex;        |
| table              | display: table;              |
| inline-table       | display: inline-table;       |
| table-caption      | display: table-caption;      |
| table-cell         | display: table-cell;         |
| table-column       | display: table-column;       |
| table-column-group | display: table-column-group; |
| table-footer-group | display: table-footer-group; |
| table-header-group | display: table-header-group; |
| table-row-group    | display: table-row-group;    |
| table-row          | display: table-row;          |
| flow-root          | display: flow-root;          |
| grid               | display: grid;               |
| inline-grid        | display: inline-grid;        |
| contents           | display: contents;           |
| list-item          | display:  list-item;         |
| hidden             | display: none;               |



## 05.4.2Block

`block`블록 수준 요소를 만드는 데 사용 합니다.



```html
<div class="space-y-4 ...">
  <span class="block ...">1</span>
  <span class="block ...">2</span>
  <span class="block ...">3</span>
</div>
```



## 05.4.3 Flow-Root

Use `flow-root` to create a block-level element with its own [block formatting context](https://developer.mozilla.org/en-US/docs/Web/Guide/CSS/Block_formatting_context).

`flow-root`자체 [블록 형식 컨텍스트](https://developer.mozilla.org/en-US/docs/Web/Guide/CSS/Block_formatting_context) 를 사용하여 블록 수준 요소를 작성하는 데 사용 합니다 .



```html
<div class="space-y-4">
  <div class="flow-root ...">
    <div class="my-4 ...">1</div>
  </div>
  <div class="flow-root ...">
    <div class="my-4 ...">2</div>
  </div>
</div>
```



## 05.4.4 Inline Block

Use `inline-block` to create an inline block-level element.

`inline-block`인라인 블록 수준 요소를 만드는 데 사용 합니다.



```html
<div class="space-x-4 ...">
  <div class="inline-block ...">1</div>
  <div class="inline-block ...">2</div>
  <div class="inline-block ...">3</div>
</div>
```



## 05.4.5 Inline

Use `inline` to create an inline element.

`inline`인라인 요소를 만드는 데 사용 합니다.



```html
<div>
  <div class="inline ...">1</div>
  <div class="inline ...">2</div>
  <div class="inline ...">3</div>
</div>
```



## 05.4.6 Flex

Use `flex` to create a block-level flex container.

`flex`블록 수준 플렉스 컨테이너를 만드는 데 사용 합니다.



```html
<div class="flex space-x-4 ...">
  <div class="flex-1 ...">1</div>
  <div class="flex-1 ...">2</div>
  <div class="flex-1 ...">3</div>
</div>
```



## 05.4.7 Inline Flex

Use `inline-flex` to create an inline flex container.

`inline-flex`인라인 플렉스 컨테이너를 만드는 데 사용 합니다.



```html
<div class="inline-flex space-x-4 ...">
  <div class="flex-1 ...">1</div>
  <div class="flex-1 ...">2</div>
  <div class="flex-1 ...">3</div>
</div>
```



## 05.4.8 Grid

Use `grid` to create a grid container.

`grid`그리드 컨테이너를 만드는 데 사용 합니다.

```html
<div class="grid gap-4 grid-cols-3">
  <!-- ... -->
</div>
```



## 05.4.9 Inline Grid

Use `inline-grid` to create an inline grid container.

`inline-grid`인라인 그리드 컨테이너를 만드는 데 사용 합니다.



```html
<span class="inline-grid grid-cols-3 gap-x-4">
  <span>1</span>
  <span>1</span>
  <span>1</span>
</span>
<span class="inline-grid grid-cols-3 gap-x-4">
  <span>2</span>
  <span>2</span>
  <span>2</span>
</span>
```



## 05.4.10 Contents

`contents`자식이 부모의 직계 자식처럼 작동하는 "가상"컨테이너를 만드는 데 사용 합니다.



```html
<div class="flex ...">
  <div class="flex-1 ...">1</div>
  <div class="contents">
    <div class="flex-1 ...">2</div>
    <div class="flex-1 ...">3</div>
  </div>
  <div class="flex-1 ...">4</div>
</div>
```

## 05.4.11 Table

Use the `table`, `.table-row`, `.table-cell`, `.table-caption`, `.table-column`, `.table-column-group`, `.table-header-group`, `table-row-group`, and `.table-footer-group` utilities to create elements that behave like their respective table elements.

사용 `table`, `.table-row`, `.table-cell`, `.table-caption`, `.table-column`, `.table-column-group`, `.table-header-group`, `table-row-group`, 및 `.table-footer-group`유틸리티가 그 행동하라 각각의 테이블 요소와 같은 요소를 만들 수 있습니다.



```html
<div class="table w-full ...">
  <div class="table-row-group">
    <div class="table-row">
      <div class="table-cell ...">A cell with more content</div>
      <div class="table-cell ...">Cell 2</div>
      <div class="table-cell ...">Cell 3</div>
    </div>
    <div class="table-row">
      <div class="table-cell ...">Cell 4</div>
      <div class="table-cell ...">A cell with more content</div>
      <div class="table-cell ...">Cell 6</div>
    </div>
  </div>
</div>
```



## 05.4.12 Hidden

Use `hidden` to set an element to `display: none` and remove it from the page layout (compare with `.invisible` from the [visibility](https://tailwindcss.com/docs/visibility#invisible) documentation).

사용 `hidden`에 대한 요소를 설정 `display: none`하고 (비교 페이지 레이아웃에서 제거 `.invisible`으로부터 [가시성](https://tailwindcss.com/docs/visibility#invisible) 문서).



```html
<div class="flex ...">
  <div class="hidden ...">1</div>
  <div>2</div>
  <div>3</div>
</div>
```



## 05.4.13 Responsive

To control the display property of an element at a specific breakpoint, add a `{screen}:` prefix to any existing display utility class. For example, use `md:inline-flex` to apply the `inline-flex` utility at only medium screen sizes and above.

특정 중단 점에서 요소의 표시 속성을 제어하려면 `{screen}:`기존 표시 유틸리티 클래스에 접두사를 추가합니다 . 예를 들어 중간 화면 크기 이상에서만 유틸리티 `md:inline-flex`를 적용하는 데 사용 합니다 `inline-flex`.

```html
<div class="flex md:inline-flex ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

Tailwind의 반응 형 디자인 기능에 대한 자세한 내용은 [반응 형 디자인](https://tailwindcss.com/docs/responsive-design) 문서를 확인하세요 .



## Customizing

### Variants

By default, only responsive variants are generated for display utilities.

You can control which variants are generated for the display utilities by modifying the `display` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

기본적으로 디스플레이 유틸리티에 대해 반응 형 변형 만 생성됩니다.

파일 섹션의 속성 을 수정하여 디스플레이 유틸리티에 대해 생성되는 변형을 제어 할 수 있습니다 . `display``variants` `tailwind.config.js`

예를 들어이 구성은 호버 및 포커스 변형 도 생성합니다 .

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       display: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the display utilities in your project, you can disable them entirely by setting the `display` property to `false` in the `corePlugins` section of your config file:

프로젝트에서 디스플레이 유틸리티 를 사용하지 않으려는 경우 구성 파일 섹션 에서 속성 을 로 설정하여 완전히 비활성화 할 수 있습니다 . `display` `false` `corePlugins`

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     display: false,
    }
  }
```



---

# 05.5 Floats

Utilities for controlling the wrapping of content around an element.

요소 주위의 콘텐츠 래핑을 제어하는 유틸리티입니다.



## 05.5.1 Default class reference

| Class       | Properties    |
| ----------- | ------------- |
| float-right | float: right; |
| float-left  | float: left;  |
| float-none  | float: none;  |



## 05.5.2 Float right

Use `float-right` to float an element to the right of its container.

`float-right`컨테이너 오른쪽에 요소를 플로팅하는 데 사용 합니다.



```html
<img class="float-right ..." src="path/to/image.jpg">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis et lorem sit amet vehicula. Etiam vel nibh nec nisi euismod mollis ultrices condimentum velit. Proin velit libero, interdum ac rhoncus sit amet, pellentesque ac turpis. Quisque ac luctus turpis, vel efficitur ante. Cras convallis risus vel vehicula dapibus. Donec eget neque fringilla, faucibus mi quis, porttitor magna. Cras pellentesque leo est, et luctus neque rutrum eu. Aliquam consequat velit sed sem posuere, vitae sollicitudin mi consequat. Mauris eget ipsum sed dui rutrum fringilla. Donec varius vehicula magna sit amet auctor. Ut congue vehicula lectus in blandit. Vivamus suscipit eleifend turpis, nec sodales sem vulputate a. Curabitur pulvinar libero viverra, efficitur odio eu, finibus justo. Etiam eu vehicula felis.</p>
```



## 05.5.3 Float left

Use `float-left` to float an element to the left of its container.

`float-left`컨테이너 왼쪽에 요소를 플로팅하는 데 사용 합니다.



```html
<img class="float-left ..." src="path/to/image.jpg">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis et lorem sit amet vehicula. Etiam vel nibh nec nisi euismod mollis ultrices condimentum velit. Proin velit libero, interdum ac rhoncus sit amet, pellentesque ac turpis. Quisque ac luctus turpis, vel efficitur ante. Cras convallis risus vel vehicula dapibus. Donec eget neque fringilla, faucibus mi quis, porttitor magna. Cras pellentesque leo est, et luctus neque rutrum eu. Aliquam consequat velit sed sem posuere, vitae sollicitudin mi consequat. Mauris eget ipsum sed dui rutrum fringilla. Donec varius vehicula magna sit amet auctor. Ut congue vehicula lectus in blandit. Vivamus suscipit eleifend turpis, nec sodales sem vulputate a. Curabitur pulvinar libero viverra, efficitur odio eu, finibus justo. Etiam eu vehicula felis.</p>
```



## 05.5.4 Don't float

Use `float-none` to reset any floats that are applied to an element. This is the default value for the float property.

`float-none`요소에 적용된 부동 소수점을 재설정하는 데 사용 합니다. 이것은 float 속성의 기본값입니다.



```html
<img class="float-none ..." src="path/to/image.jpg">
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis et lorem sit amet vehicula. Etiam vel nibh nec nisi euismod mollis ultrices condimentum velit. Proin velit libero, interdum ac rhoncus sit amet, pellentesque ac turpis. Quisque ac luctus turpis, vel efficitur ante. Cras convallis risus vel vehicula dapibus. Donec eget neque fringilla, faucibus mi quis, porttitor magna. Cras pellentesque leo est, et luctus neque rutrum eu. Aliquam consequat velit sed sem posuere, vitae sollicitudin mi consequat. Mauris eget ipsum sed dui rutrum fringilla. Donec varius vehicula magna sit amet auctor. Ut congue vehicula lectus in blandit. Vivamus suscipit eleifend turpis, nec sodales sem vulputate a. Curabitur pulvinar libero viverra, efficitur odio eu, finibus justo. Etiam eu vehicula felis.</p>
```



## 05.5.5 Responsive

To control the float of an element at a specific breakpoint, add a `{screen}:` prefix to any existing float utility class. For example, use `md:float-left` to apply the `float-left` utility at only medium screen sizes and above.

특정 중단 점에서 요소의 부동을 제어하려면 `{screen}:`기존 부동 유틸리티 클래스에 접 두부를 추가하십시오 . 예를 들어 중간 화면 크기 이상에서만 유틸리티 `md:float-left`를 적용하는 데 사용 합니다 `float-left`.

```html
<div class="bg-gray-200 p-4">
  <img class="float-right md:float-left ...">
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis et lorem sit amet vehicula. Etiam vel nibh nec nisi euismod mollis ultrices condimentum velit. Proin velit libero, interdum ac rhoncus sit amet, pellentesque ac turpis. Quisque ac luctus turpis, vel efficitur ante. Cras convallis risus vel vehicula dapibus. Donec eget neque fringilla, faucibus mi quis, porttitor magna. Cras pellentesque leo est, et luctus neque rutrum eu. Aliquam consequat velit sed sem posuere, vitae sollicitudin mi consequat. Mauris eget ipsum sed dui rutrum fringilla. Donec varius vehicula magna sit amet auctor. Ut congue vehicula lectus in blandit. Vivamus suscipit eleifend turpis, nec sodales sem vulputate a. Curabitur pulvinar libero viverra, efficitur odio eu, finibus justo. Etiam eu vehicula felis.</p>
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

Tailwind의 반응 형 디자인 기능에 대한 자세한 내용은 [반응 형 디자인](https://tailwindcss.com/docs/responsive-design) 문서를 확인하세요 .



## 05.5.6 Customizing

### Variants

By default, only responsive variants are generated for float utilities.

You can control which variants are generated for the float utilities by modifying the `float` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

기본적으로 float 유틸리티에 대해 반응 형 변형 만 생성됩니다.

파일 섹션의 속성 을 수정하여 float 유틸리티에 대해 생성되는 변형을 제어 할 수 있습니다 . `float``variants` `tailwind.config.js`

예를 들어이 구성은 호버 및 포커스 변형 도 생성합니다 .

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       float: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the float utilities in your project, you can disable them entirely by setting the `float` property to `false` in the `corePlugins` section of your config file:

프로젝트에서 float 유틸리티 를 사용하지 않으려는 경우 구성 파일 섹션 에서 속성 을 로 설정하여 완전히 비활성화 할 수 있습니다 . `float` `false` `corePlugins`

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     float: false,
    }
  }
```





---



# 05.6 Clear

Utilities for controlling the wrapping of content around an element.

요소 주위의 콘텐츠 래핑을 제어하는 유틸리티입니다.



## 05.6.1 Default class reference

| Class       | Properties    |
| ----------- | ------------- |
| clear-left  | clear: left;  |
| clear-right | clear: right; |
| clear-both  | clear: both;  |
| clear-none  | clear: none;  |



## 05.6.2 Clear left

Use `clear-left` to position an element below any preceding left-floated elements.

`clear-left`왼쪽 부동 이전 요소 아래에 요소를 배치하는 데 사용 합니다.



```html
<img class="float-left ..." src="path/to/image.jpg">
<img class="float-right ..." src="path/to/image.jpg">
<p class="clear-left ...">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis et lorem sit amet vehicula. Etiam vel nibh nec nisi euismod mollis ultrices condimentum velit. Proin velit libero, interdum ac rhoncus sit amet, pellentesque ac turpis. Quisque ac luctus turpis, vel efficitur ante. Cras convallis risus vel vehicula dapibus. Donec eget neque fringilla, faucibus mi quis, porttitor magna. Cras pellentesque leo est, et luctus neque rutrum eu. Aliquam consequat velit sed sem posuere, vitae sollicitudin mi consequat. Mauris eget ipsum sed dui rutrum fringilla. Donec varius vehicula magna sit amet auctor. Ut congue vehicula lectus in blandit. Vivamus suscipit eleifend turpis, nec sodales sem vulputate a. Curabitur pulvinar libero viverra, efficitur odio eu, finibus justo. Etiam eu vehicula felis.</p>
```



## 05.6.3 Clear right

Use `clear-right` to position an element below any preceding right-floated elements.

`clear-right`오른쪽 부동 이전 요소 아래에 요소를 배치하는 데 사용 합니다.





```html
<img class="float-left ..." src="path/to/image.jpg">
<img class="float-right ..." src="path/to/image.jpg">
<p class="clear-right ...">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis et lorem sit amet vehicula. Etiam vel nibh nec nisi euismod mollis ultrices condimentum velit. Proin velit libero, interdum ac rhoncus sit amet, pellentesque ac turpis. Quisque ac luctus turpis, vel efficitur ante. Cras convallis risus vel vehicula dapibus. Donec eget neque fringilla, faucibus mi quis, porttitor magna. Cras pellentesque leo est, et luctus neque rutrum eu. Aliquam consequat velit sed sem posuere, vitae sollicitudin mi consequat. Mauris eget ipsum sed dui rutrum fringilla. Donec varius vehicula magna sit amet auctor. Ut congue vehicula lectus in blandit. Vivamus suscipit eleifend turpis, nec sodales sem vulputate a. Curabitur pulvinar libero viverra, efficitur odio eu, finibus justo. Etiam eu vehicula felis.</p>
```



## 05.6.4 Clear both

Use `clear-both` to position an element below all preceding floated elements.

`clear-both`이전의 모든 부동 요소 아래에 요소를 배치하는 데 사용 합니다.





```html
<img class="float-left ..." src="path/to/image.jpg">
<img class="float-right ..." src="path/to/image.jpg">
<p class="clear-both ...">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis et lorem sit amet vehicula. Etiam vel nibh nec nisi euismod mollis ultrices condimentum velit. Proin velit libero, interdum ac rhoncus sit amet, pellentesque ac turpis. Quisque ac luctus turpis, vel efficitur ante. Cras convallis risus vel vehicula dapibus. Donec eget neque fringilla, faucibus mi quis, porttitor magna. Cras pellentesque leo est, et luctus neque rutrum eu. Aliquam consequat velit sed sem posuere, vitae sollicitudin mi consequat. Mauris eget ipsum sed dui rutrum fringilla. Donec varius vehicula magna sit amet auctor. Ut congue vehicula lectus in blandit. Vivamus suscipit eleifend turpis, nec sodales sem vulputate a. Curabitur pulvinar libero viverra, efficitur odio eu, finibus justo. Etiam eu vehicula felis.</p>
```



## 05.6.5 Don't clear

Use `clear-none` to reset any clears that are applied to an element. This is the default value for the clear property.

`clear-none`요소에 적용된 지우기를 재설정하는 데 사용 합니다. 이것은 clear 속성의 기본값입니다.





```html
<img class="float-left ..." src="path/to/image.jpg">
<img class="float-right ..." src="path/to/image.jpg">
<p class="clear-none ...">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam venenatis et lorem sit amet vehicula. Etiam vel nibh nec nisi euismod mollis ultrices condimentum velit. Proin velit libero, interdum ac rhoncus sit amet, pellentesque ac turpis. Quisque ac luctus turpis, vel efficitur ante. Cras convallis risus vel vehicula dapibus. Donec eget neque fringilla, faucibus mi quis, porttitor magna. Cras pellentesque leo est, et luctus neque rutrum eu. Aliquam consequat velit sed sem posuere, vitae sollicitudin mi consequat. Mauris eget ipsum sed dui rutrum fringilla. Donec varius vehicula magna sit amet auctor. Ut congue vehicula lectus in blandit. Vivamus suscipit eleifend turpis, nec sodales sem vulputate a. Curabitur pulvinar libero viverra, efficitur odio eu, finibus justo. Etiam eu vehicula felis.</p>
```



## 05.6.6 Responsive

To control the clear property of an element at a specific breakpoint, add a `{screen}:` prefix to any existing clear utility. For example, use `md:clear-left` to apply the `clear-left` utility at only medium screen sizes and above.

특정 중단 점에서 요소의 지우기 속성을 제어하려면 `{screen}:`기존 지우기 유틸리티에 접두사를 추가 합니다. 예를 들어 중간 화면 크기 이상에서만 유틸리티 `md:clear-left`를 적용하는 데 사용 합니다 `clear-left`.

```html
<p class="clear-right md:clear-left ...">
  <!-- ... -->
</p>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

Tailwind의 반응 형 디자인 기능에 대한 자세한 내용은 [반응 형 디자인](https://tailwindcss.com/docs/responsive-design) 문서를 확인하세요 .



## 05.6.7 Customizing

### Variants

By default, only responsive variants are generated for clear utilities.

You can control which variants are generated for the clear utilities by modifying the `clear` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

기본적으로 명확한 유틸리티에 대해 반응 형 변형 만 생성됩니다.

파일 섹션의 속성 을 수정하여 일반 유틸리티에 대해 생성되는 변형을 제어 할 수 있습니다 . `clear``variants` `tailwind.config.js`

예를 들어이 구성은 호버 및 포커스 변형 도 생성합니다 .

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       clear: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the clear utilities in your project, you can disable them entirely by setting the `clear` property to `false` in the `corePlugins` section of your config file:

프로젝트에서 clear 유틸리티 를 사용하지 않으려는 경우 구성 파일 섹션 에서 속성 을 로 설정하여 완전히 비활성화 할 수 있습니다 . `clear` `false` `corePlugins`

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     clear: false,
    }
  }
```



---



# 05.7 Isolation

- Tailwind CSS version

  v2.1+

Utilities for controlling whether an element should explicitly create a new stacking context.

요소가 새 스택 컨텍스트를 명시 적으로 만들어야하는지 여부를 제어하기위한 유틸리티입니다.



## 05.7.1 Default class reference

| Class          | Properties          |
| -------------- | ------------------- |
| isolate        | isolation: isolate; |
| isolation-auto | isolation: auto;    |



## 05.7.2 Usage

Use the `isolate` and `isolation-auto` utilities to control whether an element should explicitly create a new stacking context.

`isolate`및 `isolation-auto`유틸리티를 사용하여 요소가 새 스택 컨텍스트를 명시 적으로 만들어야하는지 여부를 제어합니다.

```html
<div class="isolate ...">
  <!-- ... -->
</div>
```



## 05.7.3 Responsive

To control the isolation property at a specific breakpoint, add a `{screen}:` prefix to any existing isolation utility. For example, use `md:isolation-auto` to apply the `isolation-auto` utility at only medium screen sizes and above.

특정 중단 점에서 격리 속성을 제어하려면 `{screen}:`기존 격리 유틸리티에 접두사를 추가 합니다. 예를 들어 중간 화면 크기 이상에서만 유틸리티 `md:isolation-auto`를 적용하는 데 사용 합니다 `isolation-auto`.

```html
<div class="isolate md:isolation-auto ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

Tailwind의 반응 형 디자인 기능에 대한 자세한 내용은 [반응 형 디자인](https://tailwindcss.com/docs/responsive-design) 문서를 확인하세요 .





## 05.7.4 Customizing

### Variants

By default, only responsive variants are generated for isolation utilities.

You can control which variants are generated for the isolation utilities by modifying the `isolation` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

기본적으로 격리 유틸리티에 대해 반응 형 변형 만 생성됩니다.

파일 섹션의 속성 을 수정하여 격리 유틸리티에 대해 생성되는 변형을 제어 할 수 있습니다 . `isolation``variants` `tailwind.config.js`

예를 들어이 구성은 호버 및 포커스 변형 도 생성합니다 .

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       isolation: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the isolation utilities in your project, you can disable them entirely by setting the `isolation` property to `false` in the `corePlugins` section of your config file:

프로젝트에서 격리 유틸리티 를 사용하지 않으려는 경우 구성 파일 섹션 에서 속성 을 로 설정하여 완전히 비활성화 할 수 있습니다 . `isolation` `false` `corePlugins`

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     isolation: false,
    }
  }
```





---

# 05.8 Object Fit

Utilities for controlling how a replaced element's content should be resized.

대체 된 요소의 콘텐츠 크기를 조정하는 방법을 제어하는 유틸리티입니다.



## 05.8.1 Default class reference

| Class             | Properties              |
| ----------------- | ----------------------- |
| object-contain    | object-fit: contain;    |
| object-cover      | object-fit: cover;      |
| object-fill       | object-fit: fill;       |
| object-none       | object-fit: none;       |
| object-scale-down | object-fit: scale-down; |



## 05.8.2 Contain

Resize an element’s content to stay contained within its container using `.object-contain`.

를 사용하여 컨테이너 내에 포함되도록 요소의 콘텐츠 크기를 조정합니다 `.object-contain`.



![img](https://tailwindcss.com/img/placeholder-rose.svg)

```html
<div class="bg-rose-300 ...">
  <img class="object-contain h-48 w-full ...">
</div>
```



## 05.8.3 Cover

Resize an element’s content to cover its container using `.object-cover`.

를 사용하여 컨테이너를 덮도록 요소의 콘텐츠 크기를 조정합니다 `.object-cover`.

![img](https://tailwindcss.com/img/placeholder-indigo.svg)

```html
<div class="bg-indigo-300 ...">
  <img class="object-cover h-48 w-full ...">
</div>
```



## 05.8.4 Fill

Stretch an element’s content to fit its container using `.object-fill`.

를 사용하여 컨테이너에 맞게 요소의 콘텐츠를 늘립니다 `.object-fill`.



```html
<div class="bg-light-blue-300 ...">
  <img class="object-fill h-48 w-full ...">
</div>
```



## 05.8.5 None

Display an element’s content at its original size ignoring the container size using `.object-none`.

를 사용하여 컨테이너 크기를 무시하고 요소의 콘텐츠를 원래 크기로 표시합니다 `.object-none`.

![img](https://tailwindcss.com/img/placeholder-amber.svg)

```html
<div class="bg-yellow-300">
  <img class="object-none h-48 w-full ...">
</div>
```



## 05.8.6 Scale Down

Display an element’s content at its original size but scale it down to fit its container if necessary using `.object-scale-down`.

요소의 콘텐츠를 원래 크기로 표시하지만 필요한 경우를 사용하여 컨테이너에 맞게 축소합니다 `.object-scale-down`.

![img](https://tailwindcss.com/img/placeholder-emerald.svg)

```html
<div class="bg-green-300">
  <img class="object-scale-down h-48 w-full ...">
</div>
```



## 05.8.7 Responsive

To control how a replaced element’s content should be resized only at a specific breakpoint, add a `{screen}:` prefix to any existing object fit utility. For example, adding the class `md:object-scale-down` to an element would apply the `object-scale-down` utility at medium screen sizes and above.

특정 중단 점에서만 대체 된 요소의 콘텐츠 크기를 조정하는 방법을 제어하려면 `{screen}:`기존 개체 맞춤 유틸리티에 접두사를 추가 합니다. 예를 들어, `md:object-scale-down`요소에 클래스 를 추가하면 `object-scale-down`중간 화면 크기 이상에서 유틸리티 가 적용됩니다 .

```html
<div>
  <img class="object-contain md:object-scale-down ..." src="...">
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.



## 05.8.9 Customizing

### Variants

By default, only responsive variants are generated for object-fit utilities.

You can control which variants are generated for the object-fit utilities by modifying the `objectFit` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

기본적으로 객체 맞춤 유틸리티에 대해 반응 형 변형 만 생성됩니다.

파일 섹션의 속성 을 수정하여 객체 맞춤 유틸리티에 대해 생성되는 변형을 제어 할 수 있습니다 . `objectFit``variants` `tailwind.config.js`

예를 들어이 구성은 호버 및 포커스 변형 도 생성합니다 .

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       objectFit: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the object-fit utilities in your project, you can disable them entirely by setting the `objectFit` property to `false` in the `corePlugins` section of your config file:

프로젝트에서 객체 맞춤 유틸리티 를 사용하지 않으려는 경우 구성 파일 섹션 에서 속성 을 로 설정하여 완전히 비활성화 할 수 있습니다 . `objectFit` `false` `corePlugins`

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     objectFit: false,
    }
  }
```



---

# 05.9 Object Position

Utilities for controlling how a replaced element's content should be positioned within its container.

대체 된 요소의 콘텐츠를 컨테이너 내에 배치하는 방법을 제어하는 유틸리티입니다.



## 05.9.1 Default class reference

| Class               | Properties                     |
| ------------------- | ------------------------------ |
| object-bottom       | object-position: bottom;       |
| object-center       | object-position: center;       |
| object-left         | object-position: left;         |
| object-left-bottom  | object-position: left bottom;  |
| object-left-top     | object-position: left top;     |
| object-right        | object-position: right;        |
| object-right-bottom | object-position: right bottom; |
| object-right-top    | object-position: right top;    |
| object-top          | object-position: top;          |



## 05.9.2 Usage

Use the `object-{side}` utilities to specify how a replaced element’s content should be positioned within its container.

`object-{side}`유틸리티를 사용하여 대체 된 요소의 내용을 컨테이너 내에 배치하는 방법을 지정 하십시오 .



```html
<img class="object-none object-left-top bg-yellow-300 w-24 h-24 ..." src="...">
<img class="object-none object-top bg-yellow-300 w-24 h-24 ..." src="...">
<img class="object-none object-right-top bg-yellow-300 w-24 h-24 ..." src="...">
<img class="object-none object-left bg-yellow-300 w-24 h-24 ..." src="...">
<img class="object-none object-center bg-yellow-300 w-24 h-24 ..." src="...">
<img class="object-none object-right bg-yellow-300 w-24 h-24 ..." src="...">
<img class="object-none object-left-bottom bg-yellow-300 w-24 h-24 ..." src="...">
<img class="object-none object-bottom bg-yellow-300 w-24 h-24 ..." src="...">
<img class="object-none object-right-bottom bg-yellow-300 w-24 h-24 ..." src="...">
```



## 05.9.3 Responsive

To position an object only at a specific breakpoint, add a `{screen}:` prefix to any existing object position utility. For example, adding the class `md:object-top` to an element would apply the `object-top` utility at medium screen sizes and above.

특정 중단 점에만 개체를 배치하려면 `{screen}:`기존 개체 위치 유틸리티에 접두사를 추가 합니다. 예를 들어, `md:object-top`요소에 클래스 를 추가하면 `object-top`중간 화면 크기 이상에서 유틸리티 가 적용됩니다 .

```html
<img class="object-center md:object-top ..." src="...">
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

Tailwind의 반응 형 디자인 기능에 대한 자세한 내용은 [반응 형 디자인](https://tailwindcss.com/docs/responsive-design) 문서를 확인하세요 .



## 05.9.4 Customizing

### Object Positioning

By default, Tailwind provides nine object position utilities. You can change, add, or remove these by editing the `theme.objectPosition` section of your Tailwind config.

기본적으로 Tailwind는 9 개의 개체 위치 유틸리티를 제공합니다. `theme.objectPosition`Tailwind 구성 섹션을 편집하여 변경, 추가 또는 제거 할 수 있습니다 .

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      objectPosition: {
        bottom: 'bottom',
        center: 'center',
        left: 'left',
-       'left-bottom': 'left bottom',
-       'left-top': 'left top',
        right: 'right',
        'right-bottom': 'right bottom',
        'right-top': 'right top',
        top: 'top',
+       'center-bottom': 'center bottom'
+       'center-top': 'center top',
      }
    }
  }
```

### Variants

By default, only responsive variants are generated for object position utilities.

You can control which variants are generated for the object position utilities by modifying the `objectPosition` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

기본적으로 객체 위치 유틸리티에 대해 반응 형 변형 만 생성됩니다.

파일 섹션의 특성 을 수정하여 오브젝트 위치 유틸리티에 대해 생성되는 변형을 제어 할 수 있습니다 . `objectPosition``variants` `tailwind.config.js`

예를 들어이 구성은 호버 및 포커스 변형 도 생성합니다 .

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       objectPosition: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the object position utilities in your project, you can disable them entirely by setting the `objectPosition` property to `false` in the `corePlugins` section of your config file:

프로젝트에서 객체 위치 유틸리티 를 사용하지 않으려는 경우 구성 파일 섹션 에서 속성 을 로 설정하여 완전히 비활성화 할 수 있습니다 . `objectPosition` `false` `corePlugins`

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     objectPosition: false,
    }
  }
```





---

# 05.10 Overflow

Utilities for controlling how an element handles content that is too large for the container.

컨테이너에 비해 너무 큰 콘텐츠를 요소가 처리하는 방식을 제어하는 유틸리티입니다.



## 05.10.1 Default class reference

| Class              | Properties           |
| ------------------ | -------------------- |
| overflow-auto      | overflow: auto;      |
| overflow-hidden    | overflow: hidden;    |
| overflow-visible   | overflow: visible;   |
| overflow-scroll    | overflow: scroll;    |
| overflow-x-auto    | overflow-x: auto;    |
| overflow-y-auto    | overflow-y: auto;    |
| overflow-x-hidden  | overflow-x: hidden;  |
| overflow-y-hidden  | overflow-y: hidden;  |
| overflow-x-visible | overflow-x: visible; |
| overflow-y-visible | overflow-y: visible; |
| overflow-x-scroll  | overflow-x: scroll;  |
| overflow-y-scroll  | overflow-y: scroll;  |



## 05.10.2 Visible

Use `overflow-visible` to prevent content within an element from being clipped. Note that any content that overflows the bounds of the element will then be visible.

`overflow-visible`요소 내의 콘텐츠가 잘리는 것을 방지하는 데 사용 합니다. 그러면 요소의 경계를 초과하는 모든 콘텐츠가 표시됩니다.



```html
<div class="overflow-visible h-24 ...">Lorem ipsum dolor sit amet...</div>
```



## 05.10.3 Auto

Use `overflow-auto` to add scrollbars to an element in the event that its content overflows the bounds of that element. Unlike `.overflow-scroll`, which always shows scrollbars, this utility will only show them if scrolling is necessary.

`overflow-auto`콘텐츠가 해당 요소의 경계를 넘을 경우 요소에 스크롤바를 추가하는 데 사용 합니다. `.overflow-scroll`항상 스크롤바를 표시하는 과 달리이 유틸리티는 스크롤이 필요한 경우에만 표시합니다.

```html
<div class="overflow-auto h-32 ...">Lorem ipsum dolor sit amet...</div>
```



## 05.10.4 Hidden

Use `overflow-hidden` to clip any content within an element that overflows the bounds of that element.

`overflow-hidden`해당 요소의 경계를 초과하는 요소 내의 모든 콘텐츠를 클리핑하는 데 사용 합니다.





```html
<div class="overflow-hidden h-32 ...">Lorem ipsum dolor sit amet...</div>
```



## 05.10.5 Scroll horizontally if needed

Use `overflow-x-auto` to allow horizontal scrolling if needed.

`overflow-x-auto`필요한 경우 가로 스크롤을 허용하는 데 사용 합니다.

```html
<div class="overflow-x-auto ...">QrLmmW69vMQD...</div>
```



## 05.10.6 Scroll vertically if needed

Use `overflow-y-auto` to allow vertical scrolling if needed.

`overflow-y-auto`필요한 경우 세로 스크롤을 허용하는 데 사용 합니다.

```html
<div class="overflow-y-auto h-32 ...">Lorem ipsum dolor sit amet...</div>
```



## 05.10.7 Scroll horizontally always

사용 `overflow-x-scroll`수평 스크롤을 허용하고 항상 눈에 보이는 스크롤바가 운영 체제에 의해 해제되지 않는 한 항상 스크롤 막대를 표시합니다.

```html
<div class="overflow-x-scroll ...">QrLmmW69vMQD...</div>
```



## 05.10.8 Scroll vertically always

사용은 `overflow-y-scroll`수직 스크롤을 허용하고 항상 눈에 보이는 스크롤바가 운영 체제에 의해 해제되지 않는 한 항상 스크롤 막대를 표시합니다.

```html
<div class="overflow-y-scroll h-32 ...">Lorem ipsum dolor sit amet...</div>
```



## 05.10.9 Scroll in all directions

Use `overflow-scroll` to add scrollbars to an element. Unlike `.overflow-auto`, which only shows scrollbars if they are necessary, this utility always shows them. Note that some operating systems (like macOS) hide unnecessary scrollbars regardless of this setting.

`overflow-scroll`요소에 스크롤바를 추가하는 데 사용 합니다. `.overflow-auto`필요한 경우에만 스크롤바를 표시하는와 달리이 유틸리티는 항상 표시합니다. 일부 운영 체제 (예 : macOS)는이 설정에 관계없이 불필요한 스크롤바를 숨 깁니다.

```html
<div class="overflow-scroll h-32 ...">Lorem ipsum dolor sit amet...</div>
```



## 05.10.10 Responsive

To apply an overflow utility only at a specific breakpoint, add a `{screen}:` prefix to the existing class name. For example, adding the class `md:overflow-scroll` to an element would apply the `overflow-scroll` utility at medium screen sizes and above.

```html
<div class="overflow-auto md:overflow-scroll ...">
  Lorem ipsum dolor sit amet...
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.



## 05.10.11 Customizing

### Variants

By default, only responsive variants are generated for overflow utilities.

You can control which variants are generated for the overflow utilities by modifying the `overflow` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

기본적으로 오버 플로우 유틸리티에 대해 반응 형 변형 만 생성됩니다.

파일 섹션의 특성 을 수정하여 오버 플로우 유틸리티에 대해 생성되는 변형을 제어 할 수 있습니다 . `overflow``variants` `tailwind.config.js`

예를 들어이 구성은 호버 및 포커스 변형 도 생성합니다 .

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       overflow: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the overflow utilities in your project, you can disable them entirely by setting the `overflow` property to `false` in the `corePlugins` section of your config file:

프로젝트에서 오버플로 유틸리티 를 사용하지 않으려는 경우 구성 파일 섹션 에서 속성 을 로 설정하여 완전히 비활성화 할 수 있습니다 . `overflow` `false` `corePlugins`

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     overflow: false,
    }
  }
```





---



# 05.11.1 Overscroll Behavior

Utilities for controlling how the browser behaves when reaching the boundary of a scrolling area.

스크롤 영역의 경계에 도달 할 때 브라우저의 동작을 제어하는 유틸리티입니다.



## 05.11.2 Default class reference

| Class                | Properties                      |
| -------------------- | ------------------------------- |
| overscroll-auto      | overscroll-behavior: auto;      |
| overscroll-contain   | overscroll-behavior: contain;   |
| overscroll-none      | overscroll-behavior: none;      |
| overscroll-y-auto    | overscroll-behavior-y: auto;    |
| overscroll-y-contain | overscroll-behavior-y: contain; |
| overscroll-y-none    | overscroll-behavior-y: none;    |
| overscroll-x-auto    | overscroll-behavior-x: auto;    |
| overscroll-x-contain | overscroll-behavior-x: contain; |
| overscroll-x-none    | overscroll-behavior-x: none;    |



## 05.11.3 Auto

Use `overscroll-auto` to make it possible for the user to continue scrolling a parent scroll area when they reach the boundary of the primary scroll area.

사용 `overscroll-auto`가능 사용자들이 기본 스크롤 영역의 경계에 도달하면 부모 스크롤 영역을 계속 스크롤 할 수 있도록합니다.

```html
<div class="overscroll-auto ...">Lorem ipsum dolor sit amet...</div>
```



## 05.11.4 Contain

Use `overscroll-contain` to prevent scrolling in the target area from triggering scrolling in the parent element, but preserve “bounce” effects when scrolling past the end of the container in operating systems that support it.

사용 `overscroll-contain`을 지원하는 시스템을 운영에 컨테이너의 끝을지나 스크롤 할 때 부모 요소에 스크롤 트리거에서 대상 지역에 스크롤 방지하지만, "바운스"효과를 유지합니다



```html
<div class="overscroll-contain ...">Lorem ipsum dolor sit amet...</div>
```



## 05.11.5 None

Use `overscroll-none` to prevent scrolling in the target area from triggering scrolling in the parent element, and also prevent “bounce” effects when scrolling past the end of the container.

사용은 `overscroll-none`부모 요소에 스크롤 트리거에서 대상 지역에 스크롤을 방지하고, 용기의 끝을지나 스크롤 할 때 또한 "바운스"효과를 방지합니다.

```html
<div class="overscroll-none ...">Lorem ipsum dolor sit amet...</div>
```



## 05.11.6 Responsive

To control the overscroll-behavior property at a specific breakpoint, add a `{screen}:` prefix to any existing overscroll-behavior utility. For example, use `md:overscroll-contain` to apply the `overscroll-contain` utility at only medium screen sizes and above.

특정 중단 점에서 overscroll-behavior 속성을 제어하려면 `{screen}:`기존 overscroll-behavior 유틸리티에 접두사를 추가 합니다. 예를 들어 중간 화면 크기 이상에서만 유틸리티 `md:overscroll-contain`를 적용하는 데 사용 합니다 `overscroll-contain`.

```html
<div class="overscroll-auto md:overscroll-contain lg:overscroll-none ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

Tailwind의 반응 형 디자인 기능에 대한 자세한 내용은 [반응 형 디자인](https://tailwindcss.com/docs/responsive-design) 문서를 확인하세요 .



## 05.11.7 Customizing

### Variants

By default, only responsive variants are generated for overscroll-behavior utilities.

You can control which variants are generated for the overscroll-behavior utilities by modifying the `overscrollBehavior` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

기본적으로 오버 스크롤 동작 유틸리티에 대해 반응 형 변형 만 생성됩니다.

파일 섹션의 속성 을 수정하여 오버 스크롤 동작 유틸리티에 대해 생성되는 변형을 제어 할 수 있습니다 . `overscrollBehavior``variants` `tailwind.config.js`

예를 들어이 구성은 호버 및 포커스 변형 도 생성합니다 .

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       overscrollBehavior: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the overscroll-behavior utilities in your project, you can disable them entirely by setting the `overscrollBehavior` property to `false` in the `corePlugins` section of your config file:

프로젝트에서 오버 스크롤 동작 유틸리티 를 사용하지 않으려는 경우 구성 파일 섹션 에서 속성 을 로 설정하여 완전히 비활성화 할 수 있습니다 . `overscrollBehavior` `false` `corePlugins`

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     overscrollBehavior: false,
    }
  }
```



---



# 05.12 Position

Utilities for controlling how an element is positioned in the DOM.

DOM에서 요소의 위치를 제어하기위한 유틸리티입니다.



## 05.12.1 Default class reference

| Class    | Properties          |
| -------- | ------------------- |
| static   | position: static;   |
| fixed    | position: fixed;    |
| absolute | position: absolute; |
| relative | position: relative; |
| sticky   | position: sticky;   |



## 05.12.2 Static

Use `static` to position an element according to the normal flow of the document.

Any offsets will be ignored and the element will not act as a position reference for absolutely positioned children.

`static`문서의 일반적인 흐름에 따라 요소를 배치하는 데 사용 합니다.

모든 오프셋은 무시되고 요소는 절대적으로 배치 된 자식에 대한 위치 참조로 작동하지 않습니다.

```html
<div class="static ...">
  <p>Static parent</p>
  <div class="absolute bottom-0 left-0 ...">
    <p>Absolute child</p>
  </div>
</div>
```



## 05.12.3 Relative

Use `relative` to position an element according to the normal flow of the document.

Offsets are calculated relative to the element’s normal position and the element *will* act as a position reference for absolutely positioned children.

`relative`문서의 일반적인 흐름에 따라 요소를 배치하는 데 사용 합니다.

오프셋은 요소의 정상 위치를 기준으로 계산되며 요소 *는* 절대 위치에있는 자식에 대한 위치 참조 역할을합니다.

```html
<div class="relative ...">
  <p>Relative parent</p>
  <div class="absolute bottom-0 left-0 ...">
    <p>Absolute child</p>
  </div>
</div>
```



## 05.12.4 Absolute

Use `absolute` to position an element *outside* of the normal flow of the document, causing neighboring elements to act as if the element doesn’t exist.

Offsets are calculated relative to the nearest parent that has a position other than `static`, and the element *will* act as a position reference for other absolutely positioned children.

사용 `absolute`된 요소 위치로 *외부* 주변 소자가 요소가 존재하지 않는 것처럼 행동 일으키는 문서의 정상적인 흐름을.

오프셋은 이외의 위치가있는 가장 가까운 상위 항목을 기준으로 계산 `static`되며 요소 *는* 절대 위치에있는 다른 하위 항목에 대한 위치 참조 역할을합니다.

```html
<div class="static ...">
  <!-- Static parent -->
  <div class="static ..."><p>Static child</p></div>
  <div class="inline-block ..."><p>Static sibling</p></div>
  <!-- Static parent -->
  <div class="absolute ..."><p>Absolute child</p></div>
  <div class="inline-block ..."><p>Static sibling</p></div>
</div>
```



## 05.12.5 Fixed

Use `fixed` to position an element relative to the browser window.

Offsets are calculated relative to the viewport and the element *will* act as a position reference for absolutely positioned children.

 

`fixed`브라우저 창을 기준으로 요소를 배치하는 데 사용 합니다.

오프셋은 뷰포트를 기준으로 계산되며 요소 *는* 절대적으로 배치 된 자식에 대한 위치 참조 역할을합니다.



```html
<div>
  <div class="fixed ...">
    Fixed child
  </div>

  Scroll me!

  Lorem ipsum...
</div>
```



## 05.12.6 Sticky

Use `sticky` to position an element as `relative` until it crosses a specified threshold, then treat it as fixed until its parent is off screen.

Offsets are calculated relative to the element’s normal position and the element *will* act as a position reference for absolutely positioned children.

사용 `sticky`등의 요소를 배치하기 `relative`가 지정된 임계 값을 초과 할 때까지, 부모가 화면 꺼질 때까지 고정으로 취급합니다.

오프셋은 요소의 정상 위치를 기준으로 계산되며 요소 *는* 절대 위치에있는 자식에 대한 위치 참조 역할을합니다.



```html
<div>
  <div class="sticky top-0 ...">Sticky Heading 1</div>
  <p class="py-4">Quisque cursus...</p>
</div>
<div>
  <div class="sticky top-0 ...">Sticky Heading 2</div>
  <p class="py-4">Integer lacinia...</p>
</div>
<div>
  <div class="sticky top-0 ...">Sticky Heading 3</div>
  <p class="py-4">Nullam mauris...</p>
</div>
<!-- etc. -->
```



## 05.12.7 Responsive

To change how an element is positioned only at a specific breakpoint, add a `{screen}:` prefix to any existing position utility. For example, adding the class `md:absolute` to an element would apply the `absolute` utility at medium screen sizes and above.

요소가 특정 중단 점에만 배치되는 방식을 변경하려면 `{screen}:`기존 위치 유틸리티에 접 두부를 추가하십시오 . 예를 들어, `md:absolute`요소에 클래스 를 추가하면 `absolute`중간 화면 크기 이상에서 유틸리티 가 적용됩니다 .

```html
<div class="relative h-32 ...">
  <div class="inset-x-0 bottom-0 relative md:absolute"></div>
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

Tailwind의 반응 형 디자인 기능에 대한 자세한 내용은 [반응 형 디자인](https://tailwindcss.com/docs/responsive-design) 문서를 확인하세요 .



## 05.12.8 Customizing

### Variants

By default, only responsive variants are generated for position utilities.

You can control which variants are generated for the position utilities by modifying the `position` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

기본적으로 위치 유틸리티에 대해 반응 형 변형 만 생성됩니다.

파일 섹션의 특성 을 수정하여 위치 유틸리티에 대해 생성되는 변형을 제어 할 수 있습니다 . `position``variants` `tailwind.config.js`

예를 들어이 구성은 호버 및 포커스 변형 도 생성합니다 .

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       position: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the position utilities in your project, you can disable them entirely by setting the `position` property to `false` in the `corePlugins` section of your config file:

프로젝트에서 위치 유틸리티 를 사용하지 않으려는 경우 구성 파일 섹션 에서 속성 을 로 설정하여 완전히 비활성화 할 수 있습니다 . `position` `false` `corePlugins`

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     position: false,
    }
  }
```



---

# 05.13 Top / Right / Bottom / Left

Utilities for controlling the placement of positioned elements.

배치 된 요소의 배치를 제어하기위한 유틸리티입니다.



## 05.13.1 Default class reference

| Class         | Properties                                                   |
| ------------- | ------------------------------------------------------------ |
| inset-0       | top: 0px; right: 0px; bottom: 0px; left: 0px;                |
| -inset-0      | top: 0px; right: 0px; bottom: 0px; left: 0px;                |
| inset-y-0     | top: 0px; bottom: 0px;                                       |
| inset-x-0     | right: 0px; left: 0px;                                       |
| -inset-y-0    | top: 0px; bottom: 0px;                                       |
| -inset-x-0    | right: 0px; left: 0px;                                       |
| top-0         | top: 0px;                                                    |
| right-0       | right: 0px;                                                  |
| bottom-0      | bottom: 0px;                                                 |
| left-0        | left: 0px;                                                   |
| -top-0        | top: 0px;                                                    |
| -right-0      | right: 0px;                                                  |
| -bottom-0     | bottom: 0px;                                                 |
| -left-0       | left: 0px;                                                   |
| inset-px      | top: 1px; right: 1px; bottom: 1px; left: 1px;                |
| -inset-px     | top: -1px; right: -1px; bottom: -1px; left: -1px;            |
| inset-y-px    | top: 1px; bottom: 1px;                                       |
| inset-x-px    | right: 1px; left: 1px;                                       |
| -inset-y-px   | top: -1px; bottom: -1px;                                     |
| -inset-x-px   | right: -1px; left: -1px;                                     |
| top-px        | top: 1px;                                                    |
| right-px      | right: 1px;                                                  |
| bottom-px     | bottom: 1px;                                                 |
| left-px       | left: 1px;                                                   |
| -top-px       | top: -1px;                                                   |
| -right-px     | right: -1px;                                                 |
| -bottom-px    | bottom: -1px;                                                |
| -left-px      | left: -1px;                                                  |
| inset-0.5     | top: 0.125rem; right: 0.125rem; bottom: 0.125rem; left: 0.125rem; |
| -inset-0.5    | top: -0.125rem; right: -0.125rem; bottom: -0.125rem; left: -0.125rem; |
| inset-y-0.5   | top: 0.125rem; bottom: 0.125rem;                             |
| inset-x-0.5   | right: 0.125rem; left: 0.125rem;                             |
| -inset-y-0.5  | top: -0.125rem; bottom: -0.125rem;                           |
| -inset-x-0.5  | right: -0.125rem; left: -0.125rem;                           |
| top-0.5       | top: 0.125rem;                                               |
| right-0.5     | right: 0.125rem;                                             |
| bottom-0.5    | bottom: 0.125rem;                                            |
| left-0.5      | left: 0.125rem;                                              |
| -top-0.5      | top: -0.125rem;                                              |
| -right-0.5    | right: -0.125rem;                                            |
| -bottom-0.5   | bottom: -0.125rem;                                           |
| -left-0.5     | left: -0.125rem;                                             |
| inset-1       | top: 0.25rem; right: 0.25rem; bottom: 0.25rem; left: 0.25rem; |
| -inset-1      | top: -0.25rem; right: -0.25rem; bottom: -0.25rem; left: -0.25rem; |
| inset-y-1     | top: 0.25rem; bottom: 0.25rem;                               |
| inset-x-1     | right: 0.25rem; left: 0.25rem;                               |
| -inset-y-1    | top: -0.25rem; bottom: -0.25rem;                             |
| -inset-x-1    | right: -0.25rem; left: -0.25rem;                             |
| top-1         | top: 0.25rem;                                                |
| right-1       | right: 0.25rem;                                              |
| bottom-1      | bottom: 0.25rem;                                             |
| left-1        | left: 0.25rem;                                               |
| -top-1        | top: -0.25rem;                                               |
| -right-1      | right: -0.25rem;                                             |
| -bottom-1     | bottom: -0.25rem;                                            |
| -left-1       | left: -0.25rem;                                              |
| inset-1.5     | top: 0.375rem; right: 0.375rem; bottom: 0.375rem; left: 0.375rem; |
| -inset-1.5    | top: -0.375rem; right: -0.375rem; bottom: -0.375rem; left: -0.375rem; |
| inset-y-1.5   | top: 0.375rem; bottom: 0.375rem;                             |
| inset-x-1.5   | right: 0.375rem; left: 0.375rem;                             |
| -inset-y-1.5  | top: -0.375rem; bottom: -0.375rem;                           |
| -inset-x-1.5  | right: -0.375rem; left: -0.375rem;                           |
| top-1.5       | top: 0.375rem;                                               |
| right-1.5     | right: 0.375rem;                                             |
| bottom-1.5    | bottom: 0.375rem;                                            |
| left-1.5      | left: 0.375rem;                                              |
| -top-1.5      | top: -0.375rem;                                              |
| -right-1.5    | right: -0.375rem;                                            |
| -bottom-1.5   | bottom: -0.375rem;                                           |
| -left-1.5     | left: -0.375rem;                                             |
| inset-2       | top: 0.5rem; right: 0.5rem; bottom: 0.5rem; left: 0.5rem;    |
| -inset-2      | top: -0.5rem; right: -0.5rem; bottom: -0.5rem; left: -0.5rem; |
| inset-y-2     | top: 0.5rem; bottom: 0.5rem;                                 |
| inset-x-2     | right: 0.5rem; left: 0.5rem;                                 |
| -inset-y-2    | top: -0.5rem; bottom: -0.5rem;                               |
| -inset-x-2    | right: -0.5rem; left: -0.5rem;                               |
| top-2         | top: 0.5rem;                                                 |
| right-2       | right: 0.5rem;                                               |
| bottom-2      | bottom: 0.5rem;                                              |
| left-2        | left: 0.5rem;                                                |
| -top-2        | top: -0.5rem;                                                |
| -right-2      | right: -0.5rem;                                              |
| -bottom-2     | bottom: -0.5rem;                                             |
| -left-2       | left: -0.5rem;                                               |
| inset-2.5     | top: 0.625rem; right: 0.625rem; bottom: 0.625rem; left: 0.625rem; |
| -inset-2.5    | top: -0.625rem; right: -0.625rem; bottom: -0.625rem; left: -0.625rem; |
| inset-y-2.5   | top: 0.625rem; bottom: 0.625rem;                             |
| inset-x-2.5   | right: 0.625rem; left: 0.625rem;                             |
| -inset-y-2.5  | top: -0.625rem; bottom: -0.625rem;                           |
| -inset-x-2.5  | right: -0.625rem; left: -0.625rem;                           |
| top-2.5       | top: 0.625rem;                                               |
| right-2.5     | right: 0.625rem;                                             |
| bottom-2.5    | bottom: 0.625rem;                                            |
| left-2.5      | left: 0.625rem;                                              |
| -top-2.5      | top: -0.625rem;                                              |
| -right-2.5    | right: -0.625rem;                                            |
| -bottom-2.5   | bottom: -0.625rem;                                           |
| -left-2.5     | left: -0.625rem;                                             |
| inset-3       | top: 0.75rem; right: 0.75rem; bottom: 0.75rem; left: 0.75rem; |
| -inset-3      | top: -0.75rem; right: -0.75rem; bottom: -0.75rem; left: -0.75rem; |
| inset-y-3     | top: 0.75rem; bottom: 0.75rem;                               |
| inset-x-3     | right: 0.75rem; left: 0.75rem;                               |
| -inset-y-3    | top: -0.75rem; bottom: -0.75rem;                             |
| -inset-x-3    | right: -0.75rem; left: -0.75rem;                             |
| top-3         | top: 0.75rem;                                                |
| right-3       | right: 0.75rem;                                              |
| bottom-3      | bottom: 0.75rem;                                             |
| left-3        | left: 0.75rem;                                               |
| -top-3        | top: -0.75rem;                                               |
| -right-3      | right: -0.75rem;                                             |
| -bottom-3     | bottom: -0.75rem;                                            |
| -left-3       | left: -0.75rem;                                              |
| inset-3.5     | top: 0.875rem; right: 0.875rem; bottom: 0.875rem; left: 0.875rem; |
| -inset-3.5    | top: -0.875rem; right: -0.875rem; bottom: -0.875rem; left: -0.875rem; |
| inset-y-3.5   | top: 0.875rem; bottom: 0.875rem;                             |
| inset-x-3.5   | right: 0.875rem; left: 0.875rem;                             |
| -inset-y-3.5  | top: -0.875rem; bottom: -0.875rem;                           |
| -inset-x-3.5  | right: -0.875rem; left: -0.875rem;                           |
| top-3.5       | top: 0.875rem;                                               |
| right-3.5     | right: 0.875rem;                                             |
| bottom-3.5    | bottom: 0.875rem;                                            |
| left-3.5      | left: 0.875rem;                                              |
| -top-3.5      | top: -0.875rem;                                              |
| -right-3.5    | right: -0.875rem;                                            |
| -bottom-3.5   | bottom: -0.875rem;                                           |
| -left-3.5     | left: -0.875rem;                                             |
| inset-4       | top: 1rem; right: 1rem; bottom: 1rem; left: 1rem;            |
| -inset-4      | top: -1rem; right: -1rem; bottom: -1rem; left: -1rem;        |
| inset-y-4     | top: 1rem; bottom: 1rem;                                     |
| inset-x-4     | right: 1rem; left: 1rem;                                     |
| -inset-y-4    | top: -1rem; bottom: -1rem;                                   |
| -inset-x-4    | right: -1rem; left: -1rem;                                   |
| top-4         | top: 1rem;                                                   |
| right-4       | right: 1rem;                                                 |
| bottom-4      | bottom: 1rem;                                                |
| left-4        | left: 1rem;                                                  |
| -top-4        | top: -1rem;                                                  |
| -right-4      | right: -1rem;                                                |
| -bottom-4     | bottom: -1rem;                                               |
| -left-4       | left: -1rem;                                                 |
| inset-5       | top: 1.25rem; right: 1.25rem; bottom: 1.25rem; left: 1.25rem; |
| -inset-5      | top: -1.25rem; right: -1.25rem; bottom: -1.25rem; left: -1.25rem; |
| inset-y-5     | top: 1.25rem; bottom: 1.25rem;                               |
| inset-x-5     | right: 1.25rem; left: 1.25rem;                               |
| -inset-y-5    | top: -1.25rem; bottom: -1.25rem;                             |
| -inset-x-5    | right: -1.25rem; left: -1.25rem;                             |
| top-5         | top: 1.25rem;                                                |
| right-5       | right: 1.25rem;                                              |
| bottom-5      | bottom: 1.25rem;                                             |
| left-5        | left: 1.25rem;                                               |
| -top-5        | top: -1.25rem;                                               |
| -right-5      | right: -1.25rem;                                             |
| -bottom-5     | bottom: -1.25rem;                                            |
| -left-5       | left: -1.25rem;                                              |
| inset-6       | top: 1.5rem; right: 1.5rem; bottom: 1.5rem; left: 1.5rem;    |
| -inset-6      | top: -1.5rem; right: -1.5rem; bottom: -1.5rem; left: -1.5rem; |
| inset-y-6     | top: 1.5rem; bottom: 1.5rem;                                 |
| inset-x-6     | right: 1.5rem; left: 1.5rem;                                 |
| -inset-y-6    | top: -1.5rem; bottom: -1.5rem;                               |
| -inset-x-6    | right: -1.5rem; left: -1.5rem;                               |
| top-6         | top: 1.5rem;                                                 |
| right-6       | right: 1.5rem;                                               |
| bottom-6      | bottom: 1.5rem;                                              |
| left-6        | left: 1.5rem;                                                |
| -top-6        | top: -1.5rem;                                                |
| -right-6      | right: -1.5rem;                                              |
| -bottom-6     | bottom: -1.5rem;                                             |
| -left-6       | left: -1.5rem;                                               |
| inset-7       | top: 1.75rem; right: 1.75rem; bottom: 1.75rem; left: 1.75rem; |
| -inset-7      | top: -1.75rem; right: -1.75rem; bottom: -1.75rem; left: -1.75rem; |
| inset-y-7     | top: 1.75rem; bottom: 1.75rem;                               |
| inset-x-7     | right: 1.75rem; left: 1.75rem;                               |
| -inset-y-7    | top: -1.75rem; bottom: -1.75rem;                             |
| -inset-x-7    | right: -1.75rem; left: -1.75rem;                             |
| top-7         | top: 1.75rem;                                                |
| right-7       | right: 1.75rem;                                              |
| bottom-7      | bottom: 1.75rem;                                             |
| left-7        | left: 1.75rem;                                               |
| -top-7        | top: -1.75rem;                                               |
| -right-7      | right: -1.75rem;                                             |
| -bottom-7     | bottom: -1.75rem;                                            |
| -left-7       | left: -1.75rem;                                              |
| inset-8       | top: 2rem; right: 2rem; bottom: 2rem; left: 2rem;            |
| -inset-8      | top: -2rem; right: -2rem; bottom: -2rem; left: -2rem;        |
| inset-y-8     | top: 2rem; bottom: 2rem;                                     |
| inset-x-8     | right: 2rem; left: 2rem;                                     |
| -inset-y-8    | top: -2rem; bottom: -2rem;                                   |
| -inset-x-8    | right: -2rem; left: -2rem;                                   |
| top-8         | top: 2rem;                                                   |
| right-8       | right: 2rem;                                                 |
| bottom-8      | bottom: 2rem;                                                |
| left-8        | left: 2rem;                                                  |
| -top-8        | top: -2rem;                                                  |
| -right-8      | right: -2rem;                                                |
| -bottom-8     | bottom: -2rem;                                               |
| -left-8       | left: -2rem;                                                 |
| inset-9       | top: 2.25rem; right: 2.25rem; bottom: 2.25rem; left: 2.25rem; |
| -inset-9      | top: -2.25rem; right: -2.25rem; bottom: -2.25rem; left: -2.25rem; |
| inset-y-9     | top: 2.25rem; bottom: 2.25rem;                               |
| inset-x-9     | right: 2.25rem; left: 2.25rem;                               |
| -inset-y-9    | top: -2.25rem; bottom: -2.25rem;                             |
| -inset-x-9    | right: -2.25rem; left: -2.25rem;                             |
| top-9         | top: 2.25rem;                                                |
| right-9       | right: 2.25rem;                                              |
| bottom-9      | bottom: 2.25rem;                                             |
| left-9        | left: 2.25rem;                                               |
| -top-9        | top: -2.25rem;                                               |
| -right-9      | right: -2.25rem;                                             |
| -bottom-9     | bottom: -2.25rem;                                            |
| -left-9       | left: -2.25rem;                                              |
| inset-10      | top: 2.5rem; right: 2.5rem; bottom: 2.5rem; left: 2.5rem;    |
| -inset-10     | top: -2.5rem; right: -2.5rem; bottom: -2.5rem; left: -2.5rem; |
| inset-y-10    | top: 2.5rem; bottom: 2.5rem;                                 |
| inset-x-10    | right: 2.5rem; left: 2.5rem;                                 |
| -inset-y-10   | top: -2.5rem; bottom: -2.5rem;                               |
| -inset-x-10   | right: -2.5rem; left: -2.5rem;                               |
| top-10        | top: 2.5rem;                                                 |
| right-10      | right: 2.5rem;                                               |
| bottom-10     | bottom: 2.5rem;                                              |
| left-10       | left: 2.5rem;                                                |
| -top-10       | top: -2.5rem;                                                |
| -right-10     | right: -2.5rem;                                              |
| -bottom-10    | bottom: -2.5rem;                                             |
| -left-10      | left: -2.5rem;                                               |
| inset-11      | top: 2.75rem; right: 2.75rem; bottom: 2.75rem; left: 2.75rem; |
| -inset-11     | top: -2.75rem; right: -2.75rem; bottom: -2.75rem; left: -2.75rem; |
| inset-y-11    | top: 2.75rem; bottom: 2.75rem;                               |
| inset-x-11    | right: 2.75rem; left: 2.75rem;                               |
| -inset-y-11   | top: -2.75rem; bottom: -2.75rem;                             |
| -inset-x-11   | right: -2.75rem; left: -2.75rem;                             |
| top-11        | top: 2.75rem;                                                |
| right-11      | right: 2.75rem;                                              |
| bottom-11     | bottom: 2.75rem;                                             |
| left-11       | left: 2.75rem;                                               |
| -top-11       | top: -2.75rem;                                               |
| -right-11     | right: -2.75rem;                                             |
| -bottom-11    | bottom: -2.75rem;                                            |
| -left-11      | left: -2.75rem;                                              |
| inset-12      | top: 3rem; right: 3rem; bottom: 3rem; left: 3rem;            |
| -inset-12     | top: -3rem; right: -3rem; bottom: -3rem; left: -3rem;        |
| inset-y-12    | top: 3rem; bottom: 3rem;                                     |
| inset-x-12    | right: 3rem; left: 3rem;                                     |
| -inset-y-12   | top: -3rem; bottom: -3rem;                                   |
| -inset-x-12   | right: -3rem; left: -3rem;                                   |
| top-12        | top: 3rem;                                                   |
| right-12      | right: 3rem;                                                 |
| bottom-12     | bottom: 3rem;                                                |
| left-12       | left: 3rem;                                                  |
| -top-12       | top: -3rem;                                                  |
| -right-12     | right: -3rem;                                                |
| -bottom-12    | bottom: -3rem;                                               |
| -left-12      | left: -3rem;                                                 |
| inset-14      | top: 3.5rem; right: 3.5rem; bottom: 3.5rem; left: 3.5rem;    |
| -inset-14     | top: -3.5rem; right: -3.5rem; bottom: -3.5rem; left: -3.5rem; |
| inset-y-14    | top: 3.5rem; bottom: 3.5rem;                                 |
| inset-x-14    | right: 3.5rem; left: 3.5rem;                                 |
| -inset-y-14   | top: -3.5rem; bottom: -3.5rem;                               |
| -inset-x-14   | right: -3.5rem; left: -3.5rem;                               |
| top-14        | top: 3.5rem;                                                 |
| right-14      | right: 3.5rem;                                               |
| bottom-14     | bottom: 3.5rem;                                              |
| left-14       | left: 3.5rem;                                                |
| -top-14       | top: -3.5rem;                                                |
| -right-14     | right: -3.5rem;                                              |
| -bottom-14    | bottom: -3.5rem;                                             |
| -left-14      | left: -3.5rem;                                               |
| inset-16      | top: 4rem; right: 4rem; bottom: 4rem; left: 4rem;            |
| -inset-16     | top: -4rem; right: -4rem; bottom: -4rem; left: -4rem;        |
| inset-y-16    | top: 4rem; bottom: 4rem;                                     |
| inset-x-16    | right: 4rem; left: 4rem;                                     |
| -inset-y-16   | top: -4rem; bottom: -4rem;                                   |
| -inset-x-16   | right: -4rem; left: -4rem;                                   |
| top-16        | top: 4rem;                                                   |
| right-16      | right: 4rem;                                                 |
| bottom-16     | bottom: 4rem;                                                |
| left-16       | left: 4rem;                                                  |
| -top-16       | top: -4rem;                                                  |
| -right-16     | right: -4rem;                                                |
| -bottom-16    | bottom: -4rem;                                               |
| -left-16      | left: -4rem;                                                 |
| inset-20      | top: 5rem; right: 5rem; bottom: 5rem; left: 5rem;            |
| -inset-20     | top: -5rem; right: -5rem; bottom: -5rem; left: -5rem;        |
| inset-y-20    | top: 5rem; bottom: 5rem;                                     |
| inset-x-20    | right: 5rem; left: 5rem;                                     |
| -inset-y-20   | top: -5rem; bottom: -5rem;                                   |
| -inset-x-20   | right: -5rem; left: -5rem;                                   |
| top-20        | top: 5rem;                                                   |
| right-20      | right: 5rem;                                                 |
| bottom-20     | bottom: 5rem;                                                |
| left-20       | left: 5rem;                                                  |
| -top-20       | top: -5rem;                                                  |
| -right-20     | right: -5rem;                                                |
| -bottom-20    | bottom: -5rem;                                               |
| -left-20      | left: -5rem;                                                 |
| inset-24      | top: 6rem; right: 6rem; bottom: 6rem; left: 6rem;            |
| -inset-24     | top: -6rem; right: -6rem; bottom: -6rem; left: -6rem;        |
| inset-y-24    | top: 6rem; bottom: 6rem;                                     |
| inset-x-24    | right: 6rem; left: 6rem;                                     |
| -inset-y-24   | top: -6rem; bottom: -6rem;                                   |
| -inset-x-24   | right: -6rem; left: -6rem;                                   |
| top-24        | top: 6rem;                                                   |
| right-24      | right: 6rem;                                                 |
| bottom-24     | bottom: 6rem;                                                |
| left-24       | left: 6rem;                                                  |
| -top-24       | top: -6rem;                                                  |
| -right-24     | right: -6rem;                                                |
| -bottom-24    | bottom: -6rem;                                               |
| -left-24      | left: -6rem;                                                 |
| inset-28      | top: 7rem; right: 7rem; bottom: 7rem; left: 7rem;            |
| -inset-28     | top: -7rem; right: -7rem; bottom: -7rem; left: -7rem;        |
| inset-y-28    | top: 7rem; bottom: 7rem;                                     |
| inset-x-28    | right: 7rem; left: 7rem;                                     |
| -inset-y-28   | top: -7rem; bottom: -7rem;                                   |
| -inset-x-28   | right: -7rem; left: -7rem;                                   |
| top-28        | top: 7rem;                                                   |
| right-28      | right: 7rem;                                                 |
| bottom-28     | bottom: 7rem;                                                |
| left-28       | left: 7rem;                                                  |
| -top-28       | top: -7rem;                                                  |
| -right-28     | right: -7rem;                                                |
| -bottom-28    | bottom: -7rem;                                               |
| -left-28      | left: -7rem;                                                 |
| inset-32      | top: 8rem; right: 8rem; bottom: 8rem; left: 8rem;            |
| -inset-32     | top: -8rem; right: -8rem; bottom: -8rem; left: -8rem;        |
| inset-y-32    | top: 8rem; bottom: 8rem;                                     |
| inset-x-32    | right: 8rem; left: 8rem;                                     |
| -inset-y-32   | top: -8rem; bottom: -8rem;                                   |
| -inset-x-32   | right: -8rem; left: -8rem;                                   |
| top-32        | top: 8rem;                                                   |
| right-32      | right: 8rem;                                                 |
| bottom-32     | bottom: 8rem;                                                |
| left-32       | left: 8rem;                                                  |
| -top-32       | top: -8rem;                                                  |
| -right-32     | right: -8rem;                                                |
| -bottom-32    | bottom: -8rem;                                               |
| -left-32      | left: -8rem;                                                 |
| inset-36      | top: 9rem; right: 9rem; bottom: 9rem; left: 9rem;            |
| -inset-36     | top: -9rem; right: -9rem; bottom: -9rem; left: -9rem;        |
| inset-y-36    | top: 9rem; bottom: 9rem;                                     |
| inset-x-36    | right: 9rem; left: 9rem;                                     |
| -inset-y-36   | top: -9rem; bottom: -9rem;                                   |
| -inset-x-36   | right: -9rem; left: -9rem;                                   |
| top-36        | top: 9rem;                                                   |
| right-36      | right: 9rem;                                                 |
| bottom-36     | bottom: 9rem;                                                |
| left-36       | left: 9rem;                                                  |
| -top-36       | top: -9rem;                                                  |
| -right-36     | right: -9rem;                                                |
| -bottom-36    | bottom: -9rem;                                               |
| -left-36      | left: -9rem;                                                 |
| inset-40      | top: 10rem; right: 10rem; bottom: 10rem; left: 10rem;        |
| -inset-40     | top: -10rem; right: -10rem; bottom: -10rem; left: -10rem;    |
| inset-y-40    | top: 10rem; bottom: 10rem;                                   |
| inset-x-40    | right: 10rem; left: 10rem;                                   |
| -inset-y-40   | top: -10rem; bottom: -10rem;                                 |
| -inset-x-40   | right: -10rem; left: -10rem;                                 |
| top-40        | top: 10rem;                                                  |
| right-40      | right: 10rem;                                                |
| bottom-40     | bottom: 10rem;                                               |
| left-40       | left: 10rem;                                                 |
| -top-40       | top: -10rem;                                                 |
| -right-40     | right: -10rem;                                               |
| -bottom-40    | bottom: -10rem;                                              |
| -left-40      | left: -10rem;                                                |
| inset-44      | top: 11rem; right: 11rem; bottom: 11rem; left: 11rem;        |
| -inset-44     | top: -11rem; right: -11rem; bottom: -11rem; left: -11rem;    |
| inset-y-44    | top: 11rem; bottom: 11rem;                                   |
| inset-x-44    | right: 11rem; left: 11rem;                                   |
| -inset-y-44   | top: -11rem; bottom: -11rem;                                 |
| -inset-x-44   | right: -11rem; left: -11rem;                                 |
| top-44        | top: 11rem;                                                  |
| right-44      | right: 11rem;                                                |
| bottom-44     | bottom: 11rem;                                               |
| left-44       | left: 11rem;                                                 |
| -top-44       | top: -11rem;                                                 |
| -right-44     | right: -11rem;                                               |
| -bottom-44    | bottom: -11rem;                                              |
| -left-44      | left: -11rem;                                                |
| inset-48      | top: 12rem; right: 12rem; bottom: 12rem; left: 12rem;        |
| -inset-48     | top: -12rem; right: -12rem; bottom: -12rem; left: -12rem;    |
| inset-y-48    | top: 12rem; bottom: 12rem;                                   |
| inset-x-48    | right: 12rem; left: 12rem;                                   |
| -inset-y-48   | top: -12rem; bottom: -12rem;                                 |
| -inset-x-48   | right: -12rem; left: -12rem;                                 |
| top-48        | top: 12rem;                                                  |
| right-48      | right: 12rem;                                                |
| bottom-48     | bottom: 12rem;                                               |
| left-48       | left: 12rem;                                                 |
| -top-48       | top: -12rem;                                                 |
| -right-48     | right: -12rem;                                               |
| -bottom-48    | bottom: -12rem;                                              |
| -left-48      | left: -12rem;                                                |
| inset-52      | top: 13rem; right: 13rem; bottom: 13rem; left: 13rem;        |
| -inset-52     | top: -13rem; right: -13rem; bottom: -13rem; left: -13rem;    |
| inset-y-52    | top: 13rem; bottom: 13rem;                                   |
| inset-x-52    | right: 13rem; left: 13rem;                                   |
| -inset-y-52   | top: -13rem; bottom: -13rem;                                 |
| -inset-x-52   | right: -13rem; left: -13rem;                                 |
| top-52        | top: 13rem;                                                  |
| right-52      | right: 13rem;                                                |
| bottom-52     | bottom: 13rem;                                               |
| left-52       | left: 13rem;                                                 |
| -top-52       | top: -13rem;                                                 |
| -right-52     | right: -13rem;                                               |
| -bottom-52    | bottom: -13rem;                                              |
| -left-52      | left: -13rem;                                                |
| inset-56      | top: 14rem; right: 14rem; bottom: 14rem; left: 14rem;        |
| -inset-56     | top: -14rem; right: -14rem; bottom: -14rem; left: -14rem;    |
| inset-y-56    | top: 14rem; bottom: 14rem;                                   |
| inset-x-56    | right: 14rem; left: 14rem;                                   |
| -inset-y-56   | top: -14rem; bottom: -14rem;                                 |
| -inset-x-56   | right: -14rem; left: -14rem;                                 |
| top-56        | top: 14rem;                                                  |
| right-56      | right: 14rem;                                                |
| bottom-56     | bottom: 14rem;                                               |
| left-56       | left: 14rem;                                                 |
| -top-56       | top: -14rem;                                                 |
| -right-56     | right: -14rem;                                               |
| -bottom-56    | bottom: -14rem;                                              |
| -left-56      | left: -14rem;                                                |
| inset-60      | top: 15rem; right: 15rem; bottom: 15rem; left: 15rem;        |
| -inset-60     | top: -15rem; right: -15rem; bottom: -15rem; left: -15rem;    |
| inset-y-60    | top: 15rem; bottom: 15rem;                                   |
| inset-x-60    | right: 15rem; left: 15rem;                                   |
| -inset-y-60   | top: -15rem; bottom: -15rem;                                 |
| -inset-x-60   | right: -15rem; left: -15rem;                                 |
| top-60        | top: 15rem;                                                  |
| right-60      | right: 15rem;                                                |
| bottom-60     | bottom: 15rem;                                               |
| left-60       | left: 15rem;                                                 |
| -top-60       | top: -15rem;                                                 |
| -right-60     | right: -15rem;                                               |
| -bottom-60    | bottom: -15rem;                                              |
| -left-60      | left: -15rem;                                                |
| inset-64      | top: 16rem; right: 16rem; bottom: 16rem; left: 16rem;        |
| -inset-64     | top: -16rem; right: -16rem; bottom: -16rem; left: -16rem;    |
| inset-y-64    | top: 16rem; bottom: 16rem;                                   |
| inset-x-64    | right: 16rem; left: 16rem;                                   |
| -inset-y-64   | top: -16rem; bottom: -16rem;                                 |
| -inset-x-64   | right: -16rem; left: -16rem;                                 |
| top-64        | top: 16rem;                                                  |
| right-64      | right: 16rem;                                                |
| bottom-64     | bottom: 16rem;                                               |
| left-64       | left: 16rem;                                                 |
| -top-64       | top: -16rem;                                                 |
| -right-64     | right: -16rem;                                               |
| -bottom-64    | bottom: -16rem;                                              |
| -left-64      | left: -16rem;                                                |
| inset-72      | top: 18rem; right: 18rem; bottom: 18rem; left: 18rem;        |
| -inset-72     | top: -18rem; right: -18rem; bottom: -18rem; left: -18rem;    |
| inset-y-72    | top: 18rem; bottom: 18rem;                                   |
| inset-x-72    | right: 18rem; left: 18rem;                                   |
| -inset-y-72   | top: -18rem; bottom: -18rem;                                 |
| -inset-x-72   | right: -18rem; left: -18rem;                                 |
| top-72        | top: 18rem;                                                  |
| right-72      | right: 18rem;                                                |
| bottom-72     | bottom: 18rem;                                               |
| left-72       | left: 18rem;                                                 |
| -top-72       | top: -18rem;                                                 |
| -right-72     | right: -18rem;                                               |
| -bottom-72    | bottom: -18rem;                                              |
| -left-72      | left: -18rem;                                                |
| inset-80      | top: 20rem; right: 20rem; bottom: 20rem; left: 20rem;        |
| -inset-80     | top: -20rem; right: -20rem; bottom: -20rem; left: -20rem;    |
| inset-y-80    | top: 20rem; bottom: 20rem;                                   |
| inset-x-80    | right: 20rem; left: 20rem;                                   |
| -inset-y-80   | top: -20rem; bottom: -20rem;                                 |
| -inset-x-80   | right: -20rem; left: -20rem;                                 |
| top-80        | top: 20rem;                                                  |
| right-80      | right: 20rem;                                                |
| bottom-80     | bottom: 20rem;                                               |
| left-80       | left: 20rem;                                                 |
| -top-80       | top: -20rem;                                                 |
| -right-80     | right: -20rem;                                               |
| -bottom-80    | bottom: -20rem;                                              |
| -left-80      | left: -20rem;                                                |
| inset-96      | top: 24rem; right: 24rem; bottom: 24rem; left: 24rem;        |
| -inset-96     | top: -24rem; right: -24rem; bottom: -24rem; left: -24rem;    |
| inset-y-96    | top: 24rem; bottom: 24rem;                                   |
| inset-x-96    | right: 24rem; left: 24rem;                                   |
| -inset-y-96   | top: -24rem; bottom: -24rem;                                 |
| -inset-x-96   | right: -24rem; left: -24rem;                                 |
| top-96        | top: 24rem;                                                  |
| right-96      | right: 24rem;                                                |
| bottom-96     | bottom: 24rem;                                               |
| left-96       | left: 24rem;                                                 |
| -top-96       | top: -24rem;                                                 |
| -right-96     | right: -24rem;                                               |
| -bottom-96    | bottom: -24rem;                                              |
| -left-96      | left: -24rem;                                                |
| inset-auto    | top: auto; right: auto; bottom: auto; left: auto;            |
| inset-1/2     | top: 50%; right: 50%; bottom: 50%; left: 50%;                |
| inset-1/3     | top: 33.333333%; right: 33.333333%; bottom: 33.333333%; left: 33.333333%; |
| inset-2/3     | top: 66.666667%; right: 66.666667%; bottom: 66.666667%; left: 66.666667%; |
| inset-1/4     | top: 25%; right: 25%; bottom: 25%; left: 25%;                |
| inset-2/4     | top: 50%; right: 50%; bottom: 50%; left: 50%;                |
| inset-3/4     | top: 75%; right: 75%; bottom: 75%; left: 75%;                |
| inset-full    | top: 100%; right: 100%; bottom: 100%; left: 100%;            |
| -inset-1/2    | top: -50%; right: -50%; bottom: -50%; left: -50%;            |
| -inset-1/3    | top: -33.333333%; right: -33.333333%; bottom: -33.333333%; left: -33.333333%; |
| -inset-2/3    | top: -66.666667%; right: -66.666667%; bottom: -66.666667%; left: -66.666667%; |
| -inset-1/4    | top: -25%; right: -25%; bottom: -25%; left: -25%;            |
| -inset-2/4    | top: -50%; right: -50%; bottom: -50%; left: -50%;            |
| -inset-3/4    | top: -75%; right: -75%; bottom: -75%; left: -75%;            |
| -inset-full   | top: -100%; right: -100%; bottom: -100%; left: -100%;        |
| inset-y-auto  | top: auto; bottom: auto;                                     |
| inset-x-auto  | right: auto; left: auto;                                     |
| inset-y-1/2   | top: 50%; bottom: 50%;                                       |
| inset-x-1/2   | right: 50%; left: 50%;                                       |
| inset-y-1/3   | top: 33.333333%; bottom: 33.333333%;                         |
| inset-x-1/3   | right: 33.333333%; left: 33.333333%;                         |
| inset-y-2/3   | top: 66.666667%; bottom: 66.666667%;                         |
| inset-x-2/3   | right: 66.666667%; left: 66.666667%;                         |
| inset-y-1/4   | top: 25%; bottom: 25%;                                       |
| inset-x-1/4   | right: 25%; left: 25%;                                       |
| inset-y-2/4   | top: 50%; bottom: 50%;                                       |
| inset-x-2/4   | right: 50%; left: 50%;                                       |
| inset-y-3/4   | top: 75%; bottom: 75%;                                       |
| inset-x-3/4   | right: 75%; left: 75%;                                       |
| inset-y-full  | top: 100%; bottom: 100%;                                     |
| inset-x-full  | right: 100%; left: 100%;                                     |
| -inset-y-1/2  | top: -50%; bottom: -50%;                                     |
| -inset-x-1/2  | right: -50%; left: -50%;                                     |
| -inset-y-1/3  | top: -33.333333%; bottom: -33.333333%;                       |
| -inset-x-1/3  | right: -33.333333%; left: -33.333333%;                       |
| -inset-y-2/3  | top: -66.666667%; bottom: -66.666667%;                       |
| -inset-x-2/3  | right: -66.666667%; left: -66.666667%;                       |
| -inset-y-1/4  | top: -25%; bottom: -25%;                                     |
| -inset-x-1/4  | right: -25%; left: -25%;                                     |
| -inset-y-2/4  | top: -50%; bottom: -50%;                                     |
| -inset-x-2/4  | right: -50%; left: -50%;                                     |
| -inset-y-3/4  | top: -75%; bottom: -75%;                                     |
| -inset-x-3/4  | right: -75%; left: -75%;                                     |
| -inset-y-full | top: -100%; bottom: -100%;                                   |
| -inset-x-full | right: -100%; left: -100%;                                   |
| top-auto      | top: auto;                                                   |
| right-auto    | right: auto;                                                 |
| bottom-auto   | bottom: auto;                                                |
| left-auto     | left: auto;                                                  |
| top-1/2       | top: 50%;                                                    |
| right-1/2     | right: 50%;                                                  |
| bottom-1/2    | bottom: 50%;                                                 |
| left-1/2      | left: 50%;                                                   |
| top-1/3       | top: 33.333333%;                                             |
| right-1/3     | right: 33.333333%;                                           |
| bottom-1/3    | bottom: 33.333333%;                                          |
| left-1/3      | left: 33.333333%;                                            |
| top-2/3       | top: 66.666667%;                                             |
| right-2/3     | right: 66.666667%;                                           |
| bottom-2/3    | bottom: 66.666667%;                                          |
| left-2/3      | left: 66.666667%;                                            |
| top-1/4       | top: 25%;                                                    |
| right-1/4     | right: 25%;                                                  |
| bottom-1/4    | bottom: 25%;                                                 |
| left-1/4      | left: 25%;                                                   |
| top-2/4       | top: 50%;                                                    |
| right-2/4     | right: 50%;                                                  |
| bottom-2/4    | bottom: 50%;                                                 |
| left-2/4      | left: 50%;                                                   |
| top-3/4       | top: 75%;                                                    |
| right-3/4     | right: 75%;                                                  |
| bottom-3/4    | bottom: 75%;                                                 |
| left-3/4      | left: 75%;                                                   |
| top-full      | top: 100%;                                                   |
| right-full    | right: 100%;                                                 |
| bottom-full   | bottom: 100%;                                                |
| left-full     | left: 100%;                                                  |
| -top-1/2      | top: -50%;                                                   |
| -right-1/2    | right: -50%;                                                 |
| -bottom-1/2   | bottom: -50%;                                                |
| -left-1/2     | left: -50%;                                                  |
| -top-1/3      | top: -33.333333%;                                            |
| -right-1/3    | right: -33.333333%;                                          |
| -bottom-1/3   | bottom: -33.333333%;                                         |
| -left-1/3     | left: -33.333333%;                                           |
| -top-2/3      | top: -66.666667%;                                            |
| -right-2/3    | right: -66.666667%;                                          |
| -bottom-2/3   | bottom: -66.666667%;                                         |
| -left-2/3     | left: -66.666667%;                                           |
| -top-1/4      | top: -25%;                                                   |
| -right-1/4    | right: -25%;                                                 |
| -bottom-1/4   | bottom: -25%;                                                |
| -left-1/4     | left: -25%;                                                  |
| -top-2/4      | top: -50%;                                                   |
| -right-2/4    | right: -50%;                                                 |
| -bottom-2/4   | bottom: -50%;                                                |
| -left-2/4     | left: -50%;                                                  |
| -top-3/4      | top: -75%;                                                   |
| -right-3/4    | right: -75%;                                                 |
| -bottom-3/4   | bottom: -75%;                                                |
| -left-3/4     | left: -75%;                                                  |
| -top-full     | top: -100%;                                                  |
| -right-full   | right: -100%;                                                |
| -bottom-full  | bottom: -100%;                                               |
| -left-full    | left: -100%;                                                 |



## 05.13.2 Usage

Use the `{top|right|bottom|left|inset}-0` utilities to anchor absolutely positioned elements against any of the edges of the nearest positioned parent.

Combined with Tailwind’s padding and margin utilities, you’ll probably find that these are all you need to precisely control absolutely positioned elements.

`{top|right|bottom|left|inset}-0`유틸리티를 사용하여 가장 가까운 위치에있는 부모의 가장자리에 대해 절대 위치 요소를 고정합니다.

Tailwind의 패딩 및 마진 유틸리티와 함께 사용하면 절대 위치 요소를 정확하게 제어하는 데 필요한 모든 것입니다.

```html
<!-- Span top edge -->
<div class="relative h-32 w-32 ...">
  <div class="absolute inset-x-0 top-0 h-16 ...">1</div>
</div>

<!-- Span right edge -->
<div class="relative h-32 w-32 ...">
  <div class="absolute inset-y-0 right-0 w-16 ...">2</div>
</div>

<!-- Span bottom edge -->
<div class="relative h-32 w-32 ...">
  <div class="absolute inset-x-0 bottom-0 h-16 ...">3</div>
</div>

<!-- Span left edge -->
<div class="relative h-32 w-32 ...">
  <div class="absolute inset-y-0 left-0 w-16 ...">4</div>
</div>

<!-- Fill entire parent -->
<div class="relative h-32 w-32 ...">
  <div class="absolute inset-0 ...">5</div>
</div>

<!-- Pin to top left corner -->
<div class="relative h-32 w-32 ...">
  <div class="absolute left-0 top-0 h-16 w-16 ...">6</div>
</div>

<!-- Pin to top right corner -->
<div class="relative h-32 w-32 ...">
  <div class="absolute top-0 right-0 h-16 w-16 ...">7</div>
</div>

<!-- Pin to bottom right corner -->
<div class="relative h-32 w-32 ...">
  <div class="absolute bottom-0 right-0 h-16 w-16 ...">8</div>
</div>

<!-- Pin to bottom left corner -->
<div class="relative h-32 w-32 ...">
  <div class="absolute bottom-0 left-0 h-16 w-16 ...">9</div>
</div>
```



## 05.13.3 Responsive

To position an element only at a specific breakpoint, add a `{screen}:` prefix to any existing positioning utility. For example, adding the class `md:inset-y-0` to an element would apply the `inset-y-0` utility at medium screen sizes and above.

특정 중단 점에만 요소를 배치하려면 `{screen}:`기존 위치 지정 유틸리티에 접두사를 추가하십시오 . 예를 들어, `md:inset-y-0`요소에 클래스 를 추가하면 `inset-y-0`중간 화면 크기 이상에서 유틸리티 가 적용됩니다 .

```html
<div class="relative h-32 ...">
  <div class="absolute inset-0 md:inset-y-0 ..."></div>
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

Tailwind의 반응 형 디자인 기능에 대한 자세한 내용은 [반응 형 디자인](https://tailwindcss.com/docs/responsive-design) 문서를 확인하세요 .



## 05.13.4 Customizing

### Top / Right / Bottom / Left scale

By default, Tailwind provides top/right/bottom/left/inset utilities for a combination of the [default spacing scale](https://tailwindcss.com/docs/customizing-spacing#default-spacing-scale), `auto`, `full` as well as some additional fraction values.

You can change, add, or remove these by editing the `theme.inset` section of your `tailwind.config.js` file.

기본적으로 Tailwind는 [기본 간격 척도](https://tailwindcss.com/docs/customizing-spacing#default-spacing-scale) , `auto`및 `full`일부 추가 분수 값 의 조합에 대해 위쪽 / 오른쪽 / 아래쪽 / 왼쪽 / 삽입 유틸리티를 제공 합니다.

파일 `theme.inset`섹션을 편집하여 변경, 추가 또는 제거 할 수 있습니다 `tailwind.config.js`.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      inset: {
        '0': 0,
        // ...
-       '64': '16rem',
+       '1/5': '20%',
      }
    }
  }
```

### Negative values

If you’d like to add any negative top/right/bottom/left classes that take the same form as Tailwind’s [negative margin](https://tailwindcss.com/docs/margin#negative-margins) classes, prefix the keys in your config file with a dash:

Tailwind의 [네거티브 여백](https://tailwindcss.com/docs/margin#negative-margins) 클래스 와 동일한 형식을 갖는 네거티브 top / right / bottom / left 클래스를 추가하려면 구성 파일의 키 앞에 대시를 붙입니다.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        inset: {
+         '-16': '-4rem',
        }
      }
    }
  }
```

Tailwind is smart enough to generate classes like `-top-16` when it sees the leading dash, not `top--16` like you might expect.

Tailwind는 예상과 `-top-16`달리 앞의 대시가 표시되는 것과 같은 클래스를 생성 할 수있을만큼 똑똑 `top--16`합니다.

### Variants

By default, only responsive variants are generated for top, right, bottom, left, and inset utilities.

You can control which variants are generated for the top, right, bottom, left, and inset utilities by modifying the `inset` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

기본적으로 상단, 오른쪽, 하단, 왼쪽 및 삽입 유틸리티에 대해 반응 형 변형 만 생성됩니다.

파일 섹션의 속성 을 수정하여 위쪽, 오른쪽, 아래쪽, 왼쪽 및 삽입 유틸리티에 대해 생성되는 변형을 제어 할 수 있습니다 . `inset``variants` `tailwind.config.js`

예를 들어이 구성은 호버 및 포커스 변형 도 생성합니다 .

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       inset: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the top, right, bottom, left, and inset utilities in your project, you can disable them entirely by setting the `inset` property to `false` in the `corePlugins` section of your config file:

프로젝트에서 위쪽, 오른쪽, 아래쪽, 왼쪽 및 삽입 유틸리티 를 사용하지 않으려는 경우 구성 파일 섹션 에서 속성 을 로 설정하여 완전히 비활성화 할 수 있습니다 . `inset` `false` `corePlugins`

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     inset: false,
    }
  }
```



---



# 05.14 Visibility

Utilities for controlling the visibility of an element.

요소의 가시성을 제어하기위한 유틸리티입니다.



## 05.14.1 Default class reference

| Class     | Properties           |
| --------- | -------------------- |
| visible   | visibility: visible; |
| invisible | visibility: hidden;  |



## 05.14.2 Invisible

Use `invisible` to hide an element, but still maintain its place in the DOM, affecting the layout of other elements (compare with `.hidden` from the [display](https://tailwindcss.com/docs/display#hidden) documentation).

사용 `invisible`요소를 숨길하지만, 여전히 (비교 다른 요소의 레이아웃에 영향을주지는 DOM에 그 자리를 유지 `.hidden`으로부터 [디스플레이](https://tailwindcss.com/docs/display#hidden) 문서).



```html
<div class="flex justify-center space-x-4">
  <div>1</div>
  <div class="invisible ...">2</div>
  <div>3</div>
</div>
```



## 05.14.3 Visible

Use `visible` to make an element visible. This is mostly useful for undoing the `invisible` utility at different screen sizes.

`visible`요소를 표시하는 데 사용 합니다. 이것은 `invisible`다른 화면 크기에서 유틸리티 를 실행 취소하는 데 주로 유용 합니다.

```html
<div class="flex justify-center space-x-4">
  <div>1</div>
  <div class="visible ...">2</div>
  <div>3</div>
</div>
```



## 05.14.4 Responsive

To apply a visibility utility only at a specific breakpoint, add a `{screen}:` prefix to the existing class name. For example, adding the class `md:invisible` to an element would apply the `invisible` utility at medium screen sizes and above.

특정 중단 점에서만 가시성 유틸리티를 적용하려면 `{screen}:`기존 클래스 이름에 접두사를 추가하십시오 . 예를 들어, `md:invisible`요소에 클래스 를 추가하면 `invisible`중간 화면 크기 이상에서 유틸리티 가 적용됩니다 .

```html
<div class="visible md:invisible ..."></div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

Tailwind의 반응 형 디자인 기능에 대한 자세한 내용은 [반응 형 디자인](https://tailwindcss.com/docs/responsive-design) 문서를 확인하세요 .



## 05.14.5 Customizing

### Variants

By default, only responsive variants are generated for visibility utilities.

You can control which variants are generated for the visibility utilities by modifying the `visibility` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and focus variants:

기본적으로 가시성 유틸리티에 대해 반응 형 변형 만 생성됩니다.

파일 섹션의 특성 을 수정하여 가시성 유틸리티에 대해 생성되는 변형을 제어 할 수 있습니다 . `visibility``variants` `tailwind.config.js`

예를 들어이 구성은 호버 및 포커스 변형 도 생성합니다 .

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       visibility: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the visibility utilities in your project, you can disable them entirely by setting the `visibility` property to `false` in the `corePlugins` section of your config file:

프로젝트에서 가시성 유틸리티 를 사용하지 않으려는 경우 구성 파일 섹션 에서 속성 을 로 설정하여 완전히 비활성화 할 수 있습니다 . `visibility` `false` `corePlugins`

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     visibility: false,
    }
  }
```



---



# 05.15 Z-Index

Utilities for controlling the stack order of an element.

요소의 스택 순서를 제어하기위한 유틸리티입니다.



## 05.15.1 Default class reference

| Class  | Properties     |
| ------ | -------------- |
| z-0    | z-index: 0;    |
| z-10   | z-index: 10;   |
| z-20   | z-index: 20;   |
| z-30   | z-index: 30;   |
| z-40   | z-index: 40;   |
| z-50   | z-index: 50;   |
| z-auto | z-index: auto; |



## 05.15.2 Usage

Control the stack order (or three-dimensional positioning) of an element in Tailwind, regardless of order it has been displayed, using the `z-{index}` utilities.

`z-{index}`유틸리티를 사용하여 표시된 순서에 관계없이 Tailwind에서 요소의 스택 순서 (또는 3 차원 위치 지정)를 제어합니다 .



```html
<div class="z-40 ...">5</div>
<div class="z-30 ...">4</div>
<div class="z-20 ...">3</div>
<div class="z-10 ...">2</div>
<div class="z-0 ...">1</div>
```



## 05.15.3 Responsive

To control the z-index of an element at a specific breakpoint, add a `{screen}:` prefix to any existing z-index utility. For example, use `md:z-50` to apply the `z-50` utility at only medium screen sizes and above.

특정 중단 점에서 요소의 Z- 색인을 제어하려면 `{screen}:`기존 Z- 색인 유틸리티에 접두사를 추가하세요 . 예를 들어 중간 화면 크기 이상에서만 유틸리티 `md:z-50`를 적용하는 데 사용 합니다 `z-50`.

```html
<div class="z-0 md:z-50 ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

Tailwind의 반응 형 디자인 기능에 대한 자세한 내용은 [반응 형 디자인](https://tailwindcss.com/docs/responsive-design) 문서를 확인하세요 .



## 05.15.4 Customizing

### Z-Index scale

By default, Tailwind provides six numeric `z-index` utilities and an `auto` utility. You change, add, or remove these by editing the `theme.zIndex` section of your Tailwind config.

기본적으로 Tailwind는 6 개의 숫자 `z-index`유틸리티와 하나의 `auto`유틸리티를 제공 합니다. `theme.zIndex`Tailwind 구성 섹션을 편집하여 변경, 추가 또는 제거합니다 .

```diff-js
  // tailwind.config.js
```

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      zIndex: {
        '0': 0,
-       '10': 10,
-       '20': 20,
-       '30': 30,
-       '40': 40,
-       '50': 50,
+       '25': 25,
+       '50': 50,
+       '75': 75,
+       '100': 100,
        'auto': 'auto',
      }
    }
  }
```

### Negative values

If you’d like to add any negative z-index classes that take the same form as Tailwind’s [negative margin](https://tailwindcss.com/docs/margin#negative-margins) classes, prefix the keys in your config file with a dash:

Tailwind의 [음수 여백](https://tailwindcss.com/docs/margin#negative-margins) 클래스 와 동일한 형식을 사용하는 음수 Z- 색인 클래스를 추가 하려면 구성 파일의 키 앞에 대시를 붙입니다.

```diff-js
  // tailwind.config.js
  module.exports = {
    theme: {
      extend: {
        zIndex: {
+         '-10': '-10',
        }
      }
    }
  }
```

Tailwind is smart enough to generate classes like `-z-10` when it sees the leading dash, not `z--10` like you might expect.

Tailwind는 예상과 `-z-10`달리 앞의 대시가 표시되는 것과 같은 클래스를 생성 할 수있을만큼 똑똑 `z--10`합니다.

### Variants

By default, only responsive, focus-within and focus variants are generated for z-index utilities.

You can control which variants are generated for the z-index utilities by modifying the `zIndex` property in the `variants` section of your `tailwind.config.js` file.

For example, this config will also generate hover and active variants:

기본적으로 Z- 색인 유틸리티에 대해 반응 형, 초점 범위 및 초점 변형 만 생성됩니다.

파일 섹션 에서 속성 을 수정하여 Z- 색인 유틸리티에 대해 생성되는 변형을 제어 할 수 있습니다 . `zIndex``variants` `tailwind.config.js`

예를 들어이 구성은 호버링 및 활성 변형 도 생성합니다 .

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       zIndex: ['hover', 'active'],
      }
    }
  }
```

### Disabling

If you don't plan to use the z-index utilities in your project, you can disable them entirely by setting the `zIndex` property to `false` in the `corePlugins` section of your config file:

프로젝트에서 Z- 색인 유틸리티 를 사용하지 않으려는 경우 구성 파일 섹션 에서 속성 을 로 설정하여 완전히 비활성화 할 수 있습니다 . `zIndex` `false` `corePlugins`

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     zIndex: false,
    }
  }
```

