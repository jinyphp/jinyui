---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind layout"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---

# 05.2 Box Decoration Break

Utilities for controlling how element fragments should be rendered across multiple lines, columns, or pages.

여러 줄, 열 또는 페이지에서 요소 조각을 렌더링하는 방법을 제어하는 유틸리티입니다.



## 05.2.1 Default class reference

| Class            | Properties                   |
| ---------------- | ---------------------------- |
| decoration-slice | box-decoration-break: slice; |
| decoration-clone | box-decoration-break: clone; |



## 05.2.2 Usage

Use the `decoration-slice` and `decoration-clone` utilities to control whether properties like background, border, border-image, box-shadow, clip-page, margin, and padding should be rendered as if the element were one continuous fragment, or distinct blocks.

`decoration-slice`및 `decoration-clone`유틸리티를 사용하여 배경, 테두리, 테두리 이미지, 상자 그림자, 클립 페이지, 여백 및 패딩과 같은 속성을 요소가 하나의 연속 조각 또는 개별 블록 인 것처럼 렌더링해야하는지 여부를 제어합니다.





```html
<span class="decoration-clone bg-gradient-to-b from-yellow-400 to-red-500 text-transparent ...">
  Hello<br>
  World
</span>
```



## 05.2.3 Responsive

To control the box-decoration-break property at a specific breakpoint, add a `{screen}:` prefix to any existing box-decoration-break utility. 

For example, use `md:decoration-slice` to apply the `decoration-slice` utility at only medium screen sizes and above.

특정 중단 점에서 box-decoration-break 속성을 제어하려면 `{screen}:`기존 box-decoration-break 유틸리티에 접두사를 추가 합니다. 

예를 들어 중간 화면 크기 이상에서만 유틸리티 `md:decoration-slice`를 적용하는 데 사용 합니다 `decoration-slice`.

```html
<div class="decoration-clone md:decoration-slice ...">
  <!-- ... -->
</div>
```

For more information about Tailwind’s responsive design features, check out the [Responsive Design](https://tailwindcss.com/docs/responsive-design) documentation.

Tailwind의 반응 형 디자인 기능에 대한 자세한 내용은 [반응 형 디자인](https://tailwindcss.com/docs/responsive-design) 문서를 확인하세요 .



## 05.2.4 Customizing

### Variants

By default, only responsive variants are generated for box-decoration-break utilities.

기본적으로 box-decoration-break 유틸리티에 대해 반응 형 변형 만 생성됩니다.

You can control which variants are generated for the box-decoration-break utilities by modifying the `boxDecorationBreak` property in the `variants` section of your `tailwind.config.js` file.

파일 섹션의 속성 을 수정하여 box-decoration-break 유틸리티에 대해 생성되는 변형을 제어 할 수 있습니다 . `boxDecorationBreak``variants` `tailwind.config.js`



For example, this config will also generate hover and focus variants:

예를 들어이 구성은 호버 및 포커스 변형 도 생성합니다 .

```diff
  // tailwind.config.js
  module.exports = {
    variants: {
      extend: {
        // ...
+       boxDecorationBreak: ['hover', 'focus'],
      }
    }
  }
```

### Disabling

If you don't plan to use the box-decoration-break utilities in your project, you can disable them entirely by setting the `boxDecorationBreak` property to `false` in the `corePlugins` section of your config file:

프로젝트에서 box-decoration-break 유틸리티 를 사용하지 않으려는 경우 구성 파일 섹션 에서 속성 을 로 설정하여 완전히 비활성화 할 수 있습니다 . `boxDecorationBreak` `false` `corePlugins`

```diff
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     boxDecorationBreak: false,
    }
  }
```



---


