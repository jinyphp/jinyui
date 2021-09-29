---
theme: "docs.bootstrap"
layout: "markdown"
title: "Tailwind layout"
subtitle: ""
breadcrumb:
    - "Docs"
    - "Utility"
---


# 05.1 Container

A component for fixing an element's width to the current breakpoint.

요소의 너비를 현재 중단 점으로 고정하기위한 구성 요소입니다.



## 05.1.1 Default class reference

| Class          | Breakpoint         | Properties   |
| -------------- | ------------------ | ------------ |
| container      | None               | width: 100%; |
| sm *(640px)*   | max-width: 640px;  |              |
| md *(768px)*   | max-width: 768px;  |              |
| lg *(1024px)*  | max-width: 1024px; |              |
| xl *(1280px)*  | max-width: 1280px; |              |
| 2xl *(1536px)* | max-width: 1536px; |              |



## 05.1.2 Usage

The `container` class sets the `max-width` of an element to match the `min-width` of the current breakpoint. This is useful if you’d prefer to design for a fixed set of screen sizes instead of trying to accommodate a fully fluid viewport.

`container`클래스 설정합니다 `max-width`요소의는 일치하는 `min-width`현재 중단 점을. 이는 완전히 유동적 인 뷰포트를 수용하는 대신 고정 된 화면 크기 세트로 디자인하려는 경우에 유용합니다.



Note that unlike containers you might have used in other frameworks, **Tailwind’s container does not center itself automatically and does not have any built-in horizontal padding.**

다른 프레임 워크에서 사용했을 수있는 컨테이너와 달리 **Tailwind의 컨테이너는 자동으로 중앙에 배치되지 않으며 기본 제공 가로 패딩이 없습니다.**



To center a container, use the `mx-auto` utility:

컨테이너를 중앙에 배치하려면 `mx-auto`유틸리티를 사용하십시오 .

```html
<div class="container mx-auto">
  <!-- ... -->
</div>
```

To add horizontal padding, use the `px-{size}` utilities:

수평 패딩을 추가하려면 `px-{size}`유틸리티를 사용하십시오 .

```html
<div class="container mx-auto px-4">
  <!-- ... -->
</div>
```

If you’d like to center your containers by default or include default horizontal padding, see the [customization options](https://tailwindcss.com/docs/container#customizing) below.

기본적으로 컨테이너를 중앙에 배치하거나 기본 가로 패딩을 포함하려면 아래 [사용자 정의 옵션을](https://tailwindcss.com/docs/container#customizing) 참조하십시오.



## 05.1.3 Responsive variants

The `container` class also includes responsive variants like `md:container` by default that allow you to make something behave like a container at only a certain breakpoint and up:

이 `container`클래스에는 `md:container`기본적으로 특정 중단 점 이상에서만 컨테이너처럼 동작하도록 하는 반응 형 변형이 포함되어 있습니다 .

```html
<!-- Full-width fluid until the `md` breakpoint, then lock to container -->
<div class="md:container md:mx-auto">
  <!-- ... -->
</div>
```



## 05.1.4 Customizing

### Centering by default

To center containers by default, set the `center` option to `true` in the `theme.container` section of your config file:

기본적으로 컨테이너를 중앙에 배치하려면 구성 파일 의 섹션 에서 `center`옵션을 `true`로 `theme.container`설정하십시오.

```js
// tailwind.config.js
module.exports = {
  theme: {
    container: {
      center: true,
    },
  },
}
```

### Horizontal padding

To add horizontal padding by default, specify the amount of padding you’d like using the `padding` option in the `theme.container` section of your config file:

기본적으로 수평 패딩을 추가하려면 구성 파일 섹션의 `padding`옵션을 사용하여 원하는 패딩 양을 지정 `theme.container`합니다.

```js
// tailwind.config.js
module.exports = {
  theme: {
    container: {
      padding: '2rem',
    },
  },
}
```

If you want to specify a different padding amount for each breakpoint, use an object to provide a `default` value and any breakpoint-specific overrides:

각 중단 점에 대해 다른 패딩 양을 지정하려면 개체를 사용하여 `default`값과 중단 점별 재정의 를 제공합니다 .

```js
// tailwind.config.js
module.exports = {
  theme: {
    container: {
      padding: {
        DEFAULT: '1rem',
        sm: '2rem',
        lg: '4rem',
        xl: '5rem',
        '2xl': '6rem',
      },
    },
  },
};
```

### Disabling responsive variants

If you’d like to disable the responsive variants, you can do so using by setting `container` to an empty array in the `variants` section of your `tailwind.config.js` file:

반응 형 변형을 비활성화하려면 파일 섹션 `container`에서 빈 배열 을 설정하여이를 수행 할 수 있습니다 .`variants``tailwind.config.js`

```diff-js
  // tailwind.config.js
  module.exports = {
    variants: {
      // ...
+     container: [],
    }
  }
```

### Disabling entirely

If you don’t plan to use the `container` class in your project, you can disable it entirely by setting the `container` property to `false` in the `corePlugins` section of your config file:

container`프로젝트 에서 클래스 를 사용하지 않으려는 경우 구성 파일 섹션 에서 `container`속성을 로 설정하여 완전히 비활성화 할 수 있습니다 .`false``corePlugins

```diff-js
  // tailwind.config.js
  module.exports = {
    corePlugins: {
      // ...
+     container: false,
    }
  }
```